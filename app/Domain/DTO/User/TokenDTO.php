<?php

namespace App\Domain\DTO\User;


use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TokenDTO extends DataTransferObject
{
    public ?string $access_token;
    public ?string $token_type;
    public ?int $expires_in;

    /**
     * @throws UnknownProperties
     */
    public static function fromArray(array $array): self
    {
        return new static([
                'access_token' => $array['access_token'],
                'token_type' => $array['token_type'],
                'expires_in' => $array['expires_in'],
            ]
        );
    }
}
