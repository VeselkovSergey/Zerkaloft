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

function GenerationFormSelect(obj, name, selected, disableFirstOption = false) {
    let options = '';
    let i = 0;
    Object.keys(obj).forEach((key) => {
        let disabled = (i === 0 && disableFirstOption === true) ? 'disabled' : '';
        let selectedAttr = selected == key ? 'selected' : '';
        options += '<option ' + disabled + ' ' + selectedAttr + ' value="' + key + '">' + obj[key] + '</option>';
        i++;
    });
    return CreateElement('select', {attr: {name: name}, content: options});

}
