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
    $popularProducts = \App\Models\Products::where('isPopular', 1)->get();
    $favouriteProducts = \App\Models\Products::whereIn('id', session()->get("favouriteProducts") ?? [])->get();
@endphp
<div class="favorite-page {{sizeof($popularProducts) ? "" : " hide "}}">
    <div class="pb-10">
        <div class="p-20">
            <div style="border: 1px solid white; border-radius: 30px; padding: 10px; width: max-content;">Популярное</div>
        </div>
        <div class="flex wrap-adaptive-nowrap mx-10 mr-10-children">
            @foreach($popularProducts as $product)
            <a href="{{$product->Link()}}" class="block w-33-adaptive-40vw pos-rel product-container mr-0-adaptive-10">
                <div>
                    <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                </div>
                <div class="show-adaptive border-radius-25 mb-10 p-5 text-center"
                     style="background-color: white; color: black">К ТОВАРУ
                </div>
                <div class="show-adaptive w-100 mb-10" style="color: black;">{{$product->title}}</div>
                <div class="product-description z-1 pos-abs">
                    <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                        <div class="p-10 w-100 mb-10">{{$product->title}}</div>
                        <div class="border-radius-25 p-10 mt-a w-100 text-center"
                             style="background-color: white; color: black">К ТОВАРУ
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
            <div style="border: 1px solid white; border-radius: 30px; padding: 10px; width: max-content;">Понравилось</div>
        </div>
        <div class="flex wrap-adaptive-nowrap mx-10 mr-10-children">
            @foreach($favouriteProducts as $product)
                <a href="{{$product->Link()}}" class="block w-33-adaptive-40vw pos-rel product-container mr-0-adaptive-10">
                    <div>
                        <img style="" src="{{$product->FirstImgUrl()}}" alt="{{$product->title}}">
                    </div>
                    <div class="show-adaptive border-radius-25 mb-10 p-5 text-center"
                         style="background-color: white; color: black">К ТОВАРУ
                    </div>
                    <div class="show-adaptive w-100 mb-10" style="color: black;">{{$product->title}}</div>
                    <div class="product-description z-1 pos-abs">
                        <div class="flex-column-center p-20" style="height: calc(100% - 40px)">
                            <div class="p-10 w-100 mb-10">{{$product->title}}</div>
                            <div class="border-radius-25 p-10 mt-a w-100 text-center"
                                 style="background-color: white; color: black">К ТОВАРУ
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
