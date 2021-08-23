<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;
use App\Exceptions\InvalidPasswordException;
use App\Exceptions\InvalidUsernameException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService
{
    protected $userRepository;

    /**
     * Construct the service.
     *
     * @param \App\Repositories\Contracts\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Lets try to login to the system.
     *
     * @param string $username
     * @param string $password
     * @return \App\Models\User
     */
    public function attemptLogin($username, $password)
    {
        if ( $user = User::where('email', $username)->first() ) {
            if (Hash::check($password, $user->password)) {
                return $this->createToken($user, 'sign_in');
            }

            throw new InvalidPasswordException;
        }

        throw new InvalidUsernameException;
    }

    /**
     * Creates a new user.
     *
     * @param string $name
     * @param string $username
     * @param string $password
     * @param boolean $isAdmin
     * @return \App\Models\User
     */
    public function createUser($name, $username, $password, $isAdmin = false)
    {
        $user = $this->userRepository->create([
            'name' => $name,
            'email' => $username,
            'password' => bcrypt($password),
            'is_admin' => $isAdmin,
        ]);

        return $this->createToken($user, 'register');
    }

    /**
     * Creates and returns the token user.
     *
     * @param \App\Models\User $user
     * @param string $tokenName
     * @return \App\Models\User
     */
    public function createToken($user, $tokenName)
    {
        $token = $user->createToken($tokenName);

        $user->token = $token->plainTextToken;

        return $user;
    }
}
