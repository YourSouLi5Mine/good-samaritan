<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Windwalker\Crypt\Password;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    protected function jwt(User $user) {
        $payload = [
            'sub' => $user->id,
            'created_at' => time(),
            'expires_at' => time() + 345600 //Change to 3600 before deploy
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function authenticate(User $user) {
        $this->validate($this->request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        $user = User::where('email', $this->request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }

        $password = new Password(Password::MD5, md5(env('APP_KEY')));
        $input_password = $this->request->input('password');

        if ($password->verify($input_password, $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}
