function onAreaClick(event) {
    var dt = new Date();

    var dtUnix = Math.round(dt.valueOf() / 1000);
    var clientX = event.clientX;
    var clientY = event.clientY;

    showLog(`X: ${clientX}, Y: ${clientY}, t: ${dt.toLocaleDateString('ru-RU')} ${dt.toLocaleTimeString('ru-RU')}`);

    //Отправка на сервер
    const XHR = new XMLHttpRequest();
    const FD = new FormData();
    FD.append('clickX', clientX);
    FD.append('clickY', clientY);
    FD.append('click_unix_time_utc', dtUnix);

    XHR.addEventListener('error', function (event) {
        showLog('Ошибка отправки на сервер');
    });
    XHR.addEventListener('abort', function (event) {
        showLog('Ошибка отправки на сервер');
    });


    XHR.open('POST', 'http://127.0.0.1:8000/api/clicks');
    XHR.send(FD);
}

function showLog(logStr) {
    var pElement = document.createElement('p');
    pElement.innerText = logStr;
    pElement.className = "click-area-container-log-para";
    document.getElementById("click-log").append(pElement);

}