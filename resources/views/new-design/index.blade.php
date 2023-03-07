@extends("new-design.app")

@section("content")
    <div>
        <div class="flex-wrap-evenly-x flex-center-y" style="min-height: calc(100vh - 120px)">
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
        <div class="flex bg-yellow p-20">
            <div class="w-50">
                <img width="100%" src="/assets/imgs/img-1.png" alt="">
            </div>
            <div class="w-50 flex-center" style="font-size: 36px; color: black">
                <div>
                    <div>О КОМПАНИИ</div>
                    <div>1. ПРОЕКТИРУЕМ</div>
                    <div>2. РЕАЛИЗУЕМ</div>
                </div>
            </div>
        </div>
        @include("new-design.info")
        <div class="flex-wrap">
            <div class="w-33 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-33 pos-rel product-container">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="border-radius-25 p-10 w-100 mb-10 text-center">Название</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div>свойство</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-wrap">
            <div class="w-50 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs z-1 border-radius-50 p-20 text-center" style="font-size: 36px">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs z-1 border-radius-50 p-20 text-center" style="font-size: 36px">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs z-1 border-radius-50 p-20 text-center" style="font-size: 36px">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
            <div class="w-50 category-container pos-rel">
                <div>
                    <img width="100%" src="/assets/imgs/img-1.png" alt="">
                </div>
                <div class="category-description pos-abs z-1 border-radius-50 p-20 text-center" style="font-size: 36px">
                    ОБЪЕМНЫЕ
                    БУКВЫ
                </div>
            </div>
        </div>
    </div>
@endsection
