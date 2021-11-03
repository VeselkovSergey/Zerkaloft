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
        $phone = Settings::where('type', Settings::TypeByWords['mainPhone'])->first();
        $phone = json_decode($phone->value)->phone;
        return view('administration.settings.phone.index', [
            'phone' => $phone
        ]);
    }

    public function SavePhone(Request $request)
    {
        $phone = $request->phone;

        $savePhone = Settings::where('type', Settings::TypeByWords['mainPhone'])->update([
            'value' => json_encode(['phone' => $phone])
        ]);

        return ResultGenerate::Success();
    }

    public function AllCarouselImagesPage()
    {
        $carouselImages = Settings::where('type', Settings::TypeByWords['carouselImage'])->get();
        return view('administration.settings.carousel.index', [
            'carouselImages' => $carouselImages
        ]);
    }

    public function CreateCarouselImagePage()
    {
        return view('administration.settings.carousel.createOrEdit');
    }

    public function EditCarouselImagePage(Request $request)
    {
        $carouselImage = Settings::where('id', $request->carouselImageId)->first();
        $carouselImageValue = json_decode($carouselImage->value);
        return view('administration.settings.carousel.createOrEdit', [
            'carouselImage' => $carouselImage,
            'carouselImageValue' => $carouselImageValue,
        ]);
    }

    public function SaveCarouselImage(Request $request)
    {
        $carouselImageId = !empty($request->carouselImageId) ? $request->carouselImageId : null;
        $carouselImageSequence = !empty($request->carouselImageSequence) ? $request->carouselImageSequence : null;
        $carouselImages = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$carouselImageSequence) {
            return ResultGenerate::Error('Ошибка! Последовательность не может быть пустым полем!');
        }

        if (!$carouselImages && !$carouselImageId) {
            return ResultGenerate::Error('Ошибка! Загрузите картинку!');
        }

        foreach ($carouselImages as $CarouselImage) {
            if (in_array($CarouselImage->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp'])) {
                $saveFile = Files::SaveFile($CarouselImage, $this->storagePath . '/carousel', $this->storageDriver);
            } else {
                return ResultGenerate::Error('Ошибка! Не верный формат файла!');
            }
        }

        if ($carouselImageId) {
            $saveCarouselImages = Settings::where('id', $carouselImageId)->first();

            $saveCarouselImages->update([
                'type' => Settings::TypeByWords['carouselImage'],
                'value' => json_encode([
                    'fileId' => !empty($saveFile) ? $saveFile->id : json_decode($saveCarouselImages->value)->fileId,
                    'sequence' => $carouselImageSequence,
                ]),
            ]);
        } else {
            $saveCarouselImages = Settings::create([
                'type' => Settings::TypeByWords['carouselImage'],
                'value' => json_encode([
                    'fileId' => $saveFile->id,
                    'sequence' => $carouselImageSequence,
                ]),
            ]);
        }

        return ResultGenerate::Success();
    }

    public function DeleteCarouselImage(Request $request)
    {
        $carouselImageId = $request->carouselImageId;

        $deleteCarouselImage = Settings::where('id', $carouselImageId)->first();

        if ($deleteCarouselImage->delete()) {
            return ResultGenerate::Success('Картинка карусели успешно удалена!');
        }
        return ResultGenerate::Error('Ошибка удаления картинки карусели!');
    }

    public function AllUsersPage()
    {
        $users = User::all();
        return view('administration.users.index', [
            'users' => $users,
        ]);
    }

    public function ChangeRole()
    {
        $user = User::query()->find(\request()->userId);
        $user->role = \request()->role;
        $user->save();
        return ResultGenerate::Success();
    }

    public function AllTextsPage()
    {
        return view('administration.settings.texts.index', [
            'calculatorPageText' => self::CalculatorPageText(),
            'onlineOrderPageText' => self::OnlineOrderText(),
        ]);
    }

    public static function CalculatorPageText()
    {
        $calculatorPageText = Settings::where('type', Settings::TypeByWords['calculatorPageText'])->first();
        return json_decode($calculatorPageText->value)->text;
    }

    public function SaveCalculatorText(Request $request)
    {
        $calculatorText = $request->calculatorText;
        $calculatorPageText = Settings::where('type', Settings::TypeByWords['calculatorPageText'])->first();
        $calculatorPageText->update([
            'value' => json_encode(['text' => $calculatorText])
        ]);
        return ResultGenerate::Success();
    }

    public static function OnlineOrderText()
    {
        $onlineOrderPageText = Settings::where('type', Settings::TypeByWords['onlineOrderPageText'])->first();
        return json_decode($onlineOrderPageText->value)->text;
    }

    public function SaveOnlineOrderText(Request $request)
    {
        $onlineOrderText = $request->onlineOrderText;
        $onlineOrderPageText = Settings::where('type', Settings::TypeByWords['onlineOrderPageText'])->first();
        $onlineOrderPageText->update([
            'value' => json_encode(['text' => $onlineOrderText])
        ]);
        return ResultGenerate::Success();
    }

    public static function FastOrderText()
    {
        $fastOrderPageText = Settings::where('type', Settings::TypeByWords['fastOrderPageText'])->first();
        return json_decode($fastOrderPageText->value)->text;
    }

    public function SaveFastOrderText(Request $request)
    {
        $fastOrderText = $request->fastOrderText;
        $fastOrderPageText = Settings::where('type', Settings::TypeByWords['fastOrderPageText'])->first();
        $fastOrderPageText->update([
            'value' => json_encode(['text' => $fastOrderText])
        ]);
        return ResultGenerate::Success();
    }
}