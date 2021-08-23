<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserRequest;
use App\Services\ApiResponse;
use App\Services\UserService;

class RegisterController extends Controller
{
    /**
     * Lets try to login to the system.
     *
     * @param \App\Services\UserService $userService
     * @param \App\Services\ApiResponse $response
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserService $userService, ApiResponse $response, UserRequest $request)
    {
        try {

            return $userService->createUser(
                $request->get('name'),
                $request->get('username'),
                $request->get('password')
            );

        }
        catch (\Exception $e) {

            Log::error('RegisterController: Unable to create a record | ' . $e->getMessage());

            return $response->failed('Oops something went wrong!', 500);

        }
    }
}
