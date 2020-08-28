<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('client.change-password.edit', compact('user'));
    }

    public function update(ChangePasswordRequest $request, User $user)
    {
        $newPasswordHashed = Hash::make($request->password);
        $user->update([
            'password' => $newPasswordHashed
        ]);

        return redirect()->route('profile')
            ->with('message', 'Contraseña actualizada con exitó.');
    }
}
