<script>

    let carousel = document.body.querySelector('.carousel');
    if (carousel) {

        let carouselContainer = carousel.querySelector('.carousel-container');
        let carouselContainerChildren = carousel.querySelectorAll('.img-carousel');
        let sequenceImgCarousel = [];
        let activeImgCarousel = 0;

        carouselContainerChildren.forEach((img) => {
            sequenceImgCarousel.push(img);
        });

        Object.keys(sequenceImgCarousel).forEach((key) => {
            if (sequenceImgCarousel[key].classList.contains('active')) {
                activeImgCarousel = key;
            }
        });

        let countImgInCarousel = sequenceImgCarousel.length - 1;

        document.body.querySelector('.btn-slider-prev').addEventListener('click', (btn) => {
            clearTimeout(timerNextImgInCarousel);
            PrevImgInCarousel();
            TimerNextImgInCarousel();
        });

        document.body.querySelector('.btn-slider-next').addEventListener('click', (btn) => {
            clearTimeout(timerNextImgInCarousel);
            NextImgInCarousel();
            TimerNextImgInCarousel();
        });

        let timerNextImgInCarousel;
        TimerNextImgInCarousel();
        function TimerNextImgInCarousel() {
            clearTimeout(timerNextImgInCarousel);
            timerNextImgInCarousel = setTimeout(() => {
                NextImgInCarousel();
                TimerNextImgInCarousel();
            }, 2500);
        }

        function NextImgInCarousel() {
            let key;
            if (parseInt(activeImgCarousel) === countImgInCarousel) {
                key = 0;
            } else {
                key = parseInt(activeImgCarousel) + 1;
            }
            let pos = 100 * key;
            carouselContainer.style.transform = "translateX(-"+pos+"%)";
            activeImgCarousel = key;
        }

        function PrevImgInCarousel() {
            let key;
            if (parseInt(activeImgCarousel) === 0) {
                key = countImgInCarousel;
            } else {
                key = parseInt(activeImgCarousel) - 1;
            }
            let pos = 100 * key;
            carouselContainer.style.transform = "translateX(-"+pos+"%)";
            activeImgCarousel = key;
        }

    }

    document.body.querySelector('.delete-value-search-input')?.addEventListener('click', (el) => {
        document.body.querySelector('.main-search-input').value = '';
        document.body.querySelector('.delete-value-search-input')?.hide();
    });

    if (document.body.querySelector('.main-search-input')?.value.length > 0) {
        document.body.querySelector('.delete-value-search-input')?.show();
    }

    document.body.querySelector('.main-search-input')?.addEventListener('input', (el) => {
        if (document.body.querySelector('.main-search-input').value.length > 0) {
            document.body.querySelector('.delete-value-search-input')?.show();
        } else {
            document.body.querySelector('.delete-value-search-input')?.hide();
        }
    });

    function changeRadioEffect(type) {
        if (type) {
            document.body.querySelector('.radio-effect>.slider').style.marginLeft = '50%';
            document.body.querySelector('.physical_user_input').hide();
            document.body.querySelector('.juridical_user_input').show();
        } else {
            document.body.querySelector('.radio-effect>.slider').style.marginLeft = '0';
            document.body.querySelector('.juridical_user_input').hide();
            document.body.querySelector('.physical_user_input').show();
        }
    }

    function NewUser() {
        let physical_user = document.getElementById('physical_user');
        let juridical_user = document.getElementById('juridical_user');

        let dataRAW = [];
        let data = [];
        if (physical_user.checked && !juridical_user.checked) {
            data['type_user'] = 'physical_user';
            dataRAW = document.body.querySelectorAll('.physical_user_input input');
        } else if (!physical_user.checked && juridical_user.checked) {
            data['type_user'] = 'juridical_user';
            dataRAW = document.body.querySelectorAll('.juridical_user_input input');
        }

        dataRAW.forEach((el) => {
            data[el.id] = el.value;
        })

        Ajax("{{route('registration')}}", 'post', data).then((response) => {
            if (response.status) {
                ModalWindow(response.message, () => {
                    location.href = "{{route('home-page')}}";
                });
            } else {
                ModalWindowFlash(response.message);
            }

        });
    }

    function RegistrationPage() {
        Ajax("{{route('registration-page')}}").then((response) => {
            ModalWindow(response);
            startTrackingNumberInput();
        });
    }

    function LoginPage() {
        Ajax("{{route('login-page')}}").then((response) => {
            ModalWindow(response);
        });
    }

    function Logout() {
        Ajax("{{route('logout')}}").then((response) => {
            location.reload();
        });
    }

    function UserOrdersPage() {
        location.href = "{{route('user-orders-page')}}";
    }

    function Login() {
        let login = document.getElementById('login').value;
        let password = document.getElementById('password').value;

        if(login === '' || password === '') {
            ModalWindowFlash('Заполните все поля');
            return false;
        }

        Ajax("{{route('login')}}", 'post', {login: login, password: password}).then((response) => {
            if (response.status) {
                location.reload();
            } else {
                ModalWindowFlash(response.message);
            }
        });
    }

    function PasswordRecoveryPage() {
        Ajax("{{route('password-recovery-page')}}").then((response) => {
            let modal = ModalWindow(response);
            modal.querySelector('.btn-password-recovery').addEventListener('click', () => {
                Ajax("{{route('password-recovery-request')}}", 'POST', {login: modal.querySelector('input[name="login"]').value}).then(() => {
                    modal.remove();
                    ModalWindow('Новый пароль отправлен на почту');
                });
            });
        });
    }

    /**
     * Плавное появление блоков если их видно на странице
     */
    function onEntry(entry) {
        entry.forEach(change => {
            if (change.isIntersecting) {
                change.target.classList.add('smooth-block-show');
            }
        });
    }
    let options = { threshold: [0.5] };
    let observer = new IntersectionObserver(onEntry, options);
    let elements = document.querySelectorAll('.smooth-block');
    for (let elm of elements) {
        observer.observe(elm);
    }

    function changeCountProductInBasket(product, typeChange, countProduct) {


        let productId = product.productId;
        let productPriceId = product.productPriceId;
        let productFullInformation = product.productFullInformation;
        let additionalServices = product.additionalServicesSelection;
        let additionalServicesSelectionPrice = product.additionalServicesSelectionPrice;

        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        } else {
            localStorageBasket = JSON.parse(localStorageBasket);
        }

        if (typeChange === undefined || typeChange === true) {
            if (localStorageBasket[productId] === undefined) {
                localStorageBasket[productId] = {}
                localStorageBasket[productId][productPriceId] = {
                    count: 1,
                    productId: productId,
                    productPriceId: productPriceId,
                    productFullInformation: productFullInformation,
                    additionalServices: additionalServices,
                    additionalServicesSelectionPrice: additionalServicesSelectionPrice,
                };
            } else {
                if (localStorageBasket[productId][productPriceId] === undefined) {
                    localStorageBasket[productId][productPriceId] = {
                        count: 1,
                        productId: productId,
                        productPriceId: productPriceId,
                        productFullInformation: productFullInformation,
                        additionalServices: additionalServices,
                        additionalServicesSelectionPrice: additionalServicesSelectionPrice,
                    };
                } else {
                    localStorageBasket[productId][productPriceId]['count'] = localStorageBasket[productId][productPriceId]['count'] + 1;
                }
            }
        } else if (typeChange === false) {
            localStorageBasket[productId][productPriceId]['count'] = localStorageBasket[productId][productPriceId]['count'] - 1;
        } else if (typeChange === 'input') {
            localStorageBasket[productId][productPriceId]['count'] = parseInt(countProduct);
            localStorageBasket[productId][productPriceId]['additionalServices'] = additionalServices;
            localStorageBasket[productId][productPriceId]['additionalServicesSelectionPrice'] = additionalServicesSelectionPrice;
        }

        if (localStorageBasket[productId][productPriceId]['count'] === 0) {
            delete localStorageBasket[productId][productPriceId];
        }

        localStorage.setItem('products_in_basket', JSON.stringify(localStorageBasket));
        UpdateCountProductsInBasket();

        return localStorageBasket[productId][productPriceId] === undefined ? 0 : localStorageBasket[productId][productPriceId]['count'];
    }

    function getCountProductsInBasket(){
        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        } else {
            localStorageBasket = JSON.parse(localStorageBasket);
        }

        let count = 0;
        let sum = 0;

        try {
            //крутим объект товаров
            Object.keys(localStorageBasket).forEach(productId => {
                // крутим объект цен товара
                Object.keys(localStorageBasket[productId]).forEach(productPriceId => {
                    let concreteProductCount = parseInt(localStorageBasket[productId][productPriceId]['count']);
                    let concreteProductPrice = parseInt(localStorageBasket[productId][productPriceId]['productFullInformation']['prices'][productPriceId]['price']);
                    let concreteProductSum = parseInt(concreteProductCount) * parseInt(concreteProductPrice);

                    let additionalServicePrice = 0;
                    Object.keys(localStorageBasket[productId][productPriceId]['additionalServicesSelectionPrice']).forEach((additionalService) => {
                        additionalServicePrice += parseInt(localStorageBasket[productId][productPriceId]['additionalServicesSelectionPrice'][additionalService]);
                    });

                    sum += concreteProductSum;
                    sum += additionalServicePrice;
                    count += concreteProductCount;
                });
            });
            localStorage.setItem('sumProductsPricesInBasket', sum);
            localStorage.setItem('products_in_basket', JSON.stringify(localStorageBasket));
        } catch (e) {
            localStorage.clear();
            count = 0;
            sum = 0;
            location.href = '/';
        }

        return count;
    }

    function GetAllProductsInBasket(){
        return localStorage.getItem('products_in_basket');
    }

    function ClearAllProductsInBasket(reload){
        localStorage.removeItem('products_in_basket');
        UpdateCountProductsInBasket(reload);
        return true;
    }

    UpdateCountProductsInBasket();
    function UpdateCountProductsInBasket(reload) {
        document.body.querySelectorAll('.count-item-in-bag').forEach((counterProductsInBasket) => {
            if (counterProductsInBasket) {
                let countProductsInBasket = getCountProductsInBasket();
                counterProductsInBasket.innerHTML = countProductsInBasket;
                if (countProductsInBasket > 0) {
                    counterProductsInBasket.show();
                } else {
                    counterProductsInBasket.hide();
                }
            }

        })
        UpdateCountProductsInBasketInBack(reload);
    }

    function UpdateCountProductsInBasketInBack(reload) {
        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        }

        Ajax("{{route('update-count-products')}}", 'post', {products_in_basket: localStorageBasket}).then(() => {
            if (reload === true) {
                location.reload();
            }
        });
    }

    let buttonsOpenFormSpecialOrder = document.body.querySelectorAll('.form-special-order');
    if (buttonsOpenFormSpecialOrder) {
        buttonsOpenFormSpecialOrder.forEach((button) => {
            button.addEventListener('click', () => {
                GenerationFormSpecialOrder();
            });
        });
    }

    function GenerationFormSpecialOrder() {
        Ajax("{{route('form-special-order')}}", 'get').then((response) => {
            ModalWindow(response);
        });
    }

    let searchButtonSmallScreen = document.body.querySelector('.search-button-small-screen-container');
    if (searchButtonSmallScreen) {
        searchButtonSmallScreen.addEventListener('click', () => {
            let searchContainer = document.body.querySelector('.search-container-header');
            searchContainer.showToggle();
            searchContainer.querySelector('input').focus();
        });
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

    function returnOnlyLetter(string) {
        return string.replace(/[^а-яА-ЯёЁa-zA-Z\s]/gi, '');
    }

    function returnOnlyPhoneNumber(string) {
        return string.replace(/[^0-9+()-]/g, '');
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
                let value = el.value;
                if (el.type === 'checkbox' || el.type === 'radio') {
                    value = el.checked
                }
                if (el.name === '') {
                    data[el.id] = value;
                } else {
                    if (data[el.name] === undefined) {
                        data[el.name] = [];
                    }
                    data[el.name].push(value);
                }
            }
        });
        return data;
    }

    const sberKey = '2blrrbk2ltqsubnqal041l27d4';

    let leftMenuButtons = document.body.querySelectorAll('.menu, .shadow-menu, .close-menu-button');
    leftMenuButtons.forEach((button) => {
        button.addEventListener('click', () => {
            let leftMenu = document.body.querySelector('.left-menu');
            if (leftMenu.classList.contains('hide')) {
                leftMenu.classList.remove('hide');
                setTimeout(() => {
                    leftMenu.querySelector('.left-menu-content-container').style.transform = "translateX(0%)"
                }, 50)
            } else {
                leftMenu.querySelector('.left-menu-content-container').style.transform = "translateX(-120%)"
                setTimeout(() => {
                    leftMenu.classList.add('hide');
                }, 300)
            }
        });
    });

    let additionalPhonesButtons = document.body.querySelectorAll('.additional-phones');
    additionalPhonesButtons.forEach((additionalPhonesButton) => {
        additionalPhonesButton.addEventListener('click', () => {
            let additionalPhones = additionalPhonesButton.dataset.additionalPhones;
            additionalPhones = additionalPhones.split(';');
            let containerAdditionalPhones = CreateElement('div', {});
            for (let i = 0; i < additionalPhones.length; i++) {
                CreateElement('div', {
                    content: '<a class="text-center" style="text-decoration: none;" href="tel:' + additionalPhones[i] + '">' + additionalPhones[i] + '</a>',
                }, containerAdditionalPhones);
            }
            ModalWindow(containerAdditionalPhones);
        });
    });

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

        let closeButtonSVG = '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6365 13.3996L13.4001 12.636L7.76373 6.99961L13.4001 1.36325L12.6365 0.599609L7.0001 6.23597L1.36373 0.599609L0.600098 1.36325L6.23646 6.99961L0.600098 12.636L1.36373 13.3996L7.0001 7.76325L12.6365 13.3996Z" fill="#FFFFFF"></path> </svg>';

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


    let regOnlyLetter = new RegExp("^[а-яА-ЯёЁa-zA-Z]+$");
    let regOnlyNumber = new RegExp("[0-9]");
    let regEmail = new RegExp("^[-\\w.]+@([A-z0-9][-A-z0-9]+\\.)+[A-z]{2,4}$");
    let regPassword = new RegExp("(?=^.{8,}$)((?=.*\\d)|(?=.*\\W+))(?![.\\n])(?=.*[A-Z])(?=.*[a-z]).*$");

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
        mainSearchInput.addEventListener('keypress', (event) => {
            let mainSearchValue = mainSearchInput.value;
            if (event.key === 'Enter' && mainSearchValue.length) {
                location.href = searchPage + '?search=' + mainSearchValue
            }
        });
    }

    function triggerEvent(elem, event) {
        elem.dispatchEvent(new Event(event));
    }

    // triggerEvent(buttonBackCall, 'click');

    document.body.querySelectorAll('.button-back-call').forEach((buttonBackCall) => {
        buttonBackCall.addEventListener('click', () => {
            requestCallBack()
        });
    });

    function requestCallBack(comment = '') {
        let callbackWindowContent = CreateElement('div', {
            class: 'flex-column-center flex-column'
        });
        CreateElement('label', {
            content: 'Имя',
            class: 'mb-5'
        }, callbackWindowContent);
        let name = CreateElement('input', {class: 'mb-10 black-input'}, callbackWindowContent);

        CreateElement('label', {
            content: 'Номер телефона для связи',
            class: 'mb-5'
        }, callbackWindowContent);
        let phone = CreateElement('input', {class: 'mb-10 black-input'}, callbackWindowContent);

        CreateElement('label', {
            content: 'Комментарий',
            class: 'mb-5'
        }, callbackWindowContent);
        let comments = CreateElement('textarea', {class: 'mb-10 black-input', content: comment, attr: {cols: 30, rows: 7}}, callbackWindowContent);

        CreateElement('button', {
            content: 'Отправить',
            class: 'button-blue mt-5',
            events: {
                click: () => {
                    if (phone.value.length < 10) {
                        ModalWindowFlash('Не верный номер');
                    } else if (name.value.length < 1) {
                        ModalWindowFlash('Укажите имя');
                    } else {
                        modalWindow.remove()
                        ModalWindowFlash("Мы скоро с вами свяжемся")
                        ym(93122517, "reachGoal", "call-order")
                        Ajax(createCallbackOrderRequestRoute, "POST", {
                            phone: phone.value,
                            name: name.value,
                            comments: comments.value,
                        })

                    }
                }
            }
        }, callbackWindowContent);
        let modalWindow = ModalWindow(callbackWindowContent);
    }

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

    function ToggleShow() {
        let allToggleButtons = document.body.querySelectorAll('.toggle-button');
        allToggleButtons.forEach((toggleButton) => {
            let toggleContainerSelector = toggleButton.dataset.toogle;
            let toggleContainer = document.body.querySelector('.' + toggleContainerSelector);
            toggleContainer.hide();
            toggleButton.addEventListener('click', () => {
                toggleContainer.showToggle();
            });
        });
    }
    ToggleShow()

    const slider = (sliderContainer, autoSlide = true) => {

        const insideElements = sliderContainer.querySelectorAll(":scope > *:not(.slider-button)")
        if (insideElements.length < 2) {
            return
        }

        const prevSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16"> <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"></path> </svg>`
        const nextSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16"> <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path> </svg>`

        // const sliderContainer = document.body.querySelector(".slider")
        sliderContainer.classList.add("carousel-parent")

        if (!document.querySelector('[data-carousel="true"]')) {
            const styleElement = document.createElement("style")
            styleElement.dataset.carousel = "true"
            styleElement.innerHTML = `.carousel-parent { position: relative; overflow: hidden; display: flex; align-items: center; } .carousel-parent .prev-button { cursor: pointer; position: absolute; top: calc(50% - 24px); left: 12px; opacity: 0.3; } .carousel-parent .next-button { cursor: pointer; position: absolute; top: calc(50% - 24px); right: 12px; opacity: 0.3; } .carousel-parent .prev-button:hover, .carousel-parent .next-button:hover { transform: scale(1.1); opacity: 0.8; } .carousel-item { position: relative; display: none; float: left; width: 100%; /*min-width: 100%;*/ margin-right: -100%; backface-visibility: hidden; transition: transform .6s ease-in-out; } .carousel-item.active, .carousel-item-next, .carousel-item-prev { display: block; } /* rtl:begin:ignore */ .carousel-item-next:not(.carousel-item-start), .active.carousel-item-end { transform: translateX(100%); } .carousel-item-prev:not(.carousel-item-end), .active.carousel-item-start { transform: translateX(-100%); }`
            document.head.append(styleElement)
        }

        const prevButton = document.createElement("div")
        prevButton.innerHTML = prevSVG
        prevButton.classList.add("slider-button")
        prevButton.classList.add("prev-button")
        // prevButton.classList.add("hide")
        sliderContainer.append(prevButton)

        const nextButton = document.createElement("div")
        nextButton.innerHTML = nextSVG
        nextButton.classList.add("next-button")
        nextButton.classList.add("slider-button")
        // nextButton.classList.add("hide")
        sliderContainer.append(nextButton)

        insideElements.forEach((insideElement, index) => {
            insideElement.index = index
            insideElement.classList.add("carousel-item")
            if (index === 0) {
                insideElement.classList.add("active")
            }
        })

        nextButton.addEventListener("click", () => {
            clearInterval(autoClickTimer)
            const currentImg = sliderContainer.querySelector(":scope > .active")
            let nextIndex = currentImg.index + 1
            nextIndex = nextIndex >= insideElements.length ? 0 : nextIndex
            insideElements.forEach((insideElement) => {
                if (currentImg.index === insideElement.index) {
                    insideElement.classList.add("carousel-item-start")
                    setTimeout(() => {
                        insideElement.classList.remove("active")
                        insideElement.classList.remove("carousel-item-start")
                    }, 1000)
                }

                if (insideElement.index === nextIndex) {
                    insideElement.classList.add("carousel-item-next")
                    setTimeout(() => {
                        insideElement.classList.add("carousel-item-start")
                    }, 10)
                    setTimeout(() => {
                        insideElement.classList.add("active")
                        insideElement.classList.remove("carousel-item-next")
                        insideElement.classList.remove("carousel-item-start")
                    }, 1000)
                }
            })
            if (autoSlide) {
                autoClickTimer = setInterval(() => {
                    nextButton.click()
                }, 5000)
            }
        })

        prevButton.addEventListener("click", () => {
            clearInterval(autoClickTimer)
            const currentImg = sliderContainer.querySelector(":scope > .active")
            let prevIndex = currentImg.index - 1
            prevIndex = prevIndex < 0 ? insideElements.length - 1 : prevIndex
            insideElements.forEach((insideElement) => {
                if (currentImg.index === insideElement.index) {
                    insideElement.classList.add("carousel-item-end")
                    setTimeout(() => {
                        insideElement.classList.remove("active")
                        insideElement.classList.remove("carousel-item-end")
                    }, 1000)
                }

                if (insideElement.index === prevIndex) {
                    insideElement.classList.add("carousel-item-prev")
                    setTimeout(() => {
                        insideElement.classList.add("carousel-item-end")
                    }, 10)
                    setTimeout(() => {
                        insideElement.classList.add("active")
                        insideElement.classList.remove("carousel-item-prev")
                        insideElement.classList.remove("carousel-item-end")
                    }, 1000)
                }
            })
            if (autoSlide) {
                autoClickTimer = setInterval(() => {
                    nextButton.click()
                }, 5000)
            }
        })

        let autoClickTimer
        if (autoSlide) {
            autoClickTimer = setInterval(() => {
                nextButton.click()
            }, 5000)
        }
    }

    document.body.querySelectorAll(".slider").forEach((element) => {slider(element)})

</script>
