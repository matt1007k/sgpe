<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreatedRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        [$years, $payments] = (new UserService)->getMyPayments();
        $years_count = count($years['data']);
        $payments_count = count($payments['data']);
        return view('client.profile.index', compact('years_count', 'payments_count'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('client.profile.edit', compact('user'));
    }

    public function update(UserCreatedRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('profile')
            ->with('message', 'Datos actualizados con exitó.');
    }
}
