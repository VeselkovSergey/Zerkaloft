<?php


namespace App\Http\Controllers\Subcategories;


use App\Models\Categories;
use App\Models\Subcategories;

class SubcategoriesController
{
    public function SubcategoriesAdminPage()
    {
        $allSubCategories = Subcategories::all();
        return view('administration.subcategories.index', [
            'allSubCategories' => $allSubCategories
        ]);
    }

    public function CreateSubcategoryAdminPage()
    {
        $allCategories = Categories::all();
        return view('administration.subcategories.create', [
            'allCategories' => $allCategories
        ]);
    }

    public function EditSubcategoryAdminPage()
    {
        return view('administration.subcategories.edit');
    }
}
