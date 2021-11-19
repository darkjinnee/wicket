<?php

namespace Darkjinnee\Wicket\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class TokenController
 * @package Darkjinnee\Wicket\Http\Controllers
 */
class TokenController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $request = app($this->classes['token_request']);
        $input = $request->all();

        $userModel = $this->classes['user_model'];
        $user = $userModel::where($this->fields['username'], $input[$this->fields['username']])
            ->first();

        if (!$user || !Hash::check($input[$this->fields['password']], $user[$this->fields['password']])) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'The provided credentials are incorrect.'
                ],
            ], 422);
        }

        $tokenName = $request->has('token_name')
            ? $input['token_name']
            : $this->agent['user_agent'];

        $token = $user->createToken($tokenName, $user->abilityMasks());
        $user->createDevice($token->accessToken->id, $this->agent);

        return response()->json([
            'message' => 'Token created successfully.',
            'data' => [
                'token' => $token->plainTextToken
            ]
        ], 200);
    }
}
