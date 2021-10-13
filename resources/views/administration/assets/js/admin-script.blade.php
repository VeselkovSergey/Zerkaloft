<script>

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

    document.body.querySelector('.container-profile').addEventListener('click', (el) => {
        LoaderShow();
        Ajax("{{route('login-page')}}").then((response) => {
            ModalWindow(response);
            LoaderHide();
        });
    });

    document.body.querySelector('.modal').addEventListener('click', (el) => {
        el.stopPropagation();
        if (document.body.querySelector('.modal').classList.contains('hide')) {
            document.body.querySelector('.modal').show();
        } else {
            document.body.querySelector('.modal').hide();
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
            document.body.querySelector('.physical_user_input').hide();
            document.body.querySelector('.juridical_user_input').show();
        } else {
            document.body.querySelector('.radio-effect').style.marginLeft = '5px';
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

        Ajax("{{route('registration')}}", 'post', data);
    }

    function RegistrationPage() {
        Ajax("{{route('registration-page')}}").then((response) => {
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

    /**
     * Проверка и сбор данных из формы
     */
    function getDataFormContainer(container, validate, startElement) {
        let elem = startElement || document.body;
        if (validInputEmpty(container, elem) || !!!validate) {
            let data = [];

            elem.querySelectorAll('.' + container + ' input, .' + container + ' select, .' + container + ' textarea').forEach((el) => {
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
                        let value = el.type !== 'checkbox' ? el.value : el.checked
                        data[el.name].push(value);
                    }
                }
            });
            return data;
        } else {
            return ['No valid date'];
        }
    }

    function validInputEmpty(container, elem) {
        let validate = true;
        elem.querySelectorAll('.' + container + ' .need-validate').forEach((el) => {
            let strValue = el.value;
            if (strValue === '' || strValue === null || strValue === undefined) {
                validate = false;
            }
        });
        return validate;
    }

</script>
