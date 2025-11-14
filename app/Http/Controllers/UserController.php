<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return response()->json(User::with('events')->get());
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($data['role'] === 'manager' && isset($data['event_ids'])) {
            $user->events()->sync($data['event_ids']);
        }

        return response()->json($user->load('events'), 201);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return response()->json($user->load('events'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if ($user->role === 'manager' && isset($data['event_ids'])) {
            $user->events()->sync($data['event_ids']);
        }

        return response()->json($user->load('events'));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json(['message' => 'Usuário removido']);
    }
}
