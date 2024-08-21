window.onload = function()
{
    let currentURL = window.location.href;
    let url = new URL(currentURL);

    let page = url.searchParams.get('page');

    const arPaginator = document.getElementsByClassName('page');

    let paginator = 1;
    if (page != null) {
        paginator = page;
    } else {
        paginator = 1;
    }

    for (let i = 0; i < arPaginator.length; i++) {

        if (arPaginator[i].innerHTML == paginator) {
            arPaginator[i].classList.add("pageSelect");
        } else {
            arPaginator[i].classList.remove("pageSelect");
        }
    }

    let childeWith = document.querySelector(".filterWraperFix").offsetWidth;

    const parent = document.querySelector(".filterWraper");

    parent.style.width = `${childeWith}px`;
}
