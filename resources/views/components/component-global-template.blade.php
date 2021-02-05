<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicks log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body>
    <div class="global-template-body">
        <menu class="main-menu">
            <div class="main-menu-columns">
                <a class="btn btn-outline-primary w-100" href="{{URL::route('clickarea')}}" role="button">Область для кликов</a>
            </div>
            <div class="main-menu-columns">
                <a class="btn btn-outline-primary w-100" href="{{URL::route('clicks.metrics')}}" role="button">Метрики</a>
            </div>
        </menu>
        <div class="global-template-body-content">
            {{$slot}}
        </div>        
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>