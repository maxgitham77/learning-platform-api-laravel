<?php

    namespace App\Data\Auth;

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Validation\Rules\Password;
    use Illuminate\Validation\Validator;
    use Spatie\LaravelData\Data;
    use Spatie\LaravelData\DataPipeline;
    use Spatie\LaravelData\Support\Creation\CreationContext;
    use Spatie\LaravelData\Support\Creation\CreationContextFactory;

    class RegisterUserData extends Data
    {
        public string $firstname;
        public string $lastname;
        public string $username;
        public string $email;
        public ?string $about;
        public string $password;
        public ?string $avatar;

        public static function rules() : array
        {
            return [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required', 'string', 'max:255'],
                'username'  => ['required', 'max:255', 'unique:users'],
                'avatar'    => ['nullable', 'image'],
                'email'     => ['required', 'email', 'unique:users'],
                'about'     => ['nullable', 'max:1000'],
                'password'  => ['required', 'confirmed', Password::defaults()]
            ];
        }

    }
