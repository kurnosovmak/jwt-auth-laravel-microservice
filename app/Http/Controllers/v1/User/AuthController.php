<?php

namespace App\Http\Controllers\v1\User;

use App\Domain\Actions\User\Auth\LoginAction;
use App\Domain\Actions\User\Auth\LogoutAction;
use App\Domain\Actions\User\Auth\RefreshAction;
use App\Domain\Actions\User\Auth\RegisterAction;
use App\Domain\DTO\User\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\LoginRequest;
use App\Http\Requests\v1\User\RegisterRequest;
use App\Http\Resources\v1\ErrorResource;
use App\Http\Resources\v1\User\RegisterResource;
use App\Http\Resources\v1\User\TokenResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResource
    {
        $token = $action->execute(UserDTO::fromRequest($request));
        if (!$token) {
            return ErrorResource::make('Error login', 500);
        }
        return TokenResource::make($token);
    }

    /**
     * @throws UnknownProperties
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResource
    {
        $token = $action->execute(UserDTO::fromRequest($request));
        if (!$token) {
            return ErrorResource::make('Error login', 500);
        }
        return TokenResource::make($token);
    }

    /**
     * @throws UnknownProperties
     */
    public function refresh(RefreshAction $action): TokenResource
    {
        $token = $action->execute();
        return TokenResource::make($token);
    }

    public function logout(LogoutAction $action): JsonResponse
    {
        $action->execute();
        return response()->json([], 204);
    }
}
