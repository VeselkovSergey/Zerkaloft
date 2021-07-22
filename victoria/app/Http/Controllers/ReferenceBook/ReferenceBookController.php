<?php


namespace App\Http\Controllers\ReferenceBook;


use App\Helpers\ResultGenerate;
use App\Helpers\StringHelper;
use App\Models\ReferenceBooks;
use Illuminate\Http\Request;

class ReferenceBookController
{
    public function ReferenceBooksAdminPage()
    {
        $allProducts = ReferenceBooks::all();
        return view('administration.reference-book.index', [
            'allProducts' => $allProducts
        ]);
    }

    public function CreateReferenceBookAdminPage()
    {
        return view('administration.reference-book.create');
    }

    public function EditReferenceBookAdminPage(Request $request)
    {
        $referenceBookID = !empty($request->reference_book_id) ? $request->reference_book_id : null;

        if ($referenceBookID) {
            $referenceBook = ReferenceBooks::findOrFail($referenceBookID);
            return view('administration.reference-book.edit', [
                'referenceBook' => $referenceBook
            ]);
        }

        return abort(404);

    }

    public function SaveReferenceBook(Request $request): string
    {
        $referenceBookID = !empty($request->reference_book_id) ? $request->reference_book_id : null;
        $referenceBookName = !empty($request->reference_book_name) ? $request->reference_book_name : null;
        $referenceBookValue = !empty($request->reference_book_value) ? $request->reference_book_value : null;
        $referenceBookMeasure = !empty($request->reference_book_measure) ? $request->reference_book_measure : null;

        if (!$referenceBookName) {
            return ResultGenerate::Error('Ошибка! Название не может быть пустым!');
        }

        if (!$referenceBookValue) {
            return ResultGenerate::Error('Ошибка! Значение не может быть пустым!');
        }

        if (!$referenceBookMeasure) {
            return ResultGenerate::Error('Ошибка! Единица измерения не может быть пустой!');
        }

        $fields['title'] = $referenceBookName;
        $fields['value'] = $referenceBookValue;
        $fields['measure'] = $referenceBookMeasure;

        if (!$referenceBookID) {
            $referenceBookFind = ReferenceBooks::find($referenceBookID);
            if ($referenceBookFind) {
                $referenceBookUpdate = $referenceBookFind->update($fields);
                if ($referenceBookUpdate) {
                    return ResultGenerate::Success('Продукт обновлен успешно!');
                }
                return ResultGenerate::Error('Ошибка обновления продукта!');
            }

        } else {
            $referenceBook = ReferenceBooks::create($fields);
            if ($referenceBook) {
                return ResultGenerate::Success('Продукт создан успешно!');
            }
            return ResultGenerate::Error('Ошибка создания продукта!');
        }
        return ResultGenerate::Error('Непредвиденная ошибка. Попробуйте позже или обратитесь в поддержку!');

    }

    public function ReferenceBookPage(Request $request)
    {
        $product = ReferenceBooks::where('semantic_url', $request->product_semantic_url)->firstOrFail();
        return view('catalog.product', [
            'product' => $product,
        ]);
    }
}
