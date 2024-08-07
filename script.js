function updateURLParameter(param, paramVal) {
    // Получаем текущий URL
    let currentURL = window.location.href;
    // Создаем объект URL
    let url = new URL(currentURL);
    
    // Устанавливаем или изменяем параметр
    url.searchParams.set(param, paramVal);
    
    // Перенаправляем на новый URL
    window.location.href = url.toString();
}

window.onload = function()
{
    let currentURL = window.location.href;
    let url = new URL(currentURL);

    let page = url.searchParams.get('page');

    let arPaginator = document.getElementsByClassName('page');

    for (let i = 0; i < arPaginator.length; i++) {
        if (arPaginator[i].innerHTML == page) {
            arPaginator[i].classList.add("pageSelect");
        } else {
            arPaginator[i].classList.remove("pageSelect");
        }
        // let item = arPaginator[i];
        // // ваш код здесь
    }
}


