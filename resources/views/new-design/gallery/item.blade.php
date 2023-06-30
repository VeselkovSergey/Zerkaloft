@php
    $bredcrumbs = [
        "Главная" => route("home-page"),
        'Галерея' => route('gallery'),
        'Выполненная работа' => $item->link(),
    ];
@endphp

@extends("new-design.app")

@section("content")

    @php($title_page = $item->description)

    @php($metaDescription = $item->description)

    <style>

        .order-2-4 {
            order: 2;
        }

        .order-4-2 {
            order: 4;
        }

        @media screen and (max-width: 540px) {

            .order-2-4 {
                order: 4;
            }

            .order-4-2 {
                order: 2;
            }
        }
    </style>

    <div>

        @include("new-design.bredcrumbs", $bredcrumbs)

        <div data-product-id="{{$item->id}}" class="product-id hide">{{$item->id}}</div>

        <div class="flex-wrap px-10">
            <div class="w-25-adaptive-100" style="order: 1;">
                <div class="mb-10 mr-10-adaptive-0 slider-product">
                    @foreach(unserialize($item->img) as $img)
                        <img style="max-height: calc(65vh);" src="{{route('files', $img)}}" alt="{{$item->description}}">
                    @endforeach
                </div>
            </div>
            <div class="w-40-adaptive-100" style="order: 3;">
                <div>
                    <div class="h3">Описание</div>
                    <p>{!! $item->description !!}</p>
                </div>
                <div>
                    <div class="h3">Технические характеристики</div>
                    <p>{!! $item->tech_properties !!}</p>
                </div>
            </div>
        </div>
        <div class="mb-10 w-a-adaptive-100 flex" style="flex-wrap: wrap;">
            <div class="request-same-product border-radius-25 p-10 mt-a text-center cp mb-10"
                 style="background-color: white; color: black;">Хочу такой же
            </div>
        </div>
        @include("new-design.favorite")
        @include("new-design.info")
    </div>
@endsection

@section("js")
    <script>
        slider(document.body.querySelector('.slider-product'))
        document.body.querySelector('.request-same-product').addEventListener('click', () => {
            requestCallBack(`Понравился данный товар: ${location.href} Прошу связаться со мной для уточнения параметров.`)
        })
    </script>
@endsection
