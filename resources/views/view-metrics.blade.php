<x-component-global-template>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script>
        const ClicksByDayJson = JSON.parse('@json($ViewData)');
        window.onload = Window_OnLoad;
    </script>
    <div class='metrics-container'>
        <div id='clicks-by-day-chart-container' class='metrics-container-chart'></div>
        <div id='day-buttons-container' class='metrics-container-day-buttons'></div>
    </div>

</x-global-template>