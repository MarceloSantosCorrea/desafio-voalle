<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use TraitCrud;

    private $model = User::class;
    private $route = 'users';
    private $resource = 'User';
    private $data = [];

    public function store(UserCreateRequest $request): RedirectResponse
    {
        $data = $request->all();

        event(new Registered($this->model::create([
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'] ?? null,
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'is_active' => isset($data['is_active']),
        ])));

        return redirect()->route('users.index')->with('success', __(':attribute created successfully', [
            'attribute' => __('User'),
        ]));
    }

    public function edit(User $user)
    {
        return view('pages.users.update', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->all();

        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', __(':attribute updated successfully', [
            'attribute' => __('User'),
        ]));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', __(':attribute deleted successfully', [
            'attribute' => __('User'),
        ]));
    }
}
