<?php

namespace App\Domain\DTO\User;

use App\Models\User;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserDTO extends DataTransferObject
{
    public ?int $id;
    public ?string $email;
    public ?int $role;
    public ?Carbon $email_verified_at;
    public ?string $password;
    public ?Carbon $created_at;
    public ?Carbon $updated_at;


    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(Request $request): self
    {
        return new static([
            'id' => $request->get('id'),
            'email' => $request->get('email'),
            'email_verified_at' => Carbon::make($request->get('email_verified_at')),
            'password' => $request->get('password'),
            'created_at' => Carbon::make($request->get('created_at')),
            'updated_at' => Carbon::make($request->get('updated_at')),
        ]);
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromArray(array $array): self
    {
        return new static([
                'id' => $array['id'],
                'email' => $array['email'],
                'role' => $array['role'],
                'email_verified_at' => Carbon::make($array['email_verified_at']),
                'password' => $array['password'],
                'created_at' => Carbon::make($array['created_at']),
                'updated_at' => Carbon::make($array['updated_at']),
            ]
        );
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromModel(User $user): self
    {
        return new static([
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'email_verified_at' => Carbon::make($user->email_verified_at),
                'password' => $user->password,
                'created_at' => Carbon::make($user->created_at),
                'updated_at' => Carbon::make($user->updated_at),
            ]
        );
    }
}
