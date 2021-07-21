{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>--}}
<script>

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

    let btnMenu = document.body.querySelector('.menu-btn');
    btnMenu.addEventListener('click', (el) => {
        el.stopPropagation();
        document.body.querySelector('.menu-container').classList.toggle('show-el');
    });

    document.body.addEventListener('click', (el) => {
        if (document.body.querySelector('.menu-container').classList.contains('show-el')) {
            document.body.querySelector('.menu-container').classList.remove('show-el');
        }
    });

</script>

<script>

    // let carousel = document.body.querySelector('.carousel');
    // let carouselContainer = carousel.querySelector('.carousel-container');
    // let carouselContainerChildren = carousel.querySelectorAll('.img-carousel');
    // let sequenceImgCarousel = [];
    // let activeImgCarousel = 0;
    //
    // carouselContainerChildren.forEach((img) => {
    //     sequenceImgCarousel.push(img);
    // });
    //
    // Object.keys(sequenceImgCarousel).forEach((key) => {
    //     if (sequenceImgCarousel[key].classList.contains('active')) {
    //         activeImgCarousel = key;
    //     }
    // });
    //
    // let countImgInCarousel = sequenceImgCarousel.length - 1;
    //
    // document.body.querySelector('.btn-slider-prev').addEventListener('click', (btn) => {
    //     clearTimeout(timerNextImgInCarousel);
    //     PrevImgInCarousel();
    //     TimerNextImgInCarousel();
    // });
    //
    // document.body.querySelector('.btn-slider-next').addEventListener('click', (btn) => {
    //     clearTimeout(timerNextImgInCarousel);
    //     NextImgInCarousel();
    //     TimerNextImgInCarousel();
    // });
    //
    // let timerNextImgInCarousel;
    // TimerNextImgInCarousel();
    // function TimerNextImgInCarousel() {
    //     clearTimeout(timerNextImgInCarousel);
    //     timerNextImgInCarousel = setTimeout(() => {
    //         NextImgInCarousel();
    //         TimerNextImgInCarousel();
    //     }, 2500);
    // }
    //
    // function NextImgInCarousel() {
    //     DeactivateAllImgCarousel();
    //     let key;
    //     if (parseInt(activeImgCarousel) === countImgInCarousel) {
    //         key = 0;
    //     } else {
    //         key = parseInt(activeImgCarousel) + 1;
    //     }
    //     sequenceImgCarousel[key].classList.add('active');
    //     activeImgCarousel = key;
    // }
    //
    // function PrevImgInCarousel() {
    //     DeactivateAllImgCarousel();
    //     let key;
    //     if (parseInt(activeImgCarousel) === 0) {
    //         key = countImgInCarousel;
    //     } else {
    //         key = parseInt(activeImgCarousel) - 1;
    //     }
    //     sequenceImgCarousel[key].classList.add('active');
    //     activeImgCarousel = key;
    // }
    //
    // function DeactivateAllImgCarousel() {
    //     carouselContainerChildren.forEach((img) => {
    //         if (img.classList.contains('active')) {
    //             img.classList.remove('active');
    //         }
    //     });
    // }

    // document.body.querySelector('.delete-value-search-input').addEventListener('click', (el) => {
    //     document.body.querySelector('.main-search-input').value = '';
    //     document.body.querySelector('.delete-value-search-input').classList.add('hide-el');
    //     document.body.querySelector('.delete-value-search-input').classList.remove('show-el');
    // });

    // if (document.body.querySelector('.main-search-input').value.length > 0) {
    //     document.body.querySelector('.delete-value-search-input').classList.add('show-el');
    //     document.body.querySelector('.delete-value-search-input').classList.remove('hide-el');
    // }

    // document.body.querySelector('.main-search-input').addEventListener('input', (el) => {
    //     if (document.body.querySelector('.main-search-input').value.length > 0) {
    //         document.body.querySelector('.delete-value-search-input').classList.add('show-el');
    //         document.body.querySelector('.delete-value-search-input').classList.remove('hide-el');
    //     } else {
    //         document.body.querySelector('.delete-value-search-input').classList.add('hide-el');
    //         document.body.querySelector('.delete-value-search-input').classList.remove('show-el');
    //     }
    //
    // });

    document.body.querySelectorAll('.menu-category, .expander-menu-category').forEach((category) => {
        category.addEventListener('click', (el) => {
            if (category.parentNode.querySelector('.menu-category-detail').classList.contains('show-el')) {
                category.parentNode.querySelector('.menu-category-detail').classList.remove('show-el');
                category.parentNode.querySelector('.menu-category-detail').classList.add('hide-el');
                category.parentNode.querySelector('.expander-menu-category').classList.remove('rotation-90');
            } else {
                category.parentNode.querySelector('.menu-category-detail').classList.add('show-el');
                category.parentNode.querySelector('.menu-category-detail').classList.remove('hide-el');
                category.parentNode.querySelector('.expander-menu-category').classList.add('rotation-90');
            }
        })
    });

    document.body.querySelector('.container-profile').addEventListener('click', (el) => {
        ShowLoader();
        Ajax("{{route('login-page')}}").then((response) => {
            ShowModal(response);
            HideLoader();
        });
    });

    document.body.querySelector('.modal').addEventListener('click', (el) => {
        el.stopPropagation();
        if (document.body.querySelector('.modal').classList.contains('show-el')) {
            document.body.querySelector('.modal').classList.remove('show-el');
            document.body.querySelector('.modal').classList.add('hide-el');
        } else {
            document.body.querySelector('.modal').classList.add('show-el');
            document.body.querySelector('.modal').classList.remove('hide-el');
        }
    });

    document.body.querySelector('.window-modal').addEventListener('click', (el) => {
        el.stopPropagation();
    });


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

            var xhr = new XMLHttpRequest();
            xhr.open(method, url, true);

            xhr.onload = function() {
                if (this.status == 200) {
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
            document.body.querySelector('.radio-effect').style.marginLeft = '5px';
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
            //console.log(response);
        });
    }

    function RegistrationPage() {
        Ajax("{{route('registration-page')}}").then((response) => {
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

    /**
     * Проверка и сбор данных из формы
     */
    function getDataFormContainer(container, validate) {
        if (validInputEmpty(container) || !!!validate) {
            let data = [];
            document.body.querySelectorAll('.' + container + ' input, .' + container + ' select').forEach((el) => {
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
            return ['No valid date'];
        }
    }

    function validInputEmpty(container) {
        let validate = true;
        document.body.querySelectorAll('.' + container + ' .need-validate').forEach((el) => {
            let strValue = el.value;
            if (strValue === '' || strValue === null || strValue === undefined) {
                validate = false;
            }
        });
        return validate;
    }

    function ShowFlashMessage(msg) {
        let containerFlashMessage = document.body.querySelector('.flash-message');
        containerFlashMessage.innerHTML = msg;
        containerFlashMessage.classList.add('show-el');
        setTimeout(() => {
            containerFlashMessage.classList.remove('show-el');
        }, 1500);
    }

</script>
