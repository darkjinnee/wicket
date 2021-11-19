<?php

namespace Darkjinnee\Wicket\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterController
 * @package Darkjinnee\Wicket\Http\Controllers
 */
class RegisterController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $request = app($this->classes['register_request']);
        $input = $request->all();

        $input[$this->fields['password']] = Hash::make($input[$this->fields['password']]);
        $userModel = $this->classes['user_model'];
        $user = $userModel::create($input);

        $tokenName = $request->has('token_name')
            ? $input['token_name']
            : $this->agent['user_agent'];

        $token = $user->createToken($tokenName, $user->abilityMasks());
        $user->createDevice($token->accessToken->id, $this->agent);

        return response()->json([
            'message' => 'User registered successfully.',
            'data' => [
                'token' => $token->plainTextToken
            ]
        ], 200);
    }
}
