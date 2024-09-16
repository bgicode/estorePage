window.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const inputFields = document.querySelectorAll(".filterUnitValue");
    const checkBoxes = document.querySelectorAll('input[type="checkbox"]');
    console.log(checkBoxes);

    function setInputData(data, e) {
        // console.log(data);

        let obj = data[0];
        const validValues = data[1];
        console.log(validValues);



        checkBoxes.forEach(checkbox => {

            if (validValues.some(value => value == checkbox.value)) {
                console.log(checkbox.value);
                checkbox.disabled = false;
            } else {
                checkbox.disabled = true;
            }
        });
    // console.log(e);
        for (let key in obj) {
            inputFields.forEach((inputField) => {
                if (inputField.classList.contains(key) != false) {
                    let placeholder = inputField.getAttribute("placeholder");
                    placeholder = placeholder.replace(/((от )|(до )).+/, `$1${obj[key]}`);
                    inputField.setAttribute("placeholder", placeholder);
                }
                // let rangeClass = key.replace(/(min|max)(.+)/, '$2');
                // if (inputField.classList.contains(rangeClass) != false) {
                //     // if(e.classList.contains(key) != false)
                //     inputField.setAttribute("min", obj[`min${rangeClass}`]); 
                //     inputField.setAttribute("max", obj[`max${rangeClass}`]);
                // }
            });
        }
    }

    function setCheckData(data, e) {

        let obj = data[0];
        const validValues = data[1];
        console.log(validValues);

        for (let key in obj) {
            inputFields.forEach((inputField) => {
                if (inputField.classList.contains(key) != false) {
                    let placeholder = inputField.getAttribute("placeholder");
                    placeholder = placeholder.replace(/((от )|(до )).+/, `$1${obj[key]}`);
                    inputField.setAttribute("placeholder", placeholder);
                }
            });
        }
    }



    function getCheckData() {
        let formData = new FormData(form);

        let str = '?';
        formData.forEach((value, key) => {
            str += key + '=' + value + '&';
        });
        str.replace(/&+$/, '');

        let url = location.protocol + '//' + location.host + location.pathname + '/ajax/api.php' + str;
        console.log(url);
        getResourse(url)
            .then(data => setCheckData(data))
            .catch(err => console.error(err));
    }

    function getInputData() {
        // const target = e.target; // Получаем элемент
        // const minValue = parseFloat(target.getAttribute('min')); // Получаем минимальное значение
        // const inputValue = parseFloat(target.value); // Получаем текущее значение поля ввода
            
        // if (inputValue > minValue) { // Сравниваем значения
        let formData = new FormData();
            inputFields.forEach(input => {
                if (input.name) { // Проверяем, что у инпута есть имя
                    formData.append(input.name, input.value);
                }
            });


            // let formData = new FormData(form);

            let str = '?';
            formData.forEach((value, key) => {
                str += key + '=' + value + '&';
            });
            str.replace(/&+$/, '');


            let url = location.protocol + '//' + location.host + location.pathname + '/ajax/api.php' + str;
            console.log(url);
            getResourse(url)
                .then(data => setInputData(data))
                .catch(err => console.error(err));
            
        // }

    }


    if (checkBoxes){
        checkBoxes.forEach((checkBox) => {
            checkBox.addEventListener('change', (e) => {
                getCheckData();
            });
        });
    }

    if (inputFields) {
        inputFields.forEach((inputField) => {
            inputField.addEventListener('input', (e) => {
                getInputData()
            });
        });
    }

    async function getResourse(url) {
        const res = await fetch(`${url}`, {
            method: "GET"
            // body: data
        });

        if(!res.ok) {
            throw new Error(`Could not fetch ${url}, status: ${res.status}`);
        }
        return await res.json();
    }

    getInputData();
    getCheckData();

})