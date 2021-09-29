<?php


namespace App\Helpers;

use Illuminate\Http\FileHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Models\Files as FilesDB;
use Illuminate\Support\Facades\Storage;

class Files
{
    public static function SaveFile(UploadedFile $file, string $path = 'files', string $disk = 'local')
    {
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->extension();
        $type = $file->getMimeType();
        $hashFileName = pathinfo($file->hashName(), PATHINFO_FILENAME);
        $file->storeAs($path, $hashFileName, $disk);

        return FilesDB::create([
            'hash_name' => $hashFileName,
            'original_name' => $originalFileName,
            'extension' => $extension,
            'type' => $type,
            'disk' => $disk,
            'path' => $path,
        ]);
    }

    public static function DeleteFiles($filesId)
    {
        if (is_array($filesId)) {
            $filesDb = FilesDB::whereIn('id', $filesId)->get();
            foreach ($filesDb as $file) {
                Storage::disk($file->disk)->delete($file->path . '/' . $file->hash_name);
                $file->delete();
            }
        } else {
            $file = FilesDB::find($filesId);
            if ($file) {
                return Storage::disk($file->disk)->delete($file->path . '/' . $file->hash_name);
            }
        }
        return false;
    }

    public static function GetFile(Request $request)
    {
        $file = FilesDB::find($request->file_id);
        if ($file) {
            $filePath = Storage::disk($file->disk)->get($file->path . '/' . $file->hash_name);
            return response($filePath)->header('Content-type', $file->type);
        }
        return abort(404);
    }
}
