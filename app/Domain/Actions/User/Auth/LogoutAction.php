<?php

namespace App\Domain\Actions\User\Auth;

use App\Domain\Actions\BaseAction;
use App\Domain\DTO\User\TokenDTO;
use App\Domain\DTO\User\UserDTO;
use App\Domain\Services\AuthService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueueableAction\QueueableAction;

class LogoutAction extends BaseAction
{
    use QueueableAction;

    public function __construct(
        protected AuthService $authService
    )
    {
    }

    public function execute()
    {
        $this->authService->logout();
    }
}
