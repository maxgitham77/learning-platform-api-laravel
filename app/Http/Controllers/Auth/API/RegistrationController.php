<?php

namespace App\Http\Controllers\Auth\API;

use App\Actions\Auth\RegisterUserAction;
use App\Data\Auth\RegisterUserData;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterUserData $data)
    {
        $user = RegisterUserAction::run($data);

        return UserResource::make($user);
    }
}
