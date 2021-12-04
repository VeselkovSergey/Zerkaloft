/* JS */
let mainMenu = document.body.querySelector('.menu');
if (mainMenu) {
    mainMenu.addEventListener('click', () => {
        document.body.querySelector('.left-menu').showToggle();
    });
}

let mainMenuShadow = document.body.querySelector('.shadow-menu');
if (mainMenuShadow) {
    mainMenuShadow.addEventListener('click', () => {
        document.body.querySelector('.left-menu').showToggle();
    });
}

let mainMenuCloseButton = document.body.querySelector('.close-menu-button');
if (mainMenuCloseButton) {
    mainMenuCloseButton.addEventListener('click', () => {
        document.body.querySelector('.left-menu').showToggle();
    });
}

let additionalPhonesButton = document.body.querySelector('.additional-phones');
if (additionalPhonesButton) {
    additionalPhonesButton.addEventListener('click', () => {
        let additionalPhones = additionalPhonesButton.dataset.additionalPhones;
        additionalPhones = additionalPhones.split(';');
        let containerAdditionalPhones = CreateElement('div', {});
        for (let i = 0; i < additionalPhones.length; i++) {
            CreateElement('div', {
                content: '<a class="text-center" style="text-decoration: none;" href="tel:' + additionalPhones[i] + '">' + additionalPhones[i] + '</a>',
                class: 'mb-5'
            }, containerAdditionalPhones);
        }
        ModalWindow(containerAdditionalPhones);
    });
}

function LoaderShow() {
    let loader = document.createElement("div");
    loader.className = 'loader';
    loader.innerHTML = '<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
    document.body.prepend(loader);
}

function LoaderHide() {
    document.body.querySelector('.loader').remove();
}

function ModalWindow(content, closingCallback) {

    let closeButtonSVG = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6365 13.3996L13.4001 12.636L7.76373 6.99961L13.4001 1.36325L12.6365 0.599609L7.0001 6.23597L1.36373 0.599609L0.600098 1.36325L6.23646 6.99961L0.600098 12.636L1.36373 13.3996L7.0001 7.76325L12.6365 13.3996Z" fill="#000000"></path> </svg>';

    let modalWindowComponentContainer = CreateElement('div', {
        attr: {
            class: 'modal-window-component-container',
        }
    });

    let modalWindowComponent = CreateElement('div', {attr: {class: 'modal-window-component'}}, modalWindowComponentContainer);

    let modalWindowShadow = CreateElement('div', {
        attr: {class: 'modal-window-shadow'}, events: {
            click: () => {
                closingCallback ? closingCallback() : '';
                modalWindowComponentContainer.remove();
            }
        }
    }, modalWindowComponent);

    let modalWindowContainer = CreateElement('div', {
        attr: {
            class: 'modal-window-content-container',
        }
    }, modalWindowComponent);

    let modalWindowCloseButton = CreateElement('div', {
        attr: {
            class: 'modal-window-close-button',
        },
        content: closeButtonSVG,
        events: {
            click: () => {
                closingCallback ? closingCallback() : '';
                modalWindowComponentContainer.remove();
            }
        }
    }, modalWindowContainer);

    let modalWindowContent = CreateElement('div', {
        attr: {
            class: 'modal-window-content',
        }
    }, modalWindowContainer);

    if (typeof content === 'string') {
        modalWindowContent.innerHTML = content
    } else {
        modalWindowContent.append(content)
    }

    document.body.append(modalWindowComponentContainer);

    return modalWindowComponentContainer;
}

function ModalWindowFlash(content, timer = 2000) {
    let modalWindow = ModalWindow(content)
    setTimeout(() => {
        modalWindow.remove();
    }, timer);
}

function ShowFlashMessage(msg, time) {
    time = time === undefined ? 2500 : time
    let containerFlashMessage = document.body.querySelector('.flash-message');
    containerFlashMessage.innerHTML = msg;
    containerFlashMessage.show();
    setTimeout(() => {
        containerFlashMessage.hide();
    }, time);
}

function Ajax(url, method, formDataRAW) {
    return new Promise(function (resolve, reject) {
        let formData = new FormData();
        if (typeof (method) === "undefined" || method === null) {
            method = 'get';
        }

        if (typeof (formDataRAW) === "undefined" || formDataRAW === null) {
            formDataRAW = {};
        } else {
            Object.keys(formDataRAW).forEach((key) => {

                if (Array.isArray(formDataRAW[key])) {

                    formDataRAW[key].forEach((value) => {
                        formData.append(key, value);
                    });

                } else {
                    formData.append(key, formDataRAW[key]);
                }
            });
        }


        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);

        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrf_token);

        xhr.onload = function () {
            if (this.status === 200) {
                try {
                    resolve(JSON.parse(this.response));
                } catch {
                    resolve(this.response);
                }
            } else {
                var error = new Error(this.statusText);
                error.code = this.status;
                reject(error);
            }
        };

        xhr.onerror = function () {
            reject(new Error("Network Error"));
        };

        xhr.send(formData);
    });
}

