function updateURLParameter(param, paramVal) {

    let currentURL = window.location.href;

    let url = new URL(currentURL);

    url.searchParams.set(param, paramVal);

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
    }
}
