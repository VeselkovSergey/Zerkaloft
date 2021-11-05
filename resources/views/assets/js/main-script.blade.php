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
        document.body.querySelector('.delete-value-search-input').hide();
    });

    if (document.body.querySelector('.main-search-input').value.length > 0) {
        document.body.querySelector('.delete-value-search-input').show();
    }

    document.body.querySelector('.main-search-input').addEventListener('input', (el) => {
        if (document.body.querySelector('.main-search-input').value.length > 0) {
            document.body.querySelector('.delete-value-search-input').show();
        } else {
            document.body.querySelector('.delete-value-search-input').hide();
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
            ModalWindow(response);
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
                };
            } else {
                if (localStorageBasket[productId][productPriceId] === undefined) {
                    localStorageBasket[productId][productPriceId] = {
                        count: 1,
                        productId: productId,
                        productPriceId: productPriceId,
                        productFullInformation: productFullInformation,
                    };
                } else {
                    localStorageBasket[productId][productPriceId]['count'] = localStorageBasket[productId][productPriceId]['count'] + 1;
                }
            }
        } else if (typeChange === false) {
            localStorageBasket[productId][productPriceId]['count'] = localStorageBasket[productId][productPriceId]['count'] - 1;
        } else if (typeChange === 'input') {
            localStorageBasket[productId][productPriceId]['count'] = countProduct;
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
                    sum += concreteProductSum;
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
        let counterProductsInBasket = document.body.querySelector('.count-item-in-bag');
        let countProductsInBasket = getCountProductsInBasket();
        counterProductsInBasket.innerHTML = countProductsInBasket;
        if (countProductsInBasket > 0) {
            counterProductsInBasket.show();
        } else {
            counterProductsInBasket.hide();
        }
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

</script>
