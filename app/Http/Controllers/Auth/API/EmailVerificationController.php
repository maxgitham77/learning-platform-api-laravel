<?php

namespace App\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['errors' => [
                'status' => 'Email already verified'
            ]]);
        }
        $request->user()->sendEmailVerificationNotification();
        return response(null, Response::HTTP_OK);
    }

    public function verify(Request $request)
    {
        if (!URL::hasValidRelativeSignature($request)) {
            return \response()->json([
                'status' => 'Invalid verification link or signature. Link may be expired'
            ]);
        }

        if ($request->user()->hasVerifiedEmail()) {
            return \response()->json([
                'status' => 'Email already verified'
            ]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return \response()->json(null. Response::HTTP_OK);
    }

}
