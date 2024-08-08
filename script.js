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

    let selectDropdown = document.querySelector('select');

    selectDropdown.addEventListener('change', function (e) { 
        updateURLParameter('countShow', selectDropdown.value)
    });

    let childeWith = document.querySelector(".filterWraperFix").offsetWidth;

    const parent = document.querySelector(".filterWraper");

    parent.style.width = `${childeWith}px`;

}
