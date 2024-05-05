<?php

    namespace App\Http\Controllers\Auth\API;

    use App\Actions\Auth\LoginAction;
    use App\Data\Auth\LoginData;
    use App\Http\Controllers\Controller;
    use App\Models\User\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cookie;
    use Symfony\Component\HttpFoundation\Response;

    class LoginController extends Controller
    {
        public function store(LoginData $data)
        {
            $token = LoginAction::run($data);

            $cookie = cookie(config('site.cookie_name'), $token, 60 * 24);

            return response([
                'jwt' => $token
            ])->withCookie($cookie);
        }


        public function destroy(Request $request)
        {

            $request->user()->currentAccessToken()->delete();

            return response(null, Response::HTTP_NO_CONTENT)
                ->withoutCookie(config('site.cookie_name'));

            /*$cookie = Cookie::forget('jwt');

            return response([
                'message' => 'success'
            ])->withCookie($cookie);*/
        }

    }
