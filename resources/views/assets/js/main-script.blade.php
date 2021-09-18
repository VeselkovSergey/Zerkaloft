{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>--}}
<script>

    function ShowElement(el) {
        el.classList.add('show-el');
        el.classList.remove('hide-el');
    }

    function HideElement(el) {
        el.classList.add('hide-el');
        el.classList.remove('show-el');
    }

    function ShowLoader() {
        let loader = document.createElement("div");
        loader.className = 'loader';
        loader.innerHTML = '<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
        document.body.prepend(loader);
    }

    function HideLoader() {
        document.body.querySelector('.loader').remove();
    }

    // ShowLoader();
    // setTimeout(() => {
    //     HideLoader();
    // }, 1000);

    function ShowModal(content) {
        const modal = document.body.querySelector('.modal');
        modal.classList.add('show-el');
        modal.classList.remove('hide-el');
        modal.querySelector('.modal-content').innerHTML = content;
    }

    function HideModal() {
        const modal = document.body.querySelector('.modal');
        modal.classList.remove('show-el');
        modal.classList.add('hide-el');
    }

    function ShowModalFlash(content, closed) {
        const modalFlash = document.body.querySelector('.modal-flash-message');
        modalFlash.classList.add('show-el');
        modalFlash.classList.remove('hide-el');
        modalFlash.querySelector('.modal-flash-message-content').innerHTML = content;
        if (closed) {
            setTimeout(() => {
                HideModalFlash();
            }, 1500)
        }
    }

    function HideModalFlash() {
        const modalFlash = document.body.querySelector('.modal-flash-message');
        modalFlash.classList.remove('show-el');
        modalFlash.classList.add('hide-el');
    }

    // let btnMenu = document.body.querySelector('.menu-btn');
    // btnMenu.addEventListener('click', (el) => {
    //     el.stopPropagation();
    //     document.body.querySelector('.menu-container').classList.toggle('show-el');
    // });

    // document.body.addEventListener('click', (el) => {
    //     if (document.body.querySelector('.menu-container').classList.contains('show-el')) {
    //         document.body.querySelector('.menu-container').classList.remove('show-el');
    //     }
    // });

