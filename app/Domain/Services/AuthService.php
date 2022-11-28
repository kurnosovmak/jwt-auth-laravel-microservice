<?php

namespace App\Domain\Services;

use App\Domain\DTO\User\TokenDTO;
use App\Domain\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthService extends BaseService
{

    /**
     * @throws UnknownProperties
     */
    public function login(UserDTO $userDTO): ?TokenDTO
    {
        if (!$token = auth()->attempt($userDTO->only('email', 'password')->toArray())) {
            return null;
        }
        return TokenDTO::fromArray([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * @throws UnknownProperties
     */
    public function register(UserDTO $userDTO): UserDTO
    {
        $data = $userDTO->only('name', 'email', 'password', 'role')->toArray();
        $data['password'] = Hash::make($data['password'] ?? '');
        $user = User::create($data);
        return UserDTO::fromModel($user);
    }


    public function logout()
    {
        auth()->logout();
    }


    /**
     * @throws UnknownProperties
     */
    public function refresh(): TokenDTO
    {
        $token = auth()->refresh();
        return TokenDTO::fromArray([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
