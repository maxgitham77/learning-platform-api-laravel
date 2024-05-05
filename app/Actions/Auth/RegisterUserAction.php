<?php

    namespace App\Actions\Auth;

    use App\Data\Auth\RegisterUserData;
    use App\Models\User\User;
    use Illuminate\Auth\Events\Registered;
    use Illuminate\Support\Facades\Hash;

    class RegisterUserAction
    {
        public static function run(RegisterUserData $data)
        {
            $user = User::create([
                'firstname' => $data->firstname,
                'lastname'  => $data->lastname,
                'username'  => $data->username,
                'avatar'    => $data->avatar,
                'email'     => $data->email,
                'about'     => $data->about,
                'password'  => Hash::make($data->password)
            ]);
            event(new Registered($user));

            return $user;
        }
    }
