<header class="font-light" style="max-width: 1440px;">
    <div class="flex-center-y pt-15-adaptive-0" style="height: 60px;">
        <a class=" block flex-center-y mr-10" href="{{route('home-page')}}">
            <img class="pl-10 img-w-100-adaptive-60 hide-adaptive" src="/assets/imgs/logo.svg" alt="logo">
            <img class="pl-10 show-adaptive" style="width: 30px;" src="/assets/imgs/logo-small.svg" alt="logo">
        </a>
        <div class="mr-10 hide-adaptive">
            <div class="catalog-button flex-center-y border-radius-25" style="width: fit-content; padding: 5px 10px">
                <img style="color: white" src="/assets/imgs/catalog.svg" alt="catalog">
                <div class="pl-10 font-regular">Каталог</div>
                <div class="catalog-container pos-abs" style="top: 0; left: 0;/* width: 100vw; height: 100vh;*/">
                    <div class="border-radius-25"
                         style="margin: 5px 0 0 5px; border: 1px solid #ffffff; width: 25vw; background-color: rgba(0,0,0,0.8)">
                        <div class="p-20">
                            <div class="border-radius-25 p-10 font-regular">Группа</div>
                            @foreach(\App\Models\Categories::all() as $category)
                                <div class="menu-categories-container">
                                    <div class="menu-category-container" style="position: relative;">
                                        <div class="menu-category-title">{{$category->title}}</div>
                                        <div class="menu-products-container">
                                            <div class="flex-wrap p-10">
                                                @foreach($category->ProductsByNotOnlyInCalculator as $product)
                                                    <a href="{{$product->Link()}}" class="color-white block catalog-product-container w-33 pos-rel">
                                                        <div class="p-5">
                                                            @foreach(unserialize($product->img) as $img)
                                                                <img style="" src="{{route('files', $img)}}" alt="{{$product->title}}">
                                                            @endforeach
                                                            <div class="pos-abs"
                                                                 style="top: 5px; left: 5px; width: calc(100% - 10px); height: calc(100% - 10px)">
                                                                <div class="catalog-product-description h-100 w-100">
                                                                    <div class="p-20 text-center flex-column-space-y" style="background-color: rgba(0,0,0,0.5); height: calc(100% - 40px)">
                                                                        <div>{{$product->title}}</div>
                                                                        <div class="border-radius-25 p-10">Перейти к товару</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mr-10" style="flex: 1">
            <div class="border-radius-25 flex-center-y search-container search-container-header pos-rel">
                <img class="img-search" src="/assets/imgs/search.svg" alt="search">
                <input class="w-100 input-search main-search-input" type="text">
            </div>
        </div>
        <div class="show-adaptive-flex mr-10" data-relation-id="mobCatalog">
            <img style="color: white" src="/assets/imgs/catalog.svg" alt="catalog">
        </div>
        <div id="mobCatalog" class="hide" style="position: absolute; top: 60px; left: 0; background-color: rgba(0,0,0,0.8); width: 100vw; height: calc(100vh - 60px);">
            <div style="overflow: scroll;height: calc(100% - 20px);padding: 10px;">
                <div class="mb-10">
                    <div class="border-radius-25 p-10 mb-10 mt-10">Группа</div>
                    @foreach(\App\Models\Categories::all() as $category)
                        <div class="p-5">{{$category->title}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-25 flex-center-y hide-adaptive">
            <div class="w-45">
                <div><a class="text-center color-white" style="text-decoration: none;" href="tel:{{$phone}}">{{$phone}}</a></div>
                <div><a class="text-center color-white" style="text-decoration: none;" href="tel:{{$additionalPhones}}">{{$additionalPhones}}</a></div>
            </div>
            <a class="block w-20" href="mailto:{{$mail}}?subject=Вопрос">
                <img width="50" src="/assets/imgs/email.svg" alt="email">
            </a>
            <div class="w-20" onclick="{{$actionConditionAuth}}">
                <img width="50" src="/assets/imgs/profile.svg" alt="profile">
            </div>
            <a href="{{route('basket-page')}}" class="block w-20 pos-rel">
                <img width="50" src="/assets/imgs/basket.svg" alt="basket">
                <div class="count-item-in-bag" style="position: absolute; top: 0; color: red; right: 0;">

                </div>
            </a>
        </div>
    </div>
    <div class="flex-end-x hide-adaptive">
        <div class="w-25 flex-center-y font-regular">
            <a href="{{route("fast-order-page")}}" class="block mr-10">Быстрое оформление</a>
            <a href="{{route("about-page")}}" class="block">О компании</a>
        </div>
    </div>
</header>
