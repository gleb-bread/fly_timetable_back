<?php

namespace App\DTO;

use App\Enums\ResponseMessage;

class ResponseData
{
    public string | ResponseMessage $message;
    public $data;
    public int $status;

    /**
     * ResponseData constructor.
     *
     * @param string $message Сообщение для ответа
     * @param mixed $data Данные, которые нужно отправить в ответе (объект или массив)
     * @param int $status HTTP статус код (по умолчанию 200)
     */
    public function __construct(string | ResponseMessage $message = '', $data = null, int $status = 200)
    {
        $this->message = $message;
        $this->data = $data;
        $this->status = $status;
    }
}
