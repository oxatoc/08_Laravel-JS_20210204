function Window_OnLoad() {

    //Наполнение кнопками для переключения дней
    var buttonsContainer = document.getElementById('day-buttons-container')
    for (var item in ClicksByDayJson) {
        let button = document.createElement('button');
        button.innerText = item.valueOf();
        button.className = "btn btn-outline-primary m-3";
        button.addEventListener("click", OnDayButtonClicked);
        buttonsContainer.append(button);
    }
    //Загрузка модулей Google Charts
    google.charts.load('current', { packages: ['corechart', 'line'] });
    google.charts.setOnLoadCallback(GoogleChartsCallbackFunction);
}

//Функция обратного вызова для ожидания загрузки GoogleCharts
function GoogleChartsCallbackFunction() {
    //Отрисовка метрик
    showMetricsByDayKey(Object.keys(ClicksByDayJson)[0]);
}


//Обработка событий нажатия кнопок выбора дня отчета
function OnDayButtonClicked(event) {
    const from = event.target;
    showMetricsByDayKey(from.innerText);
}



//Отображние графика
function showMetricsByDayKey(dayKey) {
    var containerID = 'clicks-by-day-chart-container';

    //deep copy
    var dataArray = JSON.parse(JSON.stringify(ClicksByDayJson[dayKey]));

    var headersArrayItem = [
        { label: 'Дата', id: 'date', type: 'string' }
        , { label: 'Клики', id: 'clicks', type: 'number' }
    ];

    dataArray.unshift(headersArrayItem);

    var data = google.visualization.arrayToDataTable(dataArray);

    var chart = new google.visualization.LineChart(document.getElementById(containerID));


    //опции для отрисовки диаграммы
    var lineChartOptions = {
        'legend': 'none',
        title: 'Отчет на дату: ' + dayKey,
        hAxis: {
            title: 'Час дня UTC'
            // , gridlines: {
            //     color: '#111'
            //     , minSpacing: 20
            //     , multiple: 1
            // }
            , textStyle: {
                fontSize: 12
            }
        },
        vAxis: {
            title: 'Количество кликов'
            , baseline: 0
            , format: 'decimal'
            , minValue: '0'
            , gridlines: {
                interval: 1
            }
            , minorGridlines: {
                color: 'transparent'
            }
        },
    };

    chart.draw(data, lineChartOptions);
}