</script>

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
            DeactivateAllImgCarousel();
            let key;
            if (parseInt(activeImgCarousel) === countImgInCarousel) {
                key = 0;
            } else {
                key = parseInt(activeImgCarousel) + 1;
            }
            sequenceImgCarousel[key].classList.add('active');
            activeImgCarousel = key;
        }

        function PrevImgInCarousel() {
            DeactivateAllImgCarousel();
            let key;
            if (parseInt(activeImgCarousel) === 0) {
                key = countImgInCarousel;
            } else {
                key = parseInt(activeImgCarousel) - 1;
            }
            sequenceImgCarousel[key].classList.add('active');
            activeImgCarousel = key;
        }

        function DeactivateAllImgCarousel() {
            carouselContainerChildren.forEach((img) => {
                if (img.classList.contains('active')) {
                    img.classList.remove('active');
                }
            });
        }

    }

    document.body.querySelector('.delete-value-search-input').addEventListener('click', (el) => {
        document.body.querySelector('.main-search-input').value = '';
        document.body.querySelector('.delete-value-search-input').classList.add('hide-el');
        document.body.querySelector('.delete-value-search-input').classList.remove('show-el');
    });

    if (document.body.querySelector('.main-search-input').value.length > 0) {
        document.body.querySelector('.delete-value-search-input').classList.add('show-el');
        document.body.querySelector('.delete-value-search-input').classList.remove('hide-el');
    }

    document.body.querySelector('.main-search-input').addEventListener('input', (el) => {
        if (document.body.querySelector('.main-search-input').value.length > 0) {
            document.body.querySelector('.delete-value-search-input').classList.add('show-el');
            document.body.querySelector('.delete-value-search-input').classList.remove('hide-el');
        } else {
            document.body.querySelector('.delete-value-search-input').classList.add('hide-el');
            document.body.querySelector('.delete-value-search-input').classList.remove('show-el');
        }

    });

    document.body.querySelectorAll('.title-category-container').forEach((category) => {
        category.addEventListener('click', (el) => {
            if (category.parentNode.querySelector('.children-category').classList.contains('show-el')) {
                category.parentNode.querySelector('.children-category').classList.remove('show-el');
                category.parentNode.querySelector('.children-category').classList.add('hide-el');
                category.parentNode.querySelector('.expander-menu-category').classList.remove('rotation-90');
            } else {
                category.parentNode.querySelector('.children-category').classList.add('show-el');
                category.parentNode.querySelector('.children-category').classList.remove('hide-el');
                category.parentNode.querySelector('.expander-menu-category').classList.add('rotation-90');
            }
        })
    });

    document.body.querySelectorAll('.title-subcategory-container').forEach((category) => {
        category.addEventListener('click', (el) => {
            if (category.parentNode.querySelector('.children-subcategory').classList.contains('show-el')) {
                category.parentNode.querySelector('.children-subcategory').classList.remove('show-el');
                category.parentNode.querySelector('.children-subcategory').classList.add('hide-el');
                category.parentNode.querySelector('.expander-menu-subcategory').classList.remove('rotation-90');
            } else {
                category.parentNode.querySelector('.children-subcategory').classList.add('show-el');
                category.parentNode.querySelector('.children-subcategory').classList.remove('hide-el');
                category.parentNode.querySelector('.expander-menu-subcategory').classList.add('rotation-90');
            }
        })
    });

    {{--document.body.querySelector('.container-profile').addEventListener('click', (el) => {--}}
    {{--    ShowLoader();--}}
    {{--    Ajax("{{!\Illuminate\Support\Facades\Auth::check() ? route('login-page') : route('logout')}}").then((response) => {--}}
    {{--        @if(\Illuminate\Support\Facades\Auth::check())--}}
    {{--        location.reload();--}}
    {{--        @else--}}
    {{--        ShowModal(response);--}}
    {{--        @endif--}}
    {{--        HideLoader();--}}
    {{--    });--}}
    {{--});--}}

    document.body.querySelector('.modal-close-button').addEventListener('click', (el) => {
        HideModal();
    });

    // document.body.querySelector('.window-modal').addEventListener('click', (el) => {
    //     el.stopPropagation();
    // });


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

    function changeRadioEffect(type) {
        if (type) {
            document.body.querySelector('.radio-effect').style.marginLeft = '50%';
            document.body.querySelector('.juridical_user_input').classList.add('show-el');
            document.body.querySelector('.juridical_user_input').classList.remove('hide-el');
            document.body.querySelector('.physical_user_input').classList.remove('show-el');
            document.body.querySelector('.physical_user_input').classList.add('hide-el');
        } else {
            document.body.querySelector('.radio-effect').style.marginLeft = '10px';
            document.body.querySelector('.physical_user_input').classList.add('show-el');
            document.body.querySelector('.physical_user_input').classList.remove('hide-el');
            document.body.querySelector('.juridical_user_input').classList.remove('show-el');
            document.body.querySelector('.juridical_user_input').classList.add('hide-el');
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
                ShowModal('<div style="background-color: white; padding: 25px; font-size: 20px;">' + response.message + '</div>');
                document.body.querySelector('.modal-close-button').addEventListener('click', (el) => {
                    location.href = "{{route('home-page')}}";
                });
            } else {
                ShowModalFlash(response.message, true);
            }

        });
    }

    function RegistrationPage() {
        Ajax("{{route('registration-page')}}").then((response) => {
            ShowModal(response);
            startTrackingNumberInput();
        });
    }

    function LoginPage() {
        Ajax("{{route('login-page')}}").then((response) => {
            ShowModal(response);
        });
    }

    function Logout() {
        Ajax("{{route('logout')}}").then((response) => {
            location.reload();
        });
    }

    {{--function ProfilePage() {--}}
    {{--    location.href = "{{route('profile-page')}}";--}}
    {{--}--}}

    function UserOrdersPage() {
        location.href = "{{route('user-orders-page')}}";
    }

    function Login() {
        let login = document.getElementById('login').value;
        let password = document.getElementById('password').value;

        if(login === '' || password === '') {
            ShowModalFlash('Заполните все поля', true);
            return false;
        }

        Ajax("{{route('login')}}", 'post', {login: login, password: password}).then((response) => {
            if (response.status) {
                location.reload();
            } else {
                ShowModalFlash(response.message, true);
            }
        });
    }

    function PasswordRecoveryPage() {
        Ajax("{{route('password-recovery-page')}}").then((response) => {
            ShowModal(response);
        });
    }

