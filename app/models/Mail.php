<?php


namespace app\models;


class Mail extends \fw\core\base\Model
{
    public $attributes = [
        'email' => '',
        'subject' => '',
        'message' => '',
    ];

    public $rules = [
        'required' => [
            ['email'],
            ['subject'],
            ['message'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['message', 2],
        ],
    ];
}