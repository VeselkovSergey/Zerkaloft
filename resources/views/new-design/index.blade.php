@extends("new-design.app")

@section("content")
    <div>
        <div class="flex-wrap-evenly-x flex-center-y hide-adaptive" style="min-height: calc(100vh - 120px)">
            <div class="w-20">
                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">
            </div>
            <div class="w-20">
                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">
            </div>
            <div class="w-20">
                <img class="border-image" width="100%" src="/assets/imgs/img-1.png" alt="">
            </div>
        </div>
        <div class="flex-adaptive-block bg-yellow p-20">
            <div class="w-50-adaptive-100">
                <img width="100%" src="/assets/imgs/img-1.png" alt="">
            </div>
            <div class="w-50-adaptive-100 flex-center font-36-adaptive" style="color: black">
                <div>
                    <div class="text-center">О КОМПАНИИ</div>
                    <div>1. ПРОЕКТИРУЕМ</div>
                    <div>2. РЕАЛИЗУЕМ</div>
                    <div class="show-adaptive">МЫ С УДОВОЛЬСТВИЕМ
                        ГОТОВЫ РЕАЛИЗОВАТЬ
                        ВАШЫ
                        МАРКЕТИНГОВЫЕ ИДЕИ.
                    </div>
                </div>
            </div>
        </div>
        @include("new-design.info")
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
        <div class="flex-wrap-adaptive-block">
            <div class="w-50-adaptive-100 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs-adaptive-static z-1 border-radius-50 p-20 text-center font-36-adaptive">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50-adaptive-100 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs-adaptive-static z-1 border-radius-50 p-20 text-center font-36-adaptive">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50-adaptive-100 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs-adaptive-static z-1 border-radius-50 p-20 text-center font-36-adaptive">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50-adaptive-100 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs-adaptive-static z-1 border-radius-50 p-20 text-center font-36-adaptive">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
        </div>
    </div>
@endsection
