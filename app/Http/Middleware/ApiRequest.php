<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;

class ApiRequest
{
    public $versions = [
        '1' => [
            'upgrade' => false,
            'username' => 'API-USER',
            'password' => 'API-PWD',
        ],
    ];

    public function handle($request, Closure $next, $versionNo, $loginUser, $shouldAuth)
    {
        $params = $request->route()->parameters();
        // dd($versionNo);
        if (isset($this->versions[$versionNo])) {
            $version = $this->versions[$versionNo];
            if ($version['upgrade']) {
                return abort(426, 'Upgrade Required');
            } else {
                $server = $request->server;

                $username = $server->get('HTTP_API_AUTH_USERNAME');
                $password = $server->get('HTTP_API_AUTH_PASSWORD');

                // if (!($version['username'] == $username && $version['password'] == $password)) {
                //     return abort(401, 'Unauthorized access');
                // } elseif ($loginUser) {
                    $auth = Auth::guard($loginUser);
                    $authUserType = $server->get('HTTP_USER_AUTH_TYPE');
                    $authUserToken = $server->get('HTTP_USER_AUTH_TOKEN');

                    $request->merge(['token' => $authUserToken]);

                    if ('api_' . $authUserType != $loginUser) {
                        $errorToken = 'Auth Type Missing';
                    } elseif ($auth->parser()->setRequest($request)->hasToken()) {
                        try {
                            $auth->parseToken();
                            $user = $auth->user();
                            if (!($user && isset($user->id))) {
                                throw new \Tymon\JWTAuth\Exceptions\UserNotDefinedException;
                            }
                        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                            $errorToken = 'Token Expired';
                        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                            $errorToken = 'Token Invalid';
                        } catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e) {
                            $errorToken = 'Token Blacklisted';
                        } catch (\Tymon\JWTAuth\Exceptions\PayloadException $e) {
                            $errorToken = 'Token Payload Error';
                        } catch (\Tymon\JWTAuth\Exceptions\InvalidClaimException $e) {
                            $errorToken = 'Token Invalid Claim';
                        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
                            $errorToken = 'Token Invalid User';
                        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                            $errorToken = $e->getMessage();
                        } catch (\Exception $e) {
                            $errorToken = $e->getMessage();
                        }
                    // } else {
                    //     $errorToken = 'Token Missing';
                    // }

                    // if ($shouldAuth && isset($errorToken)) {
                    //     return abort(401, $errorToken);
                    // }
                }
            }
        } else {
            return abort(410, 'Gone');
        }

        return $next($request);
    }
}
