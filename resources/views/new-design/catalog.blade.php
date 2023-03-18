<?php
$bredcrumbs = [
    "Главная" => route("new-design.index"),
    "Каталог" => route("new-design.catalog"),
];
?>

@extends("new-design.app")

@section("content")
    <div class="catalog">
        @include("new-design.bredcrumbs", $bredcrumbs)
        <div class="flex-wrap mb-10 px-0-adaptive-10">
            <div class="mr-10">
                <div class="p-10">Категория</div>
                <div>
                    <select name="" id="" class="select-3 font-light">
                        <option value="123" selected>Объемные буквы</option>
                    </select>
                </div>
            </div>
            <div class="mr-10">
                <div class="p-10">Тип</div>
                <div>
                    <select name="" id="" class="select-3 font-light">
                        <option value="123" selected>Объемные буквы</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="flex-wrap-adaptive-block">
            <div class="w-33-adaptive-100 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs-adaptive-static">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33-adaptive-100 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs-adaptive-static">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33-adaptive-100 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs-adaptive-static">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33-adaptive-100 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs-adaptive-static">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33-adaptive-100 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs-adaptive-static">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="font-light">свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center mt-10"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.info")
    </div>
@endsection
