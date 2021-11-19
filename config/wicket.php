<?php

use App\Models\User;
use Darkjinnee\Wicket\Http\Requests\Register;
use Darkjinnee\Wicket\Http\Requests\Token;

return [

    /** Usernames developers */
    'developers' => ['test@gmail.com'],

    /** Auth fields for check */
    'auth_fields' => [
        'username' => 'email',
        'password' => 'password',
    ],

    /** Default masks */
    'masks' => ['api.auth.*'],

    /** Check abilities at the middleware */
    'ability_check' => true,

    /** Device verification mode from 0 to 3 */
    'verity_mode' => 0,

    /** Classes */
    'classes' => [
        'user_model' => User::class,
        'register_request' => Register::class,
        'token_request' => Token::class,
    ]
];
