<?php

return [
    'API_RULE' => [
        "SUCCESS" => [
            'status_code' => 200,
            'message' => 'Success',
            'description' => '',
        ],
        "NOTFOUND" => [
            'code' => 404,
            'message' => 'Not Found',
            'description' => 'Not Found'
        ],
        "BADMETHOD" => [
            'code' => 405,
            'message' => 'BadMethod',
            'description' => '不正なリクエストです。'
        ],
        "FATALERROR" => [
            'code' => 500,
            'message' => 'FatalError',
            'description' => 'エラーが発生しました。業推へ問い合わせてください。'
        ],
        "BADREQUEST" => [
            'code' => 400,
            'message' => 'BadRequest',
            'description' => '不正なリクエストなので、サーバーで処理できません。改めてご確認してください。'
        ],
        "SERVICEUNAVAILABLE" => [
            'code' => 503,
            'message' => 'ServiceUnavailable',
            'description' => 'API呼び出しに失敗しました。業推へ問い合わせてください。'
        ],
    ]
];