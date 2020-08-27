<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::applyFilters()
            ->applySorts()
            ->jsonPaginate();
        return UserResource::collection($users);
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }
}