</script>

<script>
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

</script>

<script>

    function changeCountProductInBasket(product, typeChange, countProduct) {

        let productId = product.productId;
        let productPriceId = product.productPriceId;
        let productPriceText = product.productPriceText;

        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        } else {
            localStorageBasket = JSON.parse(localStorageBasket);
        }

        if (typeChange === undefined || typeChange === true) {
            if (localStorageBasket['productId_' + productId] === undefined) {
                localStorageBasket['productId_' + productId] = {}
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] = {};
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = 1;
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['text'] = productPriceText;
            } else {
                if (localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] === undefined) {
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] = {};
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = 1;
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['text'] = productPriceText;
                } else {
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] + 1;
                }
            }
        } else if (typeChange === false) {
            localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] - 1;
        } else if (typeChange === 'input') {
            localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = countProduct;
        }

        if (localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] === 0) {
            delete localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId];
        }

        localStorage.setItem('products_in_basket', JSON.stringify(localStorageBasket));
        UpdateCountProductsInBasket();

        return localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] === undefined ? 0 : localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'];
    }

    function getCountProductsInBasket(){
        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        } else {
            localStorageBasket = JSON.parse(localStorageBasket);
        }

        let count = 0;

        //крутим объект товаров
        Object.keys(localStorageBasket).forEach(productId => {
            // крутим объект цен товара
            Object.keys(localStorageBasket[productId]).forEach(productPriceId => {
                count += parseInt(localStorageBasket[productId][productPriceId]['count']);
            });
        });

        return count;
    }

    function GetAllProductsInBasket(){
        return localStorage.getItem('products_in_basket');
    }

    function ClearAllProductsInBasket(){
        localStorage.removeItem('products_in_basket');
        UpdateCountProductsInBasket();
        return true;
    }

    UpdateCountProductsInBasket();
    function UpdateCountProductsInBasket() {
        let counterProductsInBasket = document.body.querySelector('.count-item-in-bag');
        let countProductsInBasket = getCountProductsInBasket();
        counterProductsInBasket.innerHTML = countProductsInBasket;
        if (countProductsInBasket > 0) {
            ShowElement(counterProductsInBasket);
        } else {
            HideElement(counterProductsInBasket);
        }
        UpdateCountProductsInBasketInBack();
    }

    // document.body.querySelector('.button-basket').addEventListener('click', () => {
    //     UpdateCountProductsInBasket();
    // });

    function UpdateCountProductsInBasketInBack() {
        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        }

        Ajax("{{route('update-count-products')}}", 'post', {products_in_basket: localStorageBasket}).then((response) => {
            //console.log(response);
        });
    }

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

    function ShowFlashMessage(msg, time) {
        time = time === undefined ? 1500 : time
        let containerFlashMessage = document.body.querySelector('.flash-message');
        containerFlashMessage.innerHTML = msg;
        containerFlashMessage.classList.add('show-el');
        setTimeout(() => {
            containerFlashMessage.classList.remove('show-el');
        }, time);
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

</script>
