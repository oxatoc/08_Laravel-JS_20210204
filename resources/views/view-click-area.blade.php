<x-component-global-template>
    <script src="/js/tracking.js"></script>
    <div class="click-area-container">
        <div class="click-area-container-map" onclick="onAreaClick(event)">
            Область для кликов
        </div>
        <div class="click-area-container-log" id="click-log">
            <span class="click-area-container-log-header">Лог кликов</span>
            
        </div>
    </div>
</x-global-template>