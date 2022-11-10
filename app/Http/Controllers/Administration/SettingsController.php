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

        $viberPhone = Settings::where('type', Settings::TypeByWords['viberPhone'])->first();
        $viberPhone = json_decode($viberPhone->value)->viberPhone;

        $whatsappPhone = Settings::where('type', Settings::TypeByWords['whatsappPhone'])->first();
        $whatsappPhone = json_decode($whatsappPhone->value)->whatsappPhone;

        $telegramPhone = Settings::where('type', Settings::TypeByWords['telegramPhone'])->first();
        $telegramPhone = json_decode($telegramPhone->value)->telegramPhone;

        $mail = Settings::where('type', Settings::TypeByWords['mail'])->first();
        $mail = json_decode($mail->value)->mail;

        $address = Settings::where('type', Settings::TypeByWords['address'])->first();
        $address = json_decode($address->value)->address;

        return view('administration.settings.phone.index', [
            'phone' => $phone,
            'additionalPhones' => $additionalPhones,
            'viberPhone' => $viberPhone,
            'whatsappPhone' => $whatsappPhone,
            'telegramPhone' => $telegramPhone,
            'mail' => $mail,
            'address' => $address,
        ]);
    }

    public function SavePhone(Request $request)
    {
        $phone = $request->phone;
        $additionalPhones = $request->additionalPhones;
        $viberPhone = $request->viberPhone;
        $whatsappPhone = $request->whatsappPhone;
        $telegramPhone = $request->telegramPhone;
        $mail = $request->mail;
        $address = $request->address;

        $savePhone = Settings::where('type', Settings::TypeByWords['mainPhone'])->update([
            'value' => json_encode(['phone' => $phone])
        ]);

        $saveAdditionalPhones = Settings::where('type', Settings::TypeByWords['additionalPhones'])->update([
            'value' => json_encode(['additionalPhones' => $additionalPhones])
        ]);

        $saveViberPhone = Settings::where('type', Settings::TypeByWords['viberPhone'])->update([
            'value' => json_encode(['viberPhone' => $viberPhone])
        ]);

        $saveWhatsappPhone = Settings::where('type', Settings::TypeByWords['whatsappPhone'])->update([
            'value' => json_encode(['whatsappPhone' => $whatsappPhone])
        ]);

        $saveTelegramPhone = Settings::where('type', Settings::TypeByWords['telegramPhone'])->update([
            'value' => json_encode(['telegramPhone' => $telegramPhone])
        ]);

        $saveMail = Settings::where('type', Settings::TypeByWords['mail'])->update([
            'value' => json_encode(['mail' => $mail])
        ]);

        $saveAddress = Settings::where('type', Settings::TypeByWords['address'])->update([
            'value' => json_encode(['address' => $address])
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
            if (in_array($CarouselImage->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp'])) {
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
            'aboutPageInfo' => self::AboutInfo(),
            'footerText' => self::FooterText(),
            'fastMenuSetting' => self::GetFastMenu(),
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
                if (in_array($calculatorImage->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
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
                if (in_array($onlineOrderImage->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
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
                if (in_array($fastOrderImage->getMimeType(), ['image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
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

    public static function AboutInfo()
    {
        $aboutPageText = Settings::where('type', Settings::TypeByWords['aboutPageText'])->first();
        return json_decode($aboutPageText->value);
    }

    public static function FooterText()
    {
        $footerText = Settings::where('type', Settings::TypeByWords['footerText'])->first();
        return json_decode($footerText->value);
    }

    public function SaveAboutInfo(Request $request)
    {
        $aboutText = $request->aboutText;
        $aboutPage = Settings::where('type', Settings::TypeByWords['aboutPageText'])->first();

        $aboutPage->update([
            'value' => json_encode(['text' => $aboutText])
        ]);

        return ResultGenerate::Success();
    }

    public function SaveFooterInfo(Request $request)
    {
        $footerText = $request->footerText;
        $model = Settings::where('type', Settings::TypeByWords['footerText'])->first();

        $model->update([
            'value' => json_encode(['text' => $footerText])
        ]);

        return ResultGenerate::Success();
    }

    public function SaveHeaderLogo(Request $request)
    {
        $headerLogo = !empty($request->allFiles()) ? $request->allFiles() : null;
        $model = Settings::where('type', Settings::TypeByWords['headerLogo'])->first();

        $fileId = -1;
        if (!empty($headerLogo)) {
            foreach ($headerLogo as $headerLogoItem) {
                if (in_array($headerLogoItem->getMimeType(), ['image/svg+xml', 'image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($headerLogoItem, $this->storagePath, $this->storageDriver);
                    $fileId = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $model->update([
            'value' => json_encode(['imageFileId' => $fileId])
        ]);

        return ResultGenerate::Success();
    }

    public static function GetHeaderLogo()
    {
        $model = Settings::where('type', Settings::TypeByWords['headerLogo'])->first();
        return json_decode($model->value);
    }

    public function SaveBodyImage(Request $request)
    {
        $images = !empty($request->allFiles()) ? $request->allFiles() : null;
        $model = Settings::where('type', Settings::TypeByWords['bodyImage'])->first();

        $fileId = -1;
        if (!empty($images)) {
            foreach ($images as $image) {
                if (in_array($image->getMimeType(), ['image/svg+xml', 'image/jpg', 'image/jpeg', 'image/webp', 'image/png', 'image/bmp', 'image/gif'])) {
                    $saveFile = Files::SaveFile($image, $this->storagePath, $this->storageDriver);
                    $fileId = $saveFile->id;
                } else {
                    return ResultGenerate::Error('Ошибка! Не верный формат файла!');
                }
            }
        }

        $model->update([
            'value' => json_encode(['imageFileId' => $fileId])
        ]);

        return ResultGenerate::Success();
    }

    public static function GetBodyImage()
    {
        $model = Settings::where('type', Settings::TypeByWords['bodyImage'])->first();
        return json_decode($model->value);
    }

    public function SaveFastMenu(Request $request)
    {
        $fastOrderLink = $request->fastOrderLink;
        $calculatorLink = $request->calculatorLink;
        $onlineOrderLink = $request->onlineOrderLink;
        $specialOrderLink = $request->specialOrderLink;
        $buttonUploadDesign = $request->buttonUploadDesign;
        $model = Settings::where('type', Settings::TypeByWords['fastMenu'])->first();

        $model->update([
            'value' => json_encode(compact(
                'fastOrderLink',
                'calculatorLink',
                'onlineOrderLink',
                'specialOrderLink',
                'buttonUploadDesign'
            ))
        ]);

        return ResultGenerate::Success();
    }

    public static function GetFastMenu()
    {
        $model = Settings::where('type', Settings::TypeByWords['fastMenu'])->first();
        return json_decode($model->value);
    }
}
