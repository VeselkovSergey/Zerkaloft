@if(isset($bredcrumbs))
    <div class="flex mb-10 font-light px-0-adaptive-10">
        @foreach($bredcrumbs as $title => $link)
            <a class="color-white" href="{{$link}}">{{$title}}</a>
            @if (!$loop->last)
                <div class="mx-10">/</div>
            @endif
        @endforeach
    </div>
@endif
