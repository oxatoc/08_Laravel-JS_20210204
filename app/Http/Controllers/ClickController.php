<?php

namespace App\Http\Controllers;

use App\Models\Click;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Log;

class ClickController extends Controller
{
    public function GetMetrics(){

        //Получаем клики за последние 3 дня

        $periodDurationDays = 3;

        $periodStart = new \DateTime("now", new \DateTimeZone('UTC'));
        $periodStart->sub(new \DateInterval('P'.$periodDurationDays.'D'));
        $periodStart->setTime(0, 0, 0, 0);

        $clicks = Click::selectRaw("DATE_FORMAT(click_unix_time_utc, '%Y-%m-%d %H:00:00') AS hour_of_day, count(click_unix_time_utc) as total")
            ->groupBy('hour_of_day')
            ->where('click_unix_time_utc', '>=', $periodStart)
            ->orderBy('hour_of_day', 'desc')
            ->get();


        //Группировка по дням
        $clicksByDay = $clicks->groupBy(function($item, $key) {
            $cilickDay = new \DateTime($item->hour_of_day, new \DateTimeZone('UTC'));
            //Преобразовываем в часовой пояс пользователя
            $cilickDay->setTimeZone(new \DateTimeZone(Config::get('app.timezone')));
            return $cilickDay->format('d.m.Y');
        });

        //Преобразование в массив для Google Charts
        $viewData = [];
        foreach ($clicksByDay as $dayKey => $dayClicks){
            //Проход по каждому часу
            $viewDataHours = [];
            for ($iHour = 0; $iHour < 24; $iHour++){
                $clicksItem = $dayClicks->search(function ($item, $key) use ($iHour) {
                    $hour = (int)((new \DateTime($item->hour_of_day))->format("H"));
                    return $hour == $iHour;
                });
                if (is_numeric($clicksItem)){
                    $total = $dayClicks[$clicksItem]->total;
                } else {
                    $total = 0;
                }
                $viewDataHours[] = [
                    sprintf("%'.02d", $iHour)
                    , $total
                ];
            }
            $viewData[$dayKey] = $viewDataHours;
        }
        return View::make('view-metrics', ['ViewData' => $viewData]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $click = new Click;
        $click->clickX = $request->input('clickX');
        $click->clickY = $request->input('clickY');
        $clickDate = new \DateTime(date('Y-m-d H:i:s', $request->input('click_unix_time_utc')), new \DateTimeZone('UTC'));
        $click->click_unix_time_utc =  $clickDate->format('Y-m-d H:i:s');
        $click->save();
        
        return response()->json($click, 201);
    }
}
