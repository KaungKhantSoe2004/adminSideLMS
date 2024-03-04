<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Models\verifyToken;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();



        // $validToken = rand(10,100..'2024');
        // $get_token = new verifyToken();
        // $get_token->token = $validToken;
        // $get_token->email = $input['email'];
        // $get_token->save();
        // $get_user_email = $input['email'];
        // $get_user_name = $input['name'];
        // Mail::to($input['email'])->send(new WelcomeMail($get_user_email,$validToken,$get_user_name));
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role'=> 'schoolAdmin',
            'password' => Hash::make($input['password']),
        ]);
    }
}
