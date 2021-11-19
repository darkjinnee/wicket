<?php

namespace Darkjinnee\Wicket\Http\Middleware;

use Closure;
use Darkjinnee\Wicket\Wicket;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class WicketControl
 * @package Darkjinnee\Wicket\Http\Middleware
 */
class WicketControl
{
    /**
     * @var Repository|Application|mixed
     */
    protected $verityMode;

    /**
     * @var array
     */
    protected $agent;
    /**
     * @var Repository|Application|mixed
     */

    /**
     * @var Repository|Application|mixed
     */
    protected $abilityCheck;

    /**
     * WicketControl constructor.
     */
    public function __construct()
    {
        $this->abilityCheck = config('wicket.ability_check');
        $this->verityMode = config('wicket.verity_mode');
        $this->agent = Wicket::agent();
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) return $next($request);

        $user = auth()->user();
        $currentDevice = $user->currentDevice();

        if ($this->verityMode != 0) {
            $this->deviceVerity($currentDevice);
        }

        if ($user->isBanned()) {
            return response()->json([
                'message' => 'Account banned.',
                'errors' => [
                    'access' => 'Your account has been banned.'
                ]
            ], 403);
        }

        if ($this->abilityCheck) {
            $routeName = $request->route()->getName();
            $abilities = $user->currentAccessToken()->abilities;

            foreach ($abilities as $ability) {
                if (Str::is($ability, $routeName)) {
                    $currentDevice->agentUpdate();

                    return $next($request);
                }
            }
        } else return $next($request);

        return response()->json([
            'message' => 'Access denied.',
            'errors' => [
                'access' => 'User has insufficient ability.'
            ]
        ], 403);
    }

    /**
     * @param $currentDevice
     * @return JsonResponse|void
     */
    public function deviceVerity($currentDevice)
    {
        $verity = [
            'user_agent' => $currentDevice->user_agent === $this->agent['user_agent'],
            'ip' => $currentDevice->ip === $this->agent['ip'],
        ];

        switch ($this->verityMode) {
            case 1:
                if (!$verity['user_agent']) {
                    return response()->json([
                        'message' => 'Access denied.',
                        'errors' => [
                            'access' => 'Invalid user-agent.'
                        ]
                    ], 403);
                }
                break;
            case 2:
                if (!$verity['ip']) {
                    return response()->json([
                        'message' => 'Access denied.',
                        'errors' => [
                            'access' => 'Invalid ip address.'
                        ]
                    ], 403);
                }
                break;
            case 3:
                if (!$verity['user_agent'] || !$verity['ip']) {
                    return response()->json([
                        'message' => 'Access denied.',
                        'errors' => [
                            'access' => 'Invalid user-agent or ip address.'
                        ]
                    ], 403);
                }
                break;
            default:
                break;
        }
    }
}
