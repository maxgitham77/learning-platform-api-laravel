<?php

namespace App\Actions\Auth;

use App\Data\Auth\LoginData;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class LoginAction
{

  public static function run(LoginData $data)
  {
        /** @var User $user */
        $user = User::where('email', $data->email)->first();

        if (!$user || !Hash::check($data->password, $user->password)) {
            return response([
                'error' => __('auth.failed'),
            ]);
            /*throw ValidationException::getMessages([
                'email' => __('auth.failed'),
            ]);*/
        }

        return $user->createToken('default')->plainTextToken;
  }

}
