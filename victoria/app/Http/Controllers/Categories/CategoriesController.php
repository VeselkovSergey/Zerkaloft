<?php


namespace App\Http\Controllers\Categories;


class CategoriesController
{
    public function CategoriesAdminPage()
    {
        return view('administration.categories.index');
    }

    public function CreateCategoryAdminPage()
    {
        return view('administration.categories.create');
    }

    public function EditCategoryAdminPage()
    {
        return view('administration.categories.edit');
    }
}
