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
