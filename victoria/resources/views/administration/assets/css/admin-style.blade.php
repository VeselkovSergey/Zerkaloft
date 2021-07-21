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

    .flash-message {
        text-align: center;
        padding: 5px;
        position: absolute;
        width: 100%;
        display: none;
    }

    .flash-message-error{
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .flash-message-info{
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    .flash-message-success{
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .category-img-label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        height: 200px;
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    #category_img {
        display: none;
    }

    .subcategory-img-label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        height: 200px;
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    #subcategory_img {
        display: none;
    }

    .product-img-label {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        height: 200px;
        cursor: pointer;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }
    #product_img {
        display: none;
    }



</style>
