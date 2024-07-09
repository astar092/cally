<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token =  $user->createToken($request->email)->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Logged in succesfully',
                'data' => [
                    'token' => $token,
                ]
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorised',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function registerExpoToken(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $expoToken = $request->input('expo_token');
        
        ExpoToken::where('user_id', $userId)->delete();

        $expoToken = ExpoToken::create(
            [
                'user_id' => $userId,
                'expo_token' => $expoToken
            ],
        );

        if ($expoToken) {
            return $this->sendResponse(
                [
                    'expoToken' => $expoToken,
                ], 
                'Expo token saved.'
            );
        } 
        
        return $this->sendError(
            'Can not save token.', 
            [
                'expoToken' => $expoToken,
            ]
        );
    }

    public function logout(Request $request): Response|Application|ResponseFactory
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out succesfully',
        ]);
    }

    // public function resetPassword(ResetPasswordApiRequest $request) {
    //     $inputs = $request->validated();

    //     $status = Password::sendResetLink($inputs['params']);

    //     $jrpcService = new JrpcService();
    //     if ($status == Password::RESET_LINK_SENT) {
    //         return $jrpcService->successResponse($request->id, []);
    //     }

    //     if ($status == Password::RESET_THROTTLED) {
    //         return $jrpcService->errorResponse(
    //             $request->id,
    //             JrpcService::EMAIL_THROTTLED_EXCEPTION_MESSAGE_KEY,
    //             $status,
    //             JrpcService::SERVER_ERROR
    //         );
    //     }

    //     return $jrpcService->errorResponse(
    //         $request->id,
    //         JrpcService::GENERAL_EXCEPTION_MESSAGE_KEY,
    //         $status,
    //         JrpcService::SERVER_ERROR
    //     );
    // }
}