@extends('app')

@section('content')

    <div class="container-calculator">
        <div>
            <div class="container-categories">
                <label for="">Категория</label>
            </div>
            <div class="container-categories-properties"></div>
        </div>
        <div class="container-found-product"></div>
    </div>

@stop

@section('js')

    <script>

        let selectorCategories = GenerationFormSelect(JSON.parse('@json($allCategories->pluck('title', 'id')->prepend('Выберите категорию', 0), JSON_UNESCAPED_UNICODE)'), 'category', 0, true);

        let containerCategories = document.body.querySelector('.container-categories').append(selectorCategories);
        let containerCategoriesProperties = document.body.querySelector('.container-categories-properties');
        let containerFoundProduct = document.body.querySelector('.container-found-product');

        let containerCalculator = document.body.querySelector('.container-calculator');
        let filedCategory = containerCalculator.querySelector('select[name="category"]');
        filedCategory.addEventListener('change', (event) => {
            let select = event.target;
            let categoryId = select.value;
            if (categoryId != 0) {
                Ajax("{{route('category-properties')}}", 'post', {categoryId: categoryId}).then((response) => {
                    if (response.status === true) {
                        let obj = response.result;
                        containerCategoriesProperties.innerHTML = '';
                        Object.keys(obj).forEach((key) => {
                            let propertySelector = GenerationFormSelect(obj[key].propertyValues, obj[key].propertyTitleTransliterate, 0, true)
                            propertySelector.addEventListener('change', (event) => {
                                let modification = [];
                                let allSelected = true;
                                containerCategoriesProperties.querySelectorAll('select').forEach((property) => {
                                    modification.push(property.value)
                                    if (property.value == 0) {
                                        allSelected = false;
                                    }
                                });
                                if (allSelected === true) {
                                    Ajax("{{route('product-modification')}}", 'post', {
                                        categoryId: categoryId,
                                        modification: modification
                                    }).then((response) => {
                                        let res = response.result;
                                        containerFoundProduct.innerHTML = '';
                                        let product = CreateElement('div', {
                                            content: res.product.title
                                        });
                                        containerFoundProduct.append(product);
                                        let options = '';
                                        let i = 0;
                                        Object.keys(res.productPrices).forEach((key) => {
                                            let selectedAttr = i === 0 ? 'selected' : '';
                                            let priceTitle = res.productPrices[key]['count'] + res.productPrices[key]['price'];
                                            let priceId = res.productPrices[key]['id']
                                            options += '<option ' + selectedAttr + 'value="' + priceId + '">' + priceTitle + '</option>';
                                            i++;
                                        });
                                        let selectorPrices = CreateElement('select', {
                                            attr: {name: name},
                                            content: options
                                        });
                                        containerFoundProduct.append(selectorPrices);
                                    });
                                }
                            });
                            let containerProperty = CreateElement('div', {
                                childs: [
                                    CreateElement('label', {content: obj[key].propertyTitle}),
                                    propertySelector,
                                ]
                            });
                            containerCategoriesProperties.append(containerProperty);
                        });
                    }
                });
            }
        });

    </script>

@stop
