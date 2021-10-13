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

    document.body.querySelectorAll('.title-subcategory-container').forEach((category) => {
        category.addEventListener('click', (el) => {
            if (category.parentNode.querySelector('.children-subcategory').classList.contains('hide')) {
                category.parentNode.querySelector('.children-subcategory').show();
                category.parentNode.querySelector('.expander-menu-subcategory').classList.add('rotation-90');
            } else {
                category.parentNode.querySelector('.children-subcategory').hide();
                category.parentNode.querySelector('.expander-menu-subcategory').classList.remove('rotation-90');
            }
        })
    });

    function changeRadioEffect(type) {
        if (type) {
            document.body.querySelector('.radio-effect').style.marginLeft = '50%';
            document.body.querySelector('.physical_user_input').hide();
            document.body.querySelector('.juridical_user_input').show();
        } else {
            document.body.querySelector('.radio-effect').style.marginLeft = '10px';
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
            ModalWindowFlash('Заполните все поля', true);
            return false;
        }

        Ajax("{{route('login')}}", 'post', {login: login, password: password}).then((response) => {
            if (response.status) {
                location.reload();
            } else {
                ModalWindowFlash(response.message, true);
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
        let productPriceText = product.productPriceText;
        let productFullText = product.productFullText;

        console.log(product)

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
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['productId'] = productId;
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['productPriceId'] = productPriceId;
                localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['fullText'] = productFullText;
            } else {
                if (localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] === undefined) {
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId] = {};
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['count'] = 1;
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['text'] = productPriceText;
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['productId'] = productId;
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['productPriceId'] = productPriceId;
                    localStorageBasket['productId_' + productId]['productPriceId_' + productPriceId]['fullText'] = productFullText;

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
            counterProductsInBasket.show();
        } else {
            counterProductsInBasket.hide();
        }
        UpdateCountProductsInBasketInBack();
    }

    function UpdateCountProductsInBasketInBack() {
        let localStorageBasket = localStorage.getItem('products_in_basket');

        if (localStorageBasket === null) {
            localStorageBasket = {};
        }

        Ajax("{{route('update-count-products')}}", 'post', {products_in_basket: localStorageBasket});
    }

    let buttonsOpenFormFastOrder = document.body.querySelectorAll('.form-fast-order');
    if (buttonsOpenFormFastOrder) {
        buttonsOpenFormFastOrder.forEach((button) => {
            button.addEventListener('click', () => {
                GenerationFormFastOrder();
            });
        });
    }

    function GenerationFormFastOrder() {
        Ajax("{{route('form-fast-order')}}", 'get').then((response) => {
            ModalWindow(response);
        });
    }

</script>
