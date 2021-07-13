<?php


namespace App\Http\Controllers\Products;


class ProductsController
{
    public function ProductsAdminPage()
    {
        return view('administration.products.index');
    }

    public function CreateProductAdminPage()
    {
        return view('administration.products.create');
    }

    public function EditProductAdminPage()
    {
        return view('administration.products.edit');
    }
}
