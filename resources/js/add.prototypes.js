/* JS add prototypes */
Element.prototype.hide = function () {
    this.classList.add('hide');
}

Element.prototype.show = function () {
    this.classList.remove('hide');
}

Element.prototype.showToggle = function () {
    if (this.classList.contains('hide')) {
        this.show();
    } else {
        this.hide();
    }
}

function CreateElement(tag, params, parent) {
    const element = document.createElement(tag);
    if (params.attr) {
        Object.keys(params.attr).forEach((a) => {
            element.setAttribute(a, params.attr[a]);
        });
    }
    if (params.class) {
        element.className = params.class;
    }
    if (params.events) {
        Object.keys(params.events).forEach((e) => {
            element.addEventListener(e, params.events[e]);
        });
    }
    if (params.content) {
        element.innerHTML = params.content;
    }
    if (parent) {
        parent.appendChild(element);
    }
    if (params.childs) {
        params.childs.forEach((child) => {
            element.appendChild(child);
        })
    }
    return element;

    // let buttonAnswerDelete = CreateElement('button', {
    //     class: 'px-15 py-5 ml-10 cp',
    //     content: 'Удалить ответ',
    //     events: {
    //         click: (e) => {
    //             containerFieldsAdditionalAnswer.remove();
    //         }
    //     }
    // }, containerAdditionalAnswer);
}

function GenerationFormSelect(obj, name, selected = 0, disableFirstOption = false, selectValue = false) {
    let options = '';
    let i = 0;

    Object.keys(obj).forEach((key) => {
        if (obj[key]?.is_default_value) {
            selected = key
        }
    });

    Object.keys(obj).forEach((key) => {
        let disabled = (i === 0 && disableFirstOption === true) ? 'disabled' : '';
        let selectedAttr = selected == (selectValue ? obj[key].id : key) ? 'selected' : '';
        options += '<option ' + disabled + ' ' + selectedAttr + ' value="' + obj[key].id + '">' + obj[key].value + '</option>';
        i++;
    });
    return CreateElement('select', {attr: {name: name}, content: options});

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