document.body.querySelectorAll('.menu-category, .expander-menu-category').forEach((category) => {
    category.addEventListener('click', () => {
        if (category.closest('.menu-category-container').querySelector('.menu-category-detail').classList.contains('hide')) {
            category.closest('.menu-category-container').querySelector('.menu-category-detail').show();
            category.closest('.menu-category-container').querySelector('.expander-menu-category').classList.add('rotation-90');
        } else {
            category.closest('.menu-category-container').querySelector('.menu-category-detail').hide();
            category.closest('.menu-category-container').querySelector('.expander-menu-category').classList.remove('rotation-90');
        }
    });
});

/**
 * Проверка и сбор данных из формы
 */
function GetDataFormContainer(container, startElement = document.body) {
    let data = [];
    startElement.querySelectorAll('.' + container + ' input, .' + container + ' select, .' + container + ' textarea').forEach((el) => {
        if (el.type === 'file') {
            for (let i = 0; i < el.files.length; i++) {
                data[el.id + '-' + i] = el.files[i];
            }
        } else {
            if (el.name === '') {
                data[el.id] = el.value;
            } else {
                if (data[el.name] === undefined) {
                    data[el.name] = [];
                }
                let value = el.value;
                if (el.type === 'checkbox' || el.type === 'radio') {
                    value = el.checked
                }
                data[el.name].push(value);
            }
        }
    });
    return data;
}

function CheckingFieldForEmptiness(container, showFlashMessage = false) {
    let check = true;
    document.body.querySelectorAll('.' + container + ' .need-validate').forEach((element) => {
        let strValue = element.value;
        if (strValue === '' || strValue === null || strValue === 'null' || strValue === undefined) {
            check = false;
            element.classList.add('invalid-value');
            element.addEventListener('input', () => {
                FieldCorrection(element);
            }, {once: true});
        }
    });
    if (!check && showFlashMessage) {
        ShowFlashMessage('Заполните все поля!');
    }
    return check;
}

function FieldCorrection(element) {
    let strValue = element.value;
    if (strValue !== '' && strValue !== null && strValue !== 'null' && strValue !== undefined) {
        element.classList.remove('invalid-value');
        element.removeEventListener('input', null);
    }
}

let regOnlyLetter = new RegExp("^[а-яА-ЯёЁa-zA-Z]+$");
let regOnlyNumber = new RegExp("[0-9]");
let regEmail = new RegExp("^[-\\w.]+@([A-z0-9][-A-z0-9]+\\.)+[A-z]{2,4}$");
let regPassword = new RegExp("(?=^.{8,}$)((?=.*\\d)|(?=.*\\W+))(?![.\\n])(?=.*[A-Z])(?=.*[a-z]).*$");

function returnOnlyLetter(string) {
    return string.replace(/[^а-яА-ЯёЁa-zA-Z\s]/gi, '');
}

function returnOnlyPhoneNumber(string) {
    return string.replace(/[^0-9+()-]/g, '');
}

function startTrackingNumberInput() {
    document.body.querySelectorAll('.phone-mask').forEach((element) => {

        let phoneInput = element;

        if (phoneInput !== null) {

            let number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'ArrowTop', 'ArrowDown'];

            phoneInput.addEventListener('keydown', (event) => {
                if (number.indexOf(event.key) === -1) {
                    event.preventDefault();
                }
            });

            let timer;
            phoneInput.addEventListener('keyup', (event) => {
                if ((event.key !== 'Backspace' && event.key !== 'Delete')) {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        let rawPhone = phoneInput.value;
                        let onlyNumber = rawPhone.replace(/[^0-9]/g, '');
                        let formatPhone = '';
                        for (let i = 0; i < onlyNumber.length; i++) {

                            let char = onlyNumber.charAt(i);

                            if (i === 0) {
                                formatPhone += '+';
                                if (char !== '7') {
                                    formatPhone += '7';
                                }
                                if (char === '8') {
                                    char = '';
                                }
                            } else if (i === 1) {
                                formatPhone += '(';
                            } else if (i === 4) {
                                formatPhone += ')';
                            } else if (i === 7 || i === 9) {
                                formatPhone += '-';
                            }

                            if (i <= 10) {
                                formatPhone += char;
                            }

                        }
                        phoneInput.value = formatPhone;

                    }, 50);
                }
            });
        }
    });
}

let fieldsWithSuggestionsAddress = document.body.querySelectorAll('.suggestions-address');
fieldsWithSuggestionsAddress.forEach((filed) => {
    if (filed !== null) {
        filed.addEventListener('input', (event) => {
            let searchAddress = event.target.value;
            SuggestionsAddress(searchAddress, filed);
        });
    }
});

let timerSuggestionsAddress = null;

