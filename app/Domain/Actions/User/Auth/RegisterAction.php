<?php

namespace App\Domain\Actions\User\Auth;

use App\Domain\Actions\BaseAction;
use App\Domain\DTO\User\TokenDTO;
use App\Domain\DTO\User\UserDTO;
use App\Domain\Services\AuthService;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueueableAction\QueueableAction;

class RegisterAction extends BaseAction
{
    use QueueableAction;

    public function __construct(
        protected AuthService $authService
    )
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function execute(UserDTO $userDTO): ?TokenDTO
    {
        $userDTO->role = User::ROLE_USER;
        $newUserDTO = $this->authService->register($userDTO);
        return $this->authService->login($userDTO);
    }
}
