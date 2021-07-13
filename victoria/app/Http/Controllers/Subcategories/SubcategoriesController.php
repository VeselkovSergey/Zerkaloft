<?php


namespace App\Http\Controllers\Subcategories;


class SubcategoriesController
{
    public function SubcategoriesAdminPage()
    {
        return view('administration.subcategories.index');
    }

    public function CreateSubcategoryAdminPage()
    {
        return view('administration.subcategories.create');
    }

    public function EditSubcategoryAdminPage()
    {
        return view('administration.subcategories.edit');
    }
}
