<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Nette\Schema\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function error(): Void
    {
        $request = $this->validate($this->rules());

        if (!Auth::attempt($request)) {
            throw new ValidationException("The login or Password is invalid");
        }
    }

}
