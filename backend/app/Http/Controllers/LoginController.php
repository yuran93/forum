<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidUsernameException;
use Illuminate\Support\Facades\Log;
use App\Services\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Lets try to login to the system.
     *
     * @param \App\Services\UserService $userService
     * @param \App\Services\ApiResponse $response
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserService $userService, ApiResponse $response, Request $request)
    {
        # Initial validation on the request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {

            return $userService->attemptLogin(
                $request->get('username'),
                $request->get('password')
            );

        }
        catch (InvalidPasswordException $e) {
            return $response->failed('Invalid password', 401);
        }
        catch (InvalidUsernameException $e) {
            return $response->failed('Invalid username', 401);
        }
        catch (\Exception $e) {

            Log::error('LoginController: issue with login: ' . $e->getMessage());

            return $response->failed('Oops something went wrong!', 500);

        }
    }
}
