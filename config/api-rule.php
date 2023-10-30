<?php

return [
    'API_RULES' => [
        "SUCCESS" => [
            'status_code' => 200,
            'message' => 'Success',
            'description' => '',
        ],
        "NOT_AUTHENTICATED" => [
            'status_code' => 403,
            'message' => 'Login information is not correct',
            'description' => 'ログイン情報が正しくありません'
        ],
        "NOT_FOUND" => [
            'status_code' => 404,
            'message' => 'Not Found',
            'description' => 'Not Found'
        ],
        "BAD_METHOD" => [
            'status_code' => 405,
            'message' => 'BadMethod',
            'description' => '不正なリクエストです。'
        ],
        "UNPROCESSABLE_ENTITY" => [
            'status_code' => 422,
            'message' => 'UnprocessableEntity',
            'description' => '不正なリクエストです。'
        ],
        "FATAL_ERROR" => [
            'status_code' => 500,
            'message' => 'FatalError',
            'description' => 'エラーが発生しました。業推へ問い合わせてください。'
        ],
        "BAD_REQUEST" => [
            'status_code' => 400,
            'message' => 'BadRequest',
            'description' => '不正なリクエストなので、サーバーで処理できません。改めてご確認してください。'
        ],
        "SERVICE_UNAVAILABLE" => [
            'status_code' => 503,
            'message' => 'ServiceUnavailable',
            'description' => 'API呼び出しに失敗しました。業推へ問い合わせてください。'
        ],
    ]
];