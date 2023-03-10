<?php

$bredcrumbs = [
    "Главная",
    "Каталог",
];

?>

@if(isset($bredcrumbs))
    <div class="flex mb-10 font-light">
        @foreach($bredcrumbs as $bredcrumb)
            <div>{{$bredcrumb}}</div>
            @if (!$loop->last)
                <div class="mx-10">/</div>
            @endif
        @endforeach
    </div>
@endif
