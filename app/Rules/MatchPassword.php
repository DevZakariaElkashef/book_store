<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MatchPassword implements Rule
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function passes($attribute, $value)
    {
        $user = User::where('email', $this->email)->first();

        if ($user && Hash::check($value, $user->password)) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'The password is incorrect for the provided email.';
    }
}
