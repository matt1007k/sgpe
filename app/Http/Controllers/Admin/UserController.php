<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreatedRequest;
use App\Models\User;
use App\Services\MonthService;
use App\Services\UserService;
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
        // $status = request('f') ? request('f') : 'verified';
        // $sort = request('sort') ? request('sort') : 'desc';
        // $search = request('search') ? request('search') : '';

        // $users = User::filterStatus($status)
        //     ->search($search)
        //     ->orderBy('created_at', $sort)
        //     ->paginate(10);

        return view('admin.users.index',
            // compact(
            //     'users',
            //     'status',
            //     'search',
            //     'sort'
            // )
        );
    }

    public function create()
    {
        $user = new User([
            'status' => 'unverified',
        ]);

        return view('admin.users.create', compact('user'));
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
        return view('admin.users.edit', compact('user'));
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

        request()->session()->flash('message', 'Usuario ha sido verificado con exitó.');
        return response()->json(['success' => true]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        request()->session()->flash('message', 'Usuario eliminado con exitó.');
        return response()->json(['success' => true]);
    }

    public function usersStatus()
    {
        $titles = array(["Úlmos Meses", "Verificado", "Sin verificar"]);
        $items = (new UserService())->getUsersCountByLastMounts();
        $data = array_merge($titles, $items);

        return  response()->json($data);
    }
}
