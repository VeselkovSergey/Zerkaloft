{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">--}}


<style>
    /* Указываем box sizing */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    /* Убираем внутренние отступы */
    ul[class],
    ol[class] {
        padding: 0;
    }

    /* Убираем внешние отступы */
    body,
    h1,
    h2,
    h3,
    h4,
    p,
    ul[class],
    ol[class],
    li,
    figure,
    figcaption,
    blockquote,
    dl,
    dd {
        margin: 0;
    }

    /* Выставляем основные настройки по-умолчанию для body */
    body {
        min-height: 100vh;
        scroll-behavior: smooth;
        text-rendering: optimizeSpeed;
        line-height: 1.5;
    }

    /* Удаляем стандартную стилизацию для всех ul и il, у которых есть атрибут class*/
    ul[class],
    ol[class] {
        list-style: none;
    }

    /* Элементы a, у которых нет класса, сбрасываем до дефолтных стилей */
    a:not([class]) {
        text-decoration-skip-ink: auto;
    }

    /* Упрощаем работу с изображениями */
    img {
        max-width: 100%;
        display: block;
    }

    /* Указываем понятную периодичность в потоке данных у article*/
    article > * + * {
        margin-top: 1em;
    }

    /* Наследуем шрифты для инпутов и кнопок */
    input,
    button,
    textarea,
    select {
        font: inherit;
    }

    /* Удаляем все анимации и переходы для людей, которые предпочитай их не использовать */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
            scroll-behavior: auto !important;
        }
    }
    input {
        outline:none;
    }
</style>

<style>
    .smooth-block {
        /* Скроем элемент в начальном состоянии */
        opacity: 0;
    }
    .smooth-block.smooth-block-show {
        opacity: 1;
        transition: opacity 2s;
    }

    .smooth-block>a>.title-category {
        opacity: 0;
        transition: opacity .3s;
    }

    .smooth-block:hover>a>.title-category {
        opacity: 1;
    }

    .show-el {
        display: block!important;
    }
    .hide-el {
        display: none!important;
    }
    .rotation-90 {
        transform: rotate(0.25turn) !important;
    }
    .expander-menu-category {
        transition: transform 100ms;
    }
    .expander-menu-subcategory {
        transition: transform 100ms;
    }

    /*.menu-category-container:hover .menu-subcategory-container{*/
    /*    display: block!important;*/
    /*}*/

    /*.menu-category-container:hover .expander-menu-category{*/
    /*    transform: rotate(0.25turn) !important;*/
    /*}*/

    /*.menu-subcategory-container:hover .menu-product{*/
    /*    display: block!important;*/
    /*}*/

    /*.menu-subcategory-container:hover .expander-menu-subcategory{*/
    /*    transform: rotate(0.25turn) !important;*/
    /*}*/

    ::-webkit-scrollbar {
        width: 12px;               /* width of the entire scrollbar */
    }

    ::-webkit-scrollbar-track {
        background: #a4a4a4;        /* color of the tracking area */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #606060;    /* color of the scroll thumb */
    }
    ::-webkit-scrollbar-thumb:hover {
        background-color: #818181;    /* color of the scroll thumb */
    }

</style>

<style>

    @media screen and (min-width: 768px) {
        .no-mobile-version {
            display: none;
        }
    }

    @media screen and (max-width: 768px) {
        header {
            display: none;
        }
        main {
            display: none;
        }
        footer {
            display: none;
        }
        body>nav {
            display: none;
        }
        .no-mobile-version {
            text-align: center;
            display: flex;
            align-items: center;
            height: 100vh;
        }
        .no-mobile-version>h1 {
            margin: auto;
        }
    }



</style>
