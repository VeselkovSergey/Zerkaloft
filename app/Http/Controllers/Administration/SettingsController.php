<?php


namespace App\Http\Controllers\Administration;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public string $storagePath = 'img/setting';
    public string $storageDriver = 'local';

    public function EditPhonePage()
    {
        $phone = Settings::where('type', 1)->first();
        $phone = json_decode($phone->value)->phone;
        return view('administration.settings.phone.index', [
            'phone' => $phone
        ]);
    }

    public function SavePhone(Request $request)
    {
        $phone = $request->phone;

        $savePhone = Settings::where('type', 1)->update([
            'value' => json_encode(['phone' => $phone])
        ]);

        return ResultGenerate::Success();
    }

    public function AllCarouselImagesPage()
    {
        $carouselImages = Settings::where('type', 2)->get();
//        $carouselImages = json_decode($carouselImages->value);
        return view('administration.settings.carousel.index', [
            'carouselImages' => $carouselImages
        ]);
    }

    public function CreateCarouselImagePage()
    {
        return view('administration.settings.carousel.create');
    }

    public function SaveCarouselImage(Request $request)
    {
        $carouselImageID = !empty($request->carouselImageID) ? $request->carouselImageID : null;
        $carouselImageSequence = !empty($request->carouselImageSequence) ? $request->carouselImageSequence : null;
        $carouselImages = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$carouselImageSequence) {
            return ResultGenerate::Error('Ошибка! Последовательность не может быть пустым полем!');
        }

        if (!$carouselImages && !$carouselImageID) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        foreach ($carouselImages as $CarouselImage) {
            if (in_array($CarouselImage->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp'])) {
                $saveFile = Files::SaveFile($CarouselImage, $this->storagePath . '/carousel', $this->storageDriver);
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        if ($carouselImageID) {

        } else {
            $saveCarouselImages = Settings::create([
                'type' => 2,
                'value' => json_encode([
                    'fileId' => $saveFile->id,
                    'sequence ' => $carouselImageSequence,
                ]),
            ]);
        }

        dd($saveFile);
        return ResultGenerate::Success();
    }
}