function SuggestionsAddress(query, inputSuggestions, callback) {

    if (query.length < 4) {
        return
    }

    clearTimeout(timerSuggestionsAddress)

    timerSuggestionsAddress = setTimeout(() => {

        const url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address";
        const token = "980b289f33c7bafda2d4007c51a2d45d6c980425";

        let data = {
            query: query,
            restrict_value: true,
            count: 3,
        }

        let options = {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": "Token " + token
            },
            body: JSON.stringify(data)
        }

        fetch(url, options)
            .then(response => response.text())
            .then(result => ContainerSuggestionsGeneration(result, inputSuggestions))
            .catch(error => console.log("error", error));
    }, 500)
}

let timerSuggestionsProducts = null;

function SuggestionsProducts(query, inputSuggestions, callback, additionalData) {

    clearTimeout(timerSuggestionsProducts)

    timerSuggestionsProducts = setTimeout(() => {
        Ajax(suggestionsProducts, 'post', {context: query}).then((response) => {
            if (response.status) {
                let result = response.result;
                ContainerSuggestionsGeneration(JSON.stringify(result), inputSuggestions, callback, additionalData)
            }
        });
    }, 500)
}

let mainSearchInput = document.body.querySelector('.main-search-input');
if (mainSearchInput) {
    mainSearchInput.addEventListener('input', (event) => {
        let mainSearch = event.target;
        let mainSearchValue = mainSearch.value;
        let containerMainSearch = mainSearch.closest('.search-container-header');
        let containerSuggestions = containerMainSearch.querySelector('.container-suggestions');

        if (containerSuggestions !== null && mainSearchValue === '') {
            containerSuggestions.remove();
        }

        SuggestionsProducts(mainSearchValue, mainSearch, (event) => {
            let productLink = event.target.dataset.link;
            window.open(
                productLink,
                '_blank'
            );
        }, {additionalData: 'link'});
    });
}

function triggerEvent(elem, event) {
    elem.dispatchEvent(new Event(event));
}

// triggerEvent(buttonBackCall, 'click');

document.body.querySelectorAll('.button-back-call').forEach((buttonBackCall) => {
    buttonBackCall.addEventListener('click', () => {
        let callbackWindowContent = CreateElement('div', {
            class: 'flex-column-center'
        });
        CreateElement('label', {
            content: 'Имя',
            class: 'mb-5'
        }, callbackWindowContent);
        CreateElement('input', {}, callbackWindowContent);

        CreateElement('label', {
            content: 'Номер телефона для обратной связи',
            class: 'mb-5'
        }, callbackWindowContent);
        let input = CreateElement('input', {}, callbackWindowContent);

        CreateElement('button', {
            content: 'Отправить',
            class: 'button-blue mt-5',
            events: {
                click: () => {
                    // #todo отправить на сервер
                    if (input.value.length < 10) {
                        ModalWindowFlash('Не верный номер');
                    } else {
                        modalWindow.remove();
                        ModalWindowFlash('Мы скоро с вами свяжемся');
                    }
                }
            }
        }, callbackWindowContent);
        let modalWindow = ModalWindow(callbackWindowContent);
    });
});

function ContainerSuggestionsGeneration(result, inputSuggestions, callback, additionalData) {
    result = JSON.parse(result).suggestions;

    let parentInputSuggestions = inputSuggestions.parentNode;
    let oldSuggestionsElement = parentInputSuggestions.querySelector('.container-suggestions');
    if (oldSuggestionsElement !== null) {
        oldSuggestionsElement.remove();
    }

    let containerSuggestions = document.createElement('div');
    containerSuggestions.className = 'container-suggestions w-100 pos-rel';

    let containerSuggestionsAbsolutePosition = document.createElement('div');
    containerSuggestionsAbsolutePosition.className = 'container-suggestions-pos-abs pos-abs top-0 left-0 w-100 border-radius-5';
    if (result.length === 0) {
        let itemSuggestion = document.createElement('div');
        itemSuggestion.className = 'p-5';
        itemSuggestion.innerHTML = 'Нет результатов удовлетворяющих запросу';
        containerSuggestionsAbsolutePosition.append(itemSuggestion);
    } else {
        result.forEach((item) => {
            let itemSuggestion = document.createElement('div');
            itemSuggestion.className = 'p-5 suggestion-item';
            itemSuggestion.innerHTML = item.value;
            if (additionalData) {
                Object.keys(additionalData).forEach((key) => {
                    itemSuggestion.dataset[additionalData[key]] = item[additionalData[key]];
                });
            }
            containerSuggestionsAbsolutePosition.append(itemSuggestion);

            if (callback) {
                itemSuggestion.addEventListener('mousedown', callback);
            } else {
                itemSuggestion.addEventListener('mousedown', () => {
                    console.log(inputSuggestions)
                    inputSuggestions.value = itemSuggestion.innerHTML;
                    containerSuggestions.remove();
                    inputSuggestions.focus();
                });
            }
        });
    }

    inputSuggestions.addEventListener('blur', () => {
        containerSuggestions.remove();
    });

    containerSuggestions.append(containerSuggestionsAbsolutePosition);

    inputSuggestions.insertAdjacentElement('afterEnd', containerSuggestions);
}
