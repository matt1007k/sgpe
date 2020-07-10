<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreatedRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $status = request('f') ? request('f') : 'verified';
        $search = request('search') ? request('search') : '';

        $users = User::filterStatus($status)
            ->search($search)
            ->latest()
            ->paginate(10);

        return view('client.admin.users.index', compact('users', 'status', 'search'));
    }

    public function create()
    {
        $user = new User([
            'status' => 'unverified',
        ]);

        return view('client.admin.users.create', compact('user'));
    }

    public function store(UserCreatedRequest $request)
    {
        $password = $request->password ? Hash::make($request->password) : null;

        User::create(
            array_merge(
                $request->validated(),
                ['password' => $password]
            )
        );

        return redirect()->route('users.index')->with('message', 'Usuario registrado con exitó.');
    }

    public function edit(User $user)
    {
        return view('client.admin.users.edit', compact('user'));
    }

    public function update(UserCreatedRequest $request, User $user)
    {
        $password = $request->password ? Hash::make($request->password) : null;

        $user->update(
            array_merge(
                $request->validated(),
                ['password' =>  $password]
            )
        );
        // return $user;
        return redirect()->route('users.index')->with('message', 'Usuario editado con exitó.');
    }

    public function markVerified(String $dni)
    {
        $user = User::where('dni', $dni)->firstOrFail();

        Gate::authorize('update', $user); // Or $this->authorize()

        $user->update([
            'status' => 'verified'
        ]);

        return redirect()->route('users.index')
            ->with('message', 'Usuario ha sido verificado con exitó.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('message', 'Usuario eliminado con exitó.');
    }
}
