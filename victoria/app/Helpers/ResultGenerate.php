<?php


namespace App\Helpers;


class ResultGenerate
{
    /**
     * @param array|object $object
     * @param bool $status
     * @param string $message
     * @return bool|string
     */
    public static function Success(array|object $object = [], bool $status = true, string $message = 'Успешно!'): bool|string
    {
        return json_encode((object)[
            'status' => $status,
            'message' => $message,
            'result' => $object,
        ]);
    }

    public static function Error(string $message = 'Ошибка!', array|object $object = [], bool $status = false): bool|string
    {
        return json_encode((object)[
            'status' => $status,
            'message' => $message,
            'result' => $object,
        ]);
    }
}
