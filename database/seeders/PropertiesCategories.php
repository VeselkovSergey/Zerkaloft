<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertiesCategories extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $propertyCategoriesTitles = [
            'Размер' => [
                '10*20',
                '10*30',
            ],
            'Цвет' => [
                'Черный',
                'Белый',
            ],
            'Стороны' => [
                '1 сторона',
                '2 стороны',
            ],
        ];
        foreach ($propertyCategoriesTitles as $propertyCategoriesTitle => $propertyCategoriesValues) {
            $createdPropertyCategories = \App\Models\PropertiesCategories\PropertiesCategories::create([
                'title' => $propertyCategoriesTitle
            ]);
            foreach ($propertyCategoriesValues as $propertyCategoriesValue) {
                $createdPropertyCategoriesValue = new \App\Models\PropertiesCategories\PropertiesCategoriesValues();
                $createdPropertyCategoriesValue->properties_categories_id = $createdPropertyCategories->id;
                $createdPropertyCategoriesValue->value = $propertyCategoriesValue;
                $createdPropertyCategoriesValue->save();
            }
        }
    }
}
