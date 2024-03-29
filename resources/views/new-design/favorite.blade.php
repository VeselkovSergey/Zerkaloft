<style>
    .wrap-adaptive-nowrap {
        flex-wrap: wrap;
    }
    @media screen and (max-width: 540px) {
        .wrap-adaptive-nowrap {
            flex-wrap: nowrap;
            overflow: scroll;
            justify-content: normal;
        }

        .mr-10-children > div:not(:last-child) {
            margin-right: 10px;
        }
    }
</style>
@php
    $popularProducts = \App\Models\Products::where('isPopular', 1)->with('Prices')->get();
    $favouriteProducts = \App\Models\Products::whereIn('id', session()->get("favouriteProducts") ?? [])->with('Prices')->get();
@endphp
<div class="favorite-page {{sizeof($popularProducts) ? "" : " hide "}}">
    <div>
        <div class="py-20">
            <div class="h3" style="border: 1px solid white; border-radius: 30px; padding: 10px; width: max-content;">Популярное</div>
        </div>
        <div class="flex wrap-adaptive-nowrap mr-10-children">
            @foreach($popularProducts as $product)
            <a href="{{$product->Link()}}" class="block w-33-adaptive-40vw pos-rel product-container mr-0-adaptive-10">
                <div>
                    <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                </div>
                <div class="show-adaptive border-radius-25 mb-10 p-5 text-center"
                     style="background-color: white; color: black">от {{$product->Prices->first()->price}}
                </div>
                <div class="show-adaptive w-100 mb-10">{{$product->title}}</div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="p-10 w-100 mb-10">{{$product->title}}</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">от {{$product->Prices->first()->price}}
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<div class="favorite-page {{sizeof($favouriteProducts) ? "" : " hide "}}">
    <div class="pb-10">
        <div class="p-20">
            <div class="h3" style="border: 1px solid white; border-radius: 30px; padding: 10px; width: max-content;">Понравилось</div>
        </div>
        <div class="flex wrap-adaptive-nowrap mx-10 mr-10-children">
            @foreach($favouriteProducts as $product)
                <a href="{{$product->Link()}}" class="block w-33-adaptive-40vw pos-rel product-container mr-0-adaptive-10">
                    <div>
                        <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                    </div>
                    <div class="show-adaptive border-radius-25 mb-10 p-5 text-center"
                         style="background-color: white; color: black">от {{$product->Prices->first()->price}}
                    </div>
                    <div class="show-adaptive w-100 mb-10">{{$product->title}}</div>
                    <div class="product-description z-1 pos-abs">
                        <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                            <div class="p-10 w-100 mb-10">{{$product->title}}</div>
                            <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                 style="background-color: white; color: black">от {{$product->Prices->first()->price}}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="flex-center mt-20">
    <div class="w-50-adaptive-100" style="height:600px;overflow:hidden;position:relative;">
        <iframe style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:10px;box-sizing:border-box; border: unset;"
                src="https://yandex.ru/maps-reviews-widget/137015034255?comments&theme=dark"></iframe>
        <a href="https://yandex.ru/maps/org/loft_magazin_zerkal/137015034255/" target="_blank"
           style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:YS Text,sans-serif;padding:0 20px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;padding:0 16px;box-sizing:border-box">Loft
            магазин зеркал на карте Москвы — Яндекс Карты</a></div>
</div>
