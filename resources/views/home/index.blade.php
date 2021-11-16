@extends('app')

@section('content')

    <div>

        @if(isset($carouselImages))
{{--Для онлайн заказа (та же страница но без слайдера)--}}

        <div class="carousel mx-a mb-25">

            <div class="carousel-container shadow border-radius-15">
                @php($i = 0)
                @foreach($carouselImages as $carouselImage)
                    <div class="img-carousel {{$i === 0 ? 'active' : ''}}">
                        <img src="{{route('files', $carouselImage)}}" class="w-100 h-100" alt="">
                    </div>
                    @php($i++)
                @endforeach
            </div>

            <div style="position: absolute; top: calc(50% - 24px); left: 24px;">
                <div class="btn-slider btn-slider-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>
            </div>

            <div style="position: absolute; top: calc(50% - 24px); right: 24px;">
                <div class="btn-slider btn-slider-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg>
                </div>
            </div>

        </div>

        @else

        <div class="font-semibold text-center">
            {{\App\Http\Controllers\Administration\SettingsController::OnlineOrderText()}}
        </div>

        @endif

        <div class="flex-wrap-center w-100">

            @foreach(\App\Models\Products::where('show_main_page', 1)->get() as $product)

                <div class="category-cart-main-page p-25">
                    <div class="smooth-block shadow pos-rel border-radius-15 mx-a w-100 h-100">
                        <a href="{{$product->Link()}}">
                            @foreach(unserialize($product->img) as $img)
                                <img style="border-radius: 15px;" src="{{route('files', $img)}}" alt="Изображение {{$product->title}}">
                            @endforeach
                            <div class="shadow-text w-100 h-100 flex-center border-radius-15 pos-abs top-0" style="background-color: rgba(0, 0, 0, 0.2);">
                                <div class="color-white text-center" style="font-size: 24px;">
                                    {{$product->title}}
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            @endforeach

            @foreach(\App\Models\Categories::orderBy('sequence')->get() as $category)

                @foreach(unserialize($category->img) as $img)

                    <div class="category-cart-main-page p-25">

                        <div class="smooth-block shadow pos-rel border-radius-15 mx-a w-100 h-100">
                            <a href="{{route('category', $category->semantic_url)}}">
                                <img class="category-img-main" src="{{route('files', $img)}}" alt="Изображение {{$category->title}}">
                                <div class="shadow-text pos-abs top-0 w-100 h-100 flex-center border-radius-15" style="background-color: rgba(0, 0, 0, 0.2);">
                                    <div class="color-white text-center" style="font-size: 24px;">
                                        {{$category->title}}
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                @endforeach

            @endforeach
{{--            @for($i = 0; $i < 10; $i++)--}}
{{--                <div class="smooth-block" style="width: 48%; margin: 1%; /*border: 1px solid black;*/ border-radius: 15px; box-shadow: 0 0 10px rgb(0 0 0 / 75%);">--}}
{{--                    <img style="width: 100%; height: 350px; border-radius: 15px;" src="img.jpg" alt="">--}}
{{--                </div>--}}
{{--            @endfor--}}
        </div>

    </div>



@stop

@section('js')

@stop
