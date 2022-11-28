<?php

namespace App\Http\Requests\v1\User;

use App\Http\Requests\v1\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
}
