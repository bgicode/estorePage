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

    const arPaginator = document.getElementsByClassName('page');

    const addPageAfter = document.createElement('button');
    addPageAfter.textContent = '...';
    addPageAfter.classList.add("pageMore");

    const addPageBefore = document.createElement('button');
    addPageBefore.textContent = '...';
    addPageBefore.classList.add("pageMore");

    var flag = false;

    let paginator = 1;
    if (page != null) {
        paginator = page;
    } else {
        paginator = 1;
    }    

    addPageAfter.addEventListener('click', function () {
        updateURLParameter('page', paginator - 3);
     });

    if (paginator > 5) {
        arPaginator[0].insertAdjacentElement('afterend', addPageAfter);
        var flag = true;
    } else {
        var flag = false;
    }

    for (let i = 0; i < arPaginator.length; i++) {

        if (arPaginator[i].innerHTML == paginator) {
            arPaginator[i].classList.add("pageSelect");
        } else {
            arPaginator[i].classList.remove("pageSelect");
        }
        if (flag == true
            && i < (paginator - 2)
            && i > 0
        ) {
            arPaginator[i].classList.add("pageHidden");
        }
        if (arPaginator.length > 5
            && i > (parseInt(paginator) + 1)
            && i != (arPaginator.length - 1)
        ) {
            arPaginator[i].classList.add("pageHidden");
            var overPage = true;
        }
    }

    if (overPage) {
        arPaginator[arPaginator.length - 1].insertAdjacentElement('beforebegin', addPageBefore);
    }

    addPageBefore.addEventListener('click', function () {
        updateURLParameter('page', parseInt(paginator) + 3);
     });

    const selectDropdown = document.querySelector('select');
    
    if (selectDropdown != null) {
        selectDropdown.addEventListener('change', function (e) {
            url.searchParams.set('countShow', selectDropdown.value);
            url.searchParams.set('page', 1);
    
            window.location.href = url.toString();
        });
    
    }
    
    let childeWith = document.querySelector(".filterWraperFix").offsetWidth;

    const parent = document.querySelector(".filterWraper");

    parent.style.width = `${childeWith}px`;
}
