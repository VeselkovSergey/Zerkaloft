<?php


namespace App\Http\Controllers;

use App\Helpers\Files;
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
//            $file = Files::GetFile($fileId);
            $carouselImages[$sequence] = $fileId;

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

        return view('home.about');
    }

    public function Contacts(Request $request)
    {
        return view('home.contacts');
    }
}
