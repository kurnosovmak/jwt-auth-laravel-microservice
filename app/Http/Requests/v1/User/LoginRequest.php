<?php

namespace App\Http\Requests\v1\User;

use App\Http\Requests\v1\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8',
        ];
    }
}
