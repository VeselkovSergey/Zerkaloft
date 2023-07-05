@if(isset($filters) && sizeof($filters))
    <div class="flex-wrap filters-container">
        @php($requestedArrayOfFilters = explode(',', \request()->get('filters')))
        @foreach($filters as $filter)
            <div class="checkbox-wrapper-1 mb-20 mr-20" style="width: min-content;">
                <input id="filter-{{$filter->id}}" type="checkbox" name="{{$filter->id}}" class="custom-checkbox filter" {{in_array($filter->id, $requestedArrayOfFilters) ? " checked " : ""}} value="{{$filter->id}}">
                <label for="filter-{{$filter->id}}" style="white-space: nowrap;">{{$filter->title}}</label>
            </div>
        @endforeach
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
