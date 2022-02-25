<?php


namespace App\Http\Controllers;

use App\Helpers\Files;
use App\Models\Categories;
use App\Models\Settings;
use Illuminate\Http\Request;

class HomeController
{
    public function Index(Request $request)
    {
        $carouselImagesInSetting = Settings::where('type', 2)->get();
        $carouselImages = [];
        foreach ($carouselImagesInSetting as $carouselImageInSetting) {
            $value = json_decode($carouselImageInSetting->value);
            $sequence = $value->sequence;
            $fileId = $value->fileId;
            $link = $value->link;
//            $file = Files::GetFile($fileId);
            $carouselImages[$sequence] = (object)compact('fileId', 'link');

        }
        ksort($carouselImages);
        return view('home.index', [
            'carouselImages' => $carouselImages,
        ]);
    }

    public function OnlineOrder(Request $request)
    {
        return view('home.index');
    }

    public function About(Request $request)
    {
        $aboutPage = Settings::where('type', Settings::TypeByWords['aboutPageText'])->first();
        $aboutPage = json_decode($aboutPage->value);
        return view('home.about', compact('aboutPage'));
    }

    public function Contacts(Request $request)
    {
        return view('home.contacts');
    }

    public function SiteMap()
    {
        $categories = Categories::all();
        return response()->view('sitemap', compact('categories'))->header('Content-Type', 'text/xml');
    }
}
