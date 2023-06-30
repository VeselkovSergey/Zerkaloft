@if(isset($bredcrumbs))
    <div class="flex-wrap mb-10 font-light px-0-adaptive-10">
        @foreach($bredcrumbs as $title => $link)
            @if (!$loop->last)
                <a class="color-white" href="{{$link}}">{{$title}}</a>
                <div class="mx-10">/</div>
            @else
                <div class="color-white">{{$title}}</div>
            @endif
        @endforeach
    </div>
@endif
