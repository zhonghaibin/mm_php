<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'phone' => 'required|digits:11',
            'password' => 'required',
        ]);
        $user = User::where(['phone' => $request->phone])->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'phone' => ['账号或密码错误'],
            ]);
        }
        $token = $user->createToken('app-token');

        return $this->success([
            'token' => $token->plainTextToken,
            'token_id' => $token->accessToken->id,
        ]);

    }

    public function logout(Request $request)
    {
        $request->validate([
            'token_id' => 'required',
        ]);
        if (! $request->user()->tokens()->where('id', $request->only('token_id'))->delete()) {
            return $this->failed('操作失败');
        }

        return $this->message('退出成功');
    }
}
