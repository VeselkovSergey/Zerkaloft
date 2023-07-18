@php

    if (session()->get("favouriteProducts") === null) {
        session()->put("favouriteProducts", []);
    }

    $actionConditionAuth = !\Illuminate\Support\Facades\Auth::check() ? 'LoginPage()' : 'UserOrdersPage()';

    $phone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['mainPhone'])->first();
    $phone = json_decode($phone->value)->phone;

    $additionalPhones = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['additionalPhones'])->first();
    $additionalPhones = json_decode($additionalPhones->value)->additionalPhones;

    $viberPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['viberPhone'])->first();
    $viberPhone = json_decode($viberPhone->value)->viberPhone;

    $whatsappPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['whatsappPhone'])->first();
    $whatsappPhone = json_decode($whatsappPhone->value)->whatsappPhone;

    $telegramPhone = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['telegramPhone'])->first();
    $telegramPhone = json_decode($telegramPhone->value)->telegramPhone;

    $mail = \App\Models\Settings::where('type', \App\Models\Settings::TypeByWords['mail'])->first();
    $mail = json_decode($mail->value)->mail;

@endphp

<!DOCTYPE html>
<html lang="ru">
<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="yandex-verification" content="4b37aac76908a243" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.ico">


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>{{ isset($title_page) ? $title_page : env('APP_NAME') }}</title>

    <meta name="description" content="{{isset($metaDescription) ? $metaDescription : 'Магазин зеркал ' . env('APP_NAME')}}">

    <link href="{{asset('resources/css/modal.css')}}" rel="stylesheet">

    <style>

        @font-face {
            font-family: 'NeusaNextPro-Regular';
            src: url('/fonts/neusa/NeusaNextPro-Regular.otf');
        }

        @font-face {
            font-family: 'NeusaNextPro-Light';
            src: url('/fonts/neusa/NeusaNextPro-Light.otf');
        }

        @font-face {
            font-family: 'NeusaNextPro-Bold';
            src: url('/fonts/neusa/NeusaNextPro-Bold.otf');
        }

        .font-regular {
            font-family: 'NeusaNextPro-Regular';
            font-weight: 400;
            font-style: normal;
        }

        .font-light {
            font-family: 'NeusaNextPro-Light';
            font-weight: 400;
            font-style: normal;
        }

        .font-bold {
            font-family: 'NeusaNextPro-Bold';
            font-weight: 600;
        }

    </style>

    <style>

        :root {
            --border-color: white;
            --main-bg-color: #13161a;
            --yellow-color: #e7e537;
            --pink-color: #ed028c;
            --blue-color: #28409a;
        }

        body {
            background-color: var(--main-bg-color);
            margin: 0;
            padding: 0;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            color: white;
            /*background-color: var(--main-bg-color);*/
            z-index: 2;
        }

        main {
            margin-top: 100px;
            color: white;
        }

        footer {
            /*background-color: var(--blue-color);*/
        }

        .input-search {
            all: unset;
            padding-left: 5px;
        }

        .product-container,
        .category-container {
            transition: transform 200ms;
        }

        .product-description,
        .category-description {
            display: none;
            top: 0;
            height: 100%;
            /*right: -50%;*/
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /*border-radius: 0 25px 25px 0;*/
        }

        .product-container:nth-child(3n) .product-description {
            /*right: unset;*/
            /*left: -50%;*/
            /*border-radius: 25px 0 0 25px;*/
        }

        .category-container .category-description {
            right: unset;
            height: unset;
            width: calc(100% - 40px);
            /*top: 100%;*/
            border-radius: 0;
        }

        .product-container:hover,
        .category-container:hover {
            transform: scale(0.9);
            z-index: 1;
        }

        .product-container:hover .product-description,
        .category-container:hover .category-description {
            display: block;
        }


        .border-image {
            border-style: solid;
            border-width: 10px 10px 10px 10px;
            -moz-border-image: url("/assets/imgs/border-image.jpg") 5 5 5 5 repeat repeat;
            -webkit-border-image: url("/assets/imgs/border-image.jpg") 5 5 5 5 repeat repeat;
            -o-border-image: url("/assets/imgs/border-image.jpg") 5 5 5 5 repeat repeat;
            border-image: url("/assets/imgs/border-image.jpg") 5 5 5 5 repeat repeat;
        }

        .menu-category-container {
            padding-top: 5px;
        }

        .menu-category-container:hover .menu-products-container {
            display: block;
        }

        .menu-category-title {
            padding: 5px 10px;
        }

        .menu-category-container:hover .menu-category-title {
            border-left: 1px solid white;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            border-bottom-left-radius: 20px;
            border-top-left-radius: 20px;
        }

        .menu-products-container {
            display: none;
            position: absolute;
            width: calc(100vw - 50vw);
            left: 100%;
            top: 0;
            background-color: rgba(0, 0, 0, 0.8);

            /*border: 1px solid white;*/
            border-bottom-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;

            max-height: 80vh;
            overflow-y: scroll;
        }

        .catalog-button:hover .catalog-container {
            display: block;
        }

        .catalog-container {
            display: none;
        }

        .catalog-product-container:hover .catalog-product-description {
            display: block;
        }

        .catalog-product-description {
            display: none;
        }
    </style>

    <style>
        .select-1 {
            padding: 10px 40px 10px 10px;
            border-radius: 25px;
            color: white;
            background-color: var(--main-bg-color);
            border: 1px solid white;
            font-size: 20px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns= 'http://www.w3.org/2000/svg' viewBox= '0 0 24 24' fill= 'none' stroke= 'white' stroke-width= '2' stroke-linecap= 'round' stroke-linejoin= 'round' %3e%3cpolyline points= '6 9 12 15 18 9' %3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .select-2 {
            padding: 10px 40px 10px 10px;
            border-radius: 25px;
            color: white;
            background-color: var(--main-bg-color);
            border: 1px solid white;
            font-size: 16px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns= 'http://www.w3.org/2000/svg' viewBox= '0 0 24 24' fill= 'none' stroke= 'white' stroke-width= '2' stroke-linecap= 'round' stroke-linejoin= 'round' %3e%3cpolyline points= '6 9 12 15 18 9' %3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .select-3 {
            height: 40px;
            padding: 0 40px 0 10px;
            border-radius: 25px;
            color: white;
            background-color: var(--main-bg-color);
            border: 1px solid white;
            font-size: 14px;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns= 'http://www.w3.org/2000/svg' viewBox= '0 0 24 24' fill= 'none' stroke= 'white' stroke-width= '2' stroke-linecap= 'round' stroke-linejoin= 'round' %3e%3cpolyline points= '6 9 12 15 18 9' %3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .checkbox-wrapper-1 {
            height: 40px;
            padding: 0 10px;
            border: 1px solid white;
            border-radius: 25px;
            font-size: 14px;
            display: flex;
            position: relative;
        }

        .white-button {
            background-color: white;
            color: black;
            height: 40px;
            padding: 0 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 25px;
        }

        .count-item-in-bag {
            background-color: #ec407a;
            border-radius: 100px;
            min-width: 30px;
            min-height: 30px;
            position: absolute;
            top: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media screen and (max-width: 540px) {
            .count-item-in-bag {
                min-width: 23px;
                min-height: 23px;
                top: -3px;
                right: -5px;
            }
        }

    </style>

    <style>
        /*helpers*/

        .hide {
            display: none;
        }

        .text-center {
            text-align: center;
        }

        .pos-rel {
            position: relative;
        }

        .pos-abs {
            position: absolute;
        }

        .z-1 {
            z-index: 1;
        }

        .flex {
            display: flex;
        }

        .block:not(.hide) {
            display: block;
        }

        a.block:not(.hide) {
            text-decoration: none;
            color: inherit;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .flex-wrap:not(.hide) {
            display: flex;
            flex-wrap: wrap;
        }

        .flex-wrap-space-x {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .flex-around-x {
            display: flex;
            justify-content: space-around;
        }

        .flex-wrap-evenly-x {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .flex-wrap-center-x {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flex-center-y {
            display: flex;
            align-items: center;
        }

        .flex-center-x {
            display: flex;
            justify-content: center;
        }

        .flex-space-x {
            display: flex;
            justify-content: space-between;
        }

        .flex-column-space-y {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .flex-column-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .flex-column-center-x {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .flex-end-x {
            display: flex;
            justify-content: end;
        }

        .flex-column-end-y {
            display: flex;
            flex-direction: column;
            justify-content: end;
        }

        .w-max-content {
            width: max-content;
        }

        .w-auto {
            width: auto;
        }

        .w-100vw {
            width: 100vw;
        }

        .w-100 {
            width: 100%;
        }

        .w-95 {
            width: 95%;
        }

        .w-90 {
            width: 90%;
        }

        .w-85 {
            width: 85%;
        }

        .w-80 {
            width: 80%;
        }

        .w-75 {
            width: 75%;
        }

        .w-70 {
            width: 70%;
        }

        .w-65 {
            width: 65%;
        }

        .w-60 {
            width: 60%;
        }

        .w-55 {
            width: 55%;
        }

        .w-50 {
            width: 50%;
        }

        .w-45 {
            width: 45%;
        }

        .w-40 {
            width: 40%;
        }

        .w-35 {
            width: 35%;
        }

        .w-33 {
            width: 33%;
            /*margin-right: 0.3%;*/
        }

        .w-30 {
            width: 30%;
        }

        .w-25 {
            width: 25%;
        }

        .w-20 {
            width: 20%;
        }

        .w-15 {
            width: 15%;
        }

        .w-10 {
            width: 10%;
        }

        .w-5 {
            width: 5%;
        }

        .h-100 {
            height: 100%;
        }

        .h-100vh {
            height: 100vh;
        }

        .ml-a {
            margin-left: auto;
        }

        .mr-a {
            margin-right: auto;
        }

        .mt-a {
            margin-top: auto;
        }

        .m-0 {
            margin: 0;
        }

        .ml-10 {
            margin-left: 10px;
        }

        .ml-20 {
            margin-left: 20px;
        }

        .mr-10 {
            margin-right: 10px;
        }

        .mr-20 {
            margin-right: 20px;
        }

        .mx-10 {
            margin-right: 10px;
            margin-left: 10px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-15 {
            margin-bottom: 15px;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mb-a {
            margin-bottom: auto;
        }

        .mb-5 {
            margin-bottom: 5px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .px-20 {
            padding-left: 20px;
            padding-right: 20px;
        }

        .px-10 {
            padding-left: 10px;
            padding-right: 10px;
        }

        .py-20 {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .p-30 {
            padding: 30px;
        }

        .p-20 {
            padding: 20px;
        }

        .p-10 {
            padding: 10px;
        }

        .p-5 {
            padding: 5px;
        }

        .p-50 {
            padding: 50px;
        }

        .pb-10 {
            padding-bottom: 10px;
        }

        .color-white {
            color: white;
        }

        .border-radius-25 {
            border: 1px solid var(--border-color);
            border-radius: 25px;
        }

        .border-radius-50 {
            border: 1px solid var(--border-color);
            border-radius: 50px;
        }

        .bg-yellow {
            background-color: var(--yellow-color);
        }

        .bg-pink {
            background-color: var(--pink-color);
        }

        .scale-1 {
            transition: transform 200ms;
        }

        .scale-1:hover {
            transform: scale(1.05);
        }

        .h1 {
            font-size: 32px;
        }

        .h2 {
            font-size: 24px;
        }

        .h3 {
            font-size: 20px;
            margin: 0;
        }

        .h4 {
            font-size: 16px;
        }

        .h5 {
            font-size: 12px;
        }

        .cp {
            cursor: pointer;
        }

        .scroll-auto {
            overflow: auto;
        }
    </style>

    <style>
        /* для элемента input c type="checkbox" */
        .custom-checkbox {
            position: absolute;
            opacity: 0;
            top: 10px;
            left: 7px;
            transform: scale(1.5);
        }

        /* для элемента label, связанного с .custom-checkbox */
        .custom-checkbox + label {
            display: inline-flex;
            align-items: center;
            user-select: none;
        }

        /* создание в label псевдоэлемента before со следующими стилями */
        .custom-checkbox + label::before {
            content: '';
            display: inline-block;
            width: 1em;
            height: 1em;
            flex-shrink: 0;
            flex-grow: 0;
            border: 1px solid #adb5bd;
            border-radius: 0.25em;
            margin-right: 0.5em;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 50% 50%;
        }

        /* стили при наведении курсора на checkbox */
        .custom-checkbox:not(:disabled):not(:checked) + label:hover::before {
            border-color: #b3d7ff;
        }

        /* стили для активного чекбокса (при нажатии на него) */
        .custom-checkbox:not(:disabled):active + label::before {
            background-color: #b3d7ff;
            border-color: #b3d7ff;
        }

        /* стили для чекбокса, находящегося в фокусе */
        .custom-checkbox:focus + label::before {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* стили для чекбокса, находящегося в фокусе и не находящегося в состоянии checked */
        .custom-checkbox:focus:not(:checked) + label::before {
            border-color: #80bdff;
        }

        /* стили для чекбокса, находящегося в состоянии checked */
        .custom-checkbox:checked + label::before {
            border-color: #0b76ef;
            background-color: #0b76ef;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
        }

        /* стили для чекбокса, находящегося в состоянии disabled */
        .custom-checkbox:disabled + label::before {
            background-color: #e9ecef;
        }
    </style>

    <style>
        main {
            /*min-height: calc(100vh - 176px);*/
        }

        img {
            height: 100%;
            width: 100%;
        }
    </style>

    <style>

        .font-36-adaptive {
            font-size: 36px;
        }

        .font-36-adaptive-24 {
            font-size: 36px;
        }

        .show-adaptive, .show-adaptive-flex {
            display: none;
        }

        .img-120-adaptive-70 {
            height: 120px;
        }

        .img-w-100-adaptive-60 {
            width: 100px;
        }

        .info-block {
            display: flex;
            justify-content: space-around;
        }

        .w-15-adaptive-100 {
            width: 15%;
        }

        .w-15-adaptive-40vw {
            width: 15%;
        }

        .w-33-adaptive-100 {
            width: 33%;
        }

        .w-35-adaptive-100 {
            width: 35%;
        }

        .w-40-adaptive-100 {
            width: 40%;
        }

        .w-60-adaptive-100 {
            width: 60%;
        }

        .w-33-adaptive-40vw {
            width: 33%;
        }

        .w-50-adaptive-100 {
            width: 50%;
        }

        .w-25-adaptive-100 {
            width: 25%;
        }

        .flex-wrap-adaptive-block {
            display: flex;
            flex-wrap: wrap;
        }

        .flex-adaptive-block {
            display: flex;
        }

        .block-adaptive-flex {
            display: block;
        }

        .pos-abs-adaptive-static {
            position: absolute;
        }

        .pt-15-adaptive-0 {
            padding-top: 15px;
        }

        .img-search {
            width: 25px;
        }

        .search-container {
            padding: 12px 10px;
        }

        .mr-10-adaptive-0 {
            margin-right: 10px;
        }

        .mr-0-adaptive-10 {
            margin-right: 0px;
        }

        .px-100-adaptive-10 {
            padding-left: 100px;
            padding-right: 100px;
        }

        .w-a-adaptive-100 {
            width: auto;
        }

        .w-50-adaptive-100 {
            width: 50%;
        }

        .flex-space-x-adaptive-column {
             display: flex;
             justify-content: space-between;
        }

        .flex-adaptive-column {
            display: flex;
        }

        .w-70-adaptive-100 {
            width: 70%;
        }

        .w-10-adaptive-100 {
            width: 10%;
        }

        .w-90-adaptive-100 {
            width: 90%;
        }

        .w-80-adaptive-100 {
            width: 80%;
        }

        .w-75-adaptive-100 {
            width: 75%;
        }

        .flex-center-adaptive-column {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media screen and (max-width: 540px) {

            .flex-center-adaptive-column {
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }

            .w-75-adaptive-100 {
                width: 100%;
            }

            .w-90-adaptive-100 {
                width: 100%;
            }

            .w-80-adaptive-100 {
                width: 100%;
            }

            .w-10-adaptive-100 {
                width: 100%;
            }

            .w-70-adaptive-100 {
                width: 100%;
            }

            .flex-adaptive-column {
                flex-direction: column;
            }

            .flex-space-x-adaptive-column {
                display: flex;
                justify-content: normal;
                flex-direction: column;
            }

            .w-50-adaptive-100 {
                width: 100%;
            }

            .w-a-adaptive-100 {
                width: 100%;
            }

            .px-0-adaptive-10 {
                padding-left: 10px;
                padding-right: 10px;
            }

            .px-100-adaptive-10 {
                padding-left: 10px;
                padding-right: 10px;
            }

            .font-36-adaptive {
                font-size: unset;
            }


            .font-36-adaptive-24 {
                font-size: 24px;
            }

            .show-adaptive {
                display: block;
            }

            .show-adaptive-flex {
                display: flex;
            }

            .img-120-adaptive-70 {
                height: 70px;
            }

            .img-w-100-adaptive-60 {
                width: 60px;
            }

            .hide-adaptive {
                display: none;
            }

            .info-block {
                display: flex;
                overflow: scroll;
                justify-content: start;
            }

            .w-15-adaptive-100 {
                width: 100%;
            }

            .w-15-adaptive-40vw {
                width: 40vw;
            }

            .w-33-adaptive-100 {
                width: 100%;
            }

            .w-35-adaptive-100 {
                width: 100%;
            }

            .w-40-adaptive-100 {
                width: 100%;
            }

            .w-60-adaptive-100 {
                width: 100%;
            }

            .w-33-adaptive-40vw {
                width: 40vw;
                min-width: 40vw;
                max-width: 40vw;
            }

            .w-50-adaptive-100 {
                width: 100%;
            }

            .w-25-adaptive-100 {
                width: 100%;
            }

            .flex-wrap-adaptive-block {
                display: block;
            }

            .flex-adaptive-block {
                display: block;
            }

            .block-adaptive-flex {
                display: flex;
            }

            .main-page .product-container .product-description,
            .catalog .product-container .product-description,
            .main-page .category-container .category-description,
            .catalog .category-container .category-description {
                display: block;
            }

            .favorite-page .product-container .product-description, .favorite-page .category-container .category-description {
                display: none;
            }

            .pos-abs-adaptive-static {
                position: static;
            }

            .product-description, .category-description {
                width: 100%;
            }

            .product-container:hover, .category-container:hover {
                transform: unset;
                z-index: unset;
            }

            .category-container .category-description {
                border-radius: 50px;
                padding: 10px;
                margin: auto;
                margin-bottom: 10px;
            }

            main {
                margin-top: 60px;
            }

            footer {
                margin-bottom: 20px;
            }

            .pt-15-adaptive-0 {
                padding-top: 0;
            }

            .img-search {
                width: 18px;
            }

            .search-container {
                padding: 0 0 0 5px;
            }

            .mr-10-adaptive-0 {
                margin-right: 0;
            }

            .mr-0-adaptive-10 {
                margin-right: 10px;
            }
        }
    </style>

    <style>
        .flash-message {
            text-align: center;
            position: fixed;
            width: auto;
            right: 10px;
            padding: 10px 50px;
        }

        .flash-message.show {
            display: block;
        }

        .flash-message-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .flash-message-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        .flash-message-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>

    @yield('css')

    <script src="{{ asset('resources/js/add.prototypes.js?v=2023-07-10') }}"></script>

    <style>
        /*toDo*/
        .button-blue {
            color: black;
            background-color: white;
            border: unset;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .radio-effect {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            /*padding: 5px;*/
        }
        .radio-effect>.slider {
            background-color: #1976d2;
            height: 100%;
            width: 50%;
            transition: margin 300ms;
            margin-left: 0;
            border-radius: 5px;
        }

        .search-container-header {
            margin-right: 10px;
        }
        .search-container-header.hide {
             display: flex;
        }

        /* подсказки адресов */
        .container-suggestions-pos-abs {
            border: 1px solid #cbcdd1;
            /*background-color: #FFFFFF;*/
            background-color: var(--main-bg-color);
            max-height: 50vh;
            overflow: auto;
        }

        /* подсказки в поиске */
        .search-container-header .container-suggestions {
            position: absolute;
            left: 0;
            top: 50px;
        }

        .suggestion-item:hover {
            cursor: pointer;
            background-color: rgb(80, 80, 80);
        }

        .black-input {
            border: 1px solid white;
            border-radius: 25px;
            padding: 10px 10px 10px 20px;
            width: calc(100% - 35px);
            background-color: var(--main-bg-color);
            color: white;
            font-size: 16px;
        }

        .detailed-information-user input {
            border: 1px solid white;
            border-radius: 25px;
            padding: 10px 10px 10px 20px;
            width: calc(100% - 35px);
            background-color: var(--main-bg-color);
            color: white;
            font-size: 16px;
        }

        main::-webkit-scrollbar {
            display: none;
        }

        main {
            max-height: calc(100vh - 100px);
            min-height: calc(100vh - 100px);
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
        }

        @media screen and (max-width: 540px) {
            main {
                max-height: calc(100vh - 120px);
            }
        }
    </style>

</head>
<body class="font-regular" style="background-image: url({{route('files', \App\Http\Controllers\Administration\SettingsController::GetBodyImage()->imageFileId)}}); background-size: cover; background-attachment: fixed;">
<div>
    <div style="max-width: 1440px; margin: auto;">
        @include("new-design.header")

        <div class="flash-message flash-message-error hide"></div>

        <main>
            @yield("content")
            <footer class="flex-center-y flex-wrap-evenly-x p-10 color-white">
                <div class="flex">
                    <div class="mr-10">
                        <svg width="32" height="32" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>.cls-vk-1 {
                                        fill: #4489c8;
                                    }

                                    .cls-vk-2 {
                                        fill: #fff;
                                    }</style>
                            </defs>
                            <title></title>
                            <g data-name="32-vk" id="_32-vk">
                                <rect class="cls-vk-1" height="64" rx="11.2" ry="11.2" width="64"></rect>
                                <path class="cls-vk-2"
                                      d="M9.62,19.77H17.3a.79.79,0,0,1,.74.51c.85,2.19,4.38,10.76,7.61,11.46,2.4,0,1.55-11.4-1.5-11.4-.8,0,1.42-1.42,1.57-1.48a16.38,16.38,0,0,1,8.66,0c1.53.64,1.79,2.43,1.83,3.95s-1.7,8,.59,8.7c3,.92,6.86-8.49,7.76-10.8a.79.79,0,0,1,.74-.5h8.55a.8.8,0,0,1,.74,1.11,74.74,74.74,0,0,1-6.31,11.52,1.59,1.59,0,0,0,.16,2C51,37.58,58,45.34,54,45.34H45.37a1.57,1.57,0,0,1-1.18-.53c-1.34-1.48-5.24-5.6-7-5.27-1.46.27-1.6,2.75-1.53,4.37a1.6,1.6,0,0,1-1.48,1.68c-1.53.09-3.62.13-3.81.12-6.1-.39-9.71-4.46-13.16-9A56.33,56.33,0,0,1,8.86,20.83.81.81,0,0,1,9.62,19.77Z"></path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <svg width="32" height="32" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <style>.cls-inst-1 {
                                        fill: url(#radial-gradient);
                                    }

                                    .cls-inst-2 {
                                        fill: #fff;
                                    }</style>
                                <radialGradient cx="-578.95" cy="-837.6" gradientTransform="translate(499.5 629.5) scale(0.75)"
                                                gradientUnits="userSpaceOnUse" id="radial-gradient" r="197.06">
                                    <stop offset="0" stop-color="#f9ed32"></stop>
                                    <stop offset="0.36" stop-color="#ee2a7b"></stop>
                                    <stop offset="0.44" stop-color="#d22a8a"></stop>
                                    <stop offset="0.6" stop-color="#8b2ab2"></stop>
                                    <stop offset="0.83" stop-color="#1b2af0"></stop>
                                    <stop offset="0.88" stop-color="#002aff"></stop>
                                </radialGradient>
                            </defs>
                            <title></title>
                            <g data-name="3-instagram" id="_3-instagram">
                                <rect class="cls-inst-1" height="64" rx="11.2" ry="11.2" transform="translate(64 64) rotate(180)"
                                      width="64"></rect>
                                <path class="cls-inst-2"
                                      d="M44,56H20A12,12,0,0,1,8,44V20A12,12,0,0,1,20,8H44A12,12,0,0,1,56,20V44A12,12,0,0,1,44,56ZM20,12.8A7.21,7.21,0,0,0,12.8,20V44A7.21,7.21,0,0,0,20,51.2H44A7.21,7.21,0,0,0,51.2,44V20A7.21,7.21,0,0,0,44,12.8Z"></path>
                                <path class="cls-inst-2"
                                      d="M32,45.6A13.6,13.6,0,1,1,45.6,32,13.61,13.61,0,0,1,32,45.6Zm0-22.4A8.8,8.8,0,1,0,40.8,32,8.81,8.81,0,0,0,32,23.2Z"></path>
                                <circle class="cls-inst-2" cx="45.6" cy="19.2" r="2.4"></circle>
                            </g>
                        </svg>
                    </div>
                </div>
                <div>{{\App\Http\Controllers\Administration\SettingsController::FooterText()->text}}</div>
                <div class="flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32" fill="none">
                            <g opacity="0.75">
                                <path d="M41.31 10.0347H38.7954C38.0352 10.0347 37.4504 10.2686 37.0995 11.0288L32.3042 21.9645H35.696C35.696 21.9645 36.2808 20.5025 36.3978 20.1516C36.7486 20.1516 40.082 20.1516 40.5498 20.1516C40.6668 20.561 40.9592 21.906 40.9592 21.906H44.0001L41.31 10.0347ZM37.3334 17.6955C37.6258 16.9937 38.62 14.3622 38.62 14.3622C38.62 14.4206 38.9124 13.6604 39.0293 13.251L39.2633 14.3037C39.2633 14.3037 39.9065 17.1692 40.0235 17.754H37.3334V17.6955Z"
                                      fill="white"></path>
                                <path d="M32.538 18.0465C32.538 20.5026 30.3158 22.1401 26.8655 22.1401C25.4035 22.1401 24 21.8477 23.2397 21.4968L23.7076 18.8067L24.1169 18.9822C25.1696 19.45 25.8713 19.6255 27.1579 19.6255C28.0935 19.6255 29.0877 19.2746 29.0877 18.4559C29.0877 17.9296 28.6783 17.5787 27.3918 16.9939C26.1637 16.4091 24.5263 15.4734 24.5263 13.7775C24.5263 11.4383 26.807 9.85938 30.0234 9.85938C31.2514 9.85938 32.3041 10.0933 32.9473 10.3857L32.4795 12.9588L32.2456 12.7249C31.6608 12.491 30.9006 12.257 29.7895 12.257C28.5614 12.3155 27.9766 12.8418 27.9766 13.3097C27.9766 13.836 28.6783 14.2453 29.7895 14.7717C31.6608 15.6488 32.538 16.643 32.538 18.0465Z"
                                      fill="white"></path>
                                <path d="M4 10.1519L4.05848 9.91797H9.08772C9.78947 9.91797 10.3158 10.1519 10.4912 10.9121L11.6023 16.1753C10.4912 13.3683 7.91813 11.0876 4 10.1519Z"
                                      fill="white"></path>
                                <path d="M18.6783 10.035L13.5906 21.9064H10.1403L7.21631 11.9649C9.32157 13.3099 11.076 15.4152 11.7192 16.8771L12.0701 18.1052L15.228 9.97656H18.6783V10.035Z"
                                      fill="white"></path>
                                <path d="M20.0233 9.97656H23.2397L21.1929 21.9064H17.9766L20.0233 9.97656Z" fill="white"></path>
                            </g>
                        </svg>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32" fill="none">
                            <circle opacity="0.75" cx="16" cy="16" r="12" fill="white"></circle>
                            <circle opacity="0.5" cx="32" cy="16" r="12" fill="white"></circle>
                        </svg>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="32" viewBox="0 0 48 32" fill="none">
                            <g opacity="0.75">
                                <path d="M39.8879 10.2056H32.187C32.6356 12.7476 35.1029 15.1402 37.7945 15.1402H43.9253C44.0001 14.9159 44.0001 14.542 44.0001 14.3177C44.0001 12.0747 42.1309 10.2056 39.8879 10.2056Z"
                                      fill="white"></path>
                                <path d="M32.8599 15.5889V21.7945H36.5982V18.5047H39.8879C41.6823 18.5047 43.2524 17.2337 43.7758 15.5889H32.8599Z"
                                      fill="white"></path>
                                <path d="M19.7007 10.2056V21.7196H22.9904C22.9904 21.7196 23.8128 21.7196 24.2614 20.8972C26.5044 16.4859 27.1773 15.1402 27.1773 15.1402H27.6259V21.7196H31.3642V10.2056H28.0745C28.0745 10.2056 27.2521 10.2803 26.8035 11.028C24.9343 14.8411 23.8876 16.785 23.8876 16.785H23.439V10.2056H19.7007Z"
                                      fill="white"></path>
                                <path d="M4 21.7943V10.2803H7.73832C7.73832 10.2803 8.78506 10.2803 9.38319 11.9251C10.8785 16.2616 11.0281 16.8597 11.0281 16.8597C11.0281 16.8597 11.3271 15.813 12.6729 11.9251C13.271 10.2803 14.3178 10.2803 14.3178 10.2803H18.0561V21.7943H14.3178V15.5887H13.8692L11.7757 21.7943H10.1309L8.0374 15.5887H7.5888V21.7943H4Z"
                                      fill="white"></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </footer>
        </main>

        <div class="flex-column-center show-adaptive" style="position: fixed; right: 10px; bottom: 70px;">
            <div class="mb-15 flex-center callback button-back-call">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="green" class="bi bi-telephone-inbound-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM15.854.146a.5.5 0 0 1 0 .708L11.707 5H14.5a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 1 0v2.793L15.146.146a.5.5 0 0 1 .708 0z"></path>
                </svg>
            </div>
            <div class="mb-5 flex-center">
                <a class="whatsapp" href="https://wa.me/{{$whatsappPhone}}">
                    <img width="26" src="{{url('icon/whatsapp.svg')}}" alt="">
                </a>
            </div>
            <div class="mb-5 flex-center">
                <a class="telegram" href="https://t.me/{{$telegramPhone}}">
                    <img width="24" src="{{url('icon/telegram.svg')}}" alt="">
                </a>
            </div>
        </div>
        <div class="mob-menu show-adaptive" style="position: fixed; bottom: 0; height: 60px; width: 100vw; z-index: 4;">
            <div class="flex-around-x" style="background-color: var(--main-bg-color); padding: 10px; color: white; height: calc(100% - 20px)">
                <div onclick="location.href='tel:{{$phone}}'">
                    <img width="30" src="/assets/imgs/call.svg" alt="call">
                </div>
                <div onclick="location.href='mailto:{{$mail}}?subject=Вопрос'">
                    <img width="30" src="/assets/imgs/email.svg" alt="email">
                </div>
                <div data-relation-id="mobMenu" data-hide-after-click="true">
                    <img width="30" src="/assets/imgs/catalog.svg" alt="catalog">
                </div>
                <div onclick="{{$actionConditionAuth}}">
                    <img width="30" src="/assets/imgs/profile.svg" alt="profile">
                </div>
                <div onclick="location.href='{{route('basket-page')}}'" class="pos-rel">
                    <img width="30" src="/assets/imgs/basket.svg" alt="basket">
                    <div class="count-item-in-bag">

                    </div>
                </div>
            </div>
        </div>
        <div id="mobMenu" class="hide" style="z-index:3; position: fixed; top: 0; left: 0; background-color: rgba(0,0,0,0.8); color: white; width: 100vw; height: calc(100vh - 60px);">
            <div style="overflow: scroll;height: calc(100% - 20px);padding: 10px;display: flex;flex-direction: column;">
                <div class="border-radius-25 p-10 mb-10 mt-a" onclick="location.href='{{route("home-page")}}'">Главная</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route("gallery")}}'">Наши работы</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route('fast-order-page')}}'">Быстрое оформление</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route("about-page")}}#delivery';">Доставка</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route("about-page")}}#payment';">Оплата</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route("about-page")}}#contacts';">Контакты</div>
                <div class="border-radius-25 p-10 mb-10" onclick="location.href='{{route('about-page')}}';" style="margin-bottom: 50px;">О компании</div>
            </div>
        </div>
    </div>
</div>

<script>
    const suggestionsProducts = "{{route('suggestion-categories-and-products')}}";
    const searchPage = "{{route('home-page')}}";
    const createCallbackOrderRequestRoute = "{{route('create-callback-order')}}";
</script>

<script>
    document.body.querySelectorAll("[data-relation-id]").forEach((element) => {
        element.addEventListener("click", () => {
            const relatedElement = document.body.querySelector("#" + element.dataset.relationId)
            relatedElement.classList.toggle("hide")
            if (element.dataset.hideAfterClick) {
                relatedElement.addEventListener("click", () => {
                    relatedElement.classList.add("hide")
                })
            }
        })
    })
</script>

@include('assets.js.main-script')

@yield('js')

@if(env("APP_ENV") === 'production')

    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(93122517, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/93122517" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>

@endif

</body>
</html>
