@if(isset($filters) && sizeof($filters))
    <div class="flex-wrap filters-container">
        @php($requestedArrayOfFilters = explode(',', \request()->get('filters')))

            <?php
                $filtersGroupBy = [];
                foreach($filters as $key => $filter) {
                    $filtersGroupBy[$filter->group][] =  $filter;
                }
            ?>

        <div>
            @foreach($filtersGroupBy as $groupTitle => $filterGroup)

                <div>
                    <div class="mb-10">{{empty($groupTitle) ? "Фильтр" : $groupTitle}}</div>

                    <div class="flex-wrap">
                        @foreach($filterGroup as $filter)
                            <div class="checkbox-wrapper-1 mb-10 mr-10" style="width: min-content;">
                                <input id="filter-{{$filter->id}}" type="checkbox" name="{{$filter->id}}" class="custom-checkbox filter" {{in_array($filter->id, $requestedArrayOfFilters) ? " checked " : ""}} value="{{$filter->id}}">
                                <label for="filter-{{$filter->id}}" style="white-space: nowrap;">
                                    @if($filter->file_id)
                                        <span style="width: 32px; height: 32px;">
                                            <img src="{{route("files", $filter->file_id)}}" alt="">
                                        </span>
                                    @else
                                        {{$filter->title}}
                                    @endif

                                    </label>
                            </div>
                        @endforeach
                    </div>

                </div>

            @endforeach
        </div>

    </div>

@section('js')
    <script>
        document.body.querySelector('.filters-container').querySelectorAll('.filter').forEach((filter) => {
            filter.addEventListener('change', () => {
                let checkedFilters = []
                document.body.querySelector('.filters-container').querySelectorAll('.filter:checked').forEach((checkedFilter) => {
                    checkedFilters.push(`${checkedFilter.value}`)
                })
                console.log(checkedFilters)
                location.href = "{{$route}}?filters=" + checkedFilters.join(",")
            })
        })
    </script>
@endsection
@endif
