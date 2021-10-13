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

let mainMenuCloseButton = document.body.querySelector('.close-menu-button')
if (mainMenuCloseButton) {
    mainMenuCloseButton.addEventListener('click', () => {
        document.body.querySelector('.left-menu').showToggle();
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
        },
        content: content,
    }, modalWindowContainer);

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
    return new Promise(function(resolve, reject) {
        let formData = new FormData();
        if ( typeof(method) === "undefined" || method === null ) {
            method = 'get';
        }

        if ( typeof(formDataRAW) === "undefined" || formDataRAW === null ) {
            formDataRAW = {};
        } else {
            Object.keys(formDataRAW).forEach((key) => {
                formData.append(key, formDataRAW[key]);
            })
        }

        let xhr = new XMLHttpRequest();
        xhr.open(method, url, true);

        xhr.onload = function() {
            if (this.status === 200) {
                try {
                    resolve(JSON.parse(this.response));
                } catch (e) {
                    resolve(this.response);
                }

            } else {
                let error = new Error(this.statusText);
                error.code = this.status;
                reject(error);
            }
        };

        xhr.onerror = function() {
            reject(new Error("Network Error"));
        };

        xhr.send(formData);
    });
}

document.body.querySelectorAll('.menu-category, .expander-menu-category').forEach((category) => {
    category.addEventListener('click', (el) => {
        if (category.closest('.menu-item-container').querySelector('.menu-category-detail').classList.contains('hide')) {
            category.closest('.menu-item-container').querySelector('.menu-category-detail').show();
            category.closest('.menu-item-container').querySelector('.expander-menu-category').classList.add('rotation-90');
        } else {
            category.closest('.menu-item-container').querySelector('.menu-category-detail').hide();
            category.closest('.menu-item-container').querySelector('.expander-menu-category').classList.remove('rotation-90');
        }
    });
});

/**
 * Проверка и сбор данных из формы
 */
function getDataFormContainer(container, validate) {
    if (validInputEmpty(container) || !!!validate) {
        let data = [];
        document.body.querySelectorAll('.' + container + ' input, .' + container + ' select, .' + container + ' textarea').forEach((el) => {
            if (el.type === 'file') {
                for (let i = 0; i < el.files.length; i++) {
                    data[el.id + '-' + i] = el.files[i];
                }
            } else {
                data[el.id] = el.value;
            }
        });
        return data;
    } else {
        return false;
    }
}

function validInputEmpty(container) {
    let validate = true;
    document.body.querySelectorAll('.' + container + ' .need-validate').forEach((element) => {
        let strValue = element.value;
        if (strValue === '' || strValue === null || strValue === undefined) {
            validate = false;
            element.classList.add('border-red');
            element.addEventListener('input', () => {
                FixValidInput(element);
            }, {once: true});
        }
    });
    return validate;
}

function FixValidInput(element) {
    let strValue = element.value;
    if (strValue !== '' && strValue !== null && strValue !== undefined) {
        element.classList.remove('border-red');
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
            phoneInput.addEventListener('keypress', (event) => {
                if (event.keyCode < 47 || event.keyCode > 57) {
                    event.preventDefault();
                }

                if (phoneInput.value.length === 2) {
                    phoneInput.value = phoneInput.value + "(";
                } else if (phoneInput.value.length === 6) {
                    phoneInput.value = phoneInput.value + ")-";
                } else if (phoneInput.value.length === 11 || phoneInput.value.length === 14) {
                    phoneInput.value = phoneInput.value + "-";
                }
            });

            phoneInput.addEventListener('keyup', (event) => {
                let number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                if (number.indexOf(event.key) === -1) {
                    if ((event.key === 'Backspace' || event.key === 'Delete') && phoneInput.value.length <= 2) {
                        phoneInput.value = '+7';
                        phoneInput.selectionStart = phoneInput.value.length;
                    }
                    event.preventDefault();
                } else {
                    if (phoneInput.value.length < 3) {
                        phoneInput.value = '+7(' + event.key;
                    }
                }
            });

            phoneInput.addEventListener('focus', (event) => {
                if (phoneInput.value.length === 0) {
                    phoneInput.value = '+7';
                    phoneInput.selectionStart = phoneInput.value.length;
                }
            });

            phoneInput.addEventListener('click', (event) => {
                if (phoneInput.selectionStart < 2) {
                    phoneInput.selectionStart = phoneInput.value.length;
                }
                if (event.key === 'Backspace' && phoneInput.value.length <= 2) {
                    event.preventDefault();
                }
            });

            phoneInput.addEventListener('blur', () => {
                if (phoneInput.value === '+7') {
                    phoneInput.value = '';
                }
            });

            phoneInput.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && phoneInput.value.length <= 2) {
                    phoneInput.value = '+7';
                    phoneInput.selectionStart = phoneInput.value.length;
                    event.preventDefault();
                }
            });
        }
    });
}
