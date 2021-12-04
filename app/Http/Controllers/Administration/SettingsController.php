<?php


namespace App\Http\Controllers\Administration;


use App\Helpers\Files;
use App\Helpers\ResultGenerate;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public string $storagePath = 'img/setting';
    public string $storageDriver = 'local';

    public function EditPhonePage()
    {
        $phone = Settings::where('type', Settings::TypeByWords['mainPhone'])->first();
        $phone = json_decode($phone->value)->phone;

        $additionalPhones = Settings::where('type', Settings::TypeByWords['additionalPhones'])->first();
        $additionalPhones = json_decode($additionalPhones->value)->additionalPhones;
        return view('administration.settings.phone.index', [
            'phone' => $phone,
            'additionalPhones' => $additionalPhones,
        ]);
    }

    public function SavePhone(Request $request)
    {
        $phone = $request->phone;
        $additionalPhones = $request->additionalPhones;

        $savePhone = Settings::where('type', Settings::TypeByWords['mainPhone'])->update([
            'value' => json_encode(['phone' => $phone])
        ]);

        $savePhone = Settings::where('type', Settings::TypeByWords['additionalPhones'])->update([
            'value' => json_encode(['additionalPhones' => $additionalPhones])
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
        $carouselImageLink = !empty($request->carouselImageLink) ? $request->carouselImageLink : null;
        $carouselImages = !empty($request->allFiles()) ? $request->allFiles() : [];

        if (!$carouselImageSequence) {
            return ResultGenerate::Error('Ошибка! Последовательность не может быть пустым полем!');
        }

        if (!$carouselImageLink) {
            return ResultGenerate::Error('Ошибка! Ссылка не может быть пустым полем!');
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
                    'link' => $carouselImageLink,
                ]),
            ]);
        } else {
            $saveCarouselImages = Settings::create([
                'type' => Settings::TypeByWords['carouselImage'],
                'value' => json_encode([
                    'fileId' => $saveFile->id,
                    'sequence' => $carouselImageSequence,
                    'link' => $carouselImageLink,
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
            'calculatorPageInfo' => self::CalculatorPageInfo(),
            'onlineOrderPageInfo' => self::OnlineOrderInfo(),
            'fastOrderPageInfo' => self::FastOrderInfo(),
        ]);
    }

    public static function CalculatorPageInfo()
    {
        $calculatorPageText = Settings::where('type', Settings::TypeByWords['calculatorPageText'])->first();
        return json_decode($calculatorPageText->value);
    }

    public function SaveCalculatorInfo(Request $request)
    {
        $calculatorText = $request->calculatorText;
        $carouselImages = !empty($request->allFiles()) ? $request->allFiles() : null;
        $calculatorPageText = Settings::where('type', Settings::TypeByWords['calculatorPageText'])->first();

        $fileId = -1;
        if (!empty($carouselImages)) {
            foreach ($carouselImages as $calculatorImage) {
                if (in_array($calculatorImage->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($calculatorImage, $this->storagePath, $this->storageDriver);
                    $fileId = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $calculatorPageText->update([
            'value' => json_encode(['text' => $calculatorText, 'imageFileId' => $fileId])
        ]);

        return ResultGenerate::Success();
    }

    public static function OnlineOrderInfo()
    {
        $onlineOrderPageText = Settings::where('type', Settings::TypeByWords['onlineOrderPageText'])->first();
        return json_decode($onlineOrderPageText->value);
    }

    public function SaveOnlineOrderInfo(Request $request)
    {
        $onlineOrderText = $request->onlineOrderText;
        $onlineOrderImages = !empty($request->allFiles()) ? $request->allFiles() : null;
        $onlineOrderPageText = Settings::where('type', Settings::TypeByWords['onlineOrderPageText'])->first();

        $fileId = -1;
        if (!empty($onlineOrderImages)) {
            foreach ($onlineOrderImages as $onlineOrderImage) {
                if (in_array($onlineOrderImage->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($onlineOrderImage, $this->storagePath, $this->storageDriver);
                    $fileId = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $onlineOrderPageText->update([
            'value' => json_encode(['text' => $onlineOrderText, 'imageFileId' => $fileId])
        ]);

        return ResultGenerate::Success();
    }

    public static function FastOrderInfo()
    {
        $fastOrderPageText = Settings::where('type', Settings::TypeByWords['fastOrderPageText'])->first();
        return json_decode($fastOrderPageText->value);
    }

    public function SaveFastOrderInfo(Request $request)
    {
        $fastOrderText = $request->fastOrderText;
        $fastOrderImages = !empty($request->allFiles()) ? $request->allFiles() : null;
        $fastOrderPageText = Settings::where('type', Settings::TypeByWords['fastOrderPageText'])->first();

        $fileId = -1;
        if (!empty($fastOrderImages)) {
            foreach ($fastOrderImages as $fastOrderImage) {
                if (in_array($fastOrderImage->getMimeType(), ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($fastOrderImage, $this->storagePath, $this->storageDriver);
                    $fileId = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $fastOrderPageText->update([
            'value' => json_encode(['text' => $fastOrderText, 'imageFileId' => $fileId])
        ]);

        return ResultGenerate::Success();
    }
}