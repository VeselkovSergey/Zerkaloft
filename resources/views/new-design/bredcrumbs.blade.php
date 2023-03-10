@if(isset($bredcrumbs))
    <div class="flex mb-10 font-light">
        @foreach($bredcrumbs as $title => $link)
            <a href="{{$link}}">{{$title}}</a>
            @if (!$loop->last)
                <div class="mx-10">/</div>
            @endif
        @endforeach
    </div>
@endif
