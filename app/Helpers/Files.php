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

    public static function GetFileHTTP(Request $request)
    {
        $file = FilesDB::find($request->file_id);
        if ($file) {
            $filePath = Storage::disk($file->disk)->get($file->path . '/' . $file->hash_name);
            $response = response($filePath);
            $response->header('Content-type', $file->type);
            $response->header('Cache-Control', 'public');
            $response->header('Cache-Control', 'max-age=86400');
            return $response;
        }
        return abort(404);
    }

    public static function GetFile($fileIdOrName)
    {
        if (is_int($fileIdOrName)) {
            $columnName = 'id';
        } else {
            $columnName = 'original_name';
        }

        $file = FilesDB::where($columnName, $fileIdOrName)->first();

        if ($file) {
            return (object)[
                'modelFile' => $file,
                'contentFile' => Storage::disk($file->disk)->get($file->path . '/' . $file->hash_name),
            ];
        }
        return false;
    }
}
