<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view with user list.
     */
    public function create(): View
    {
        $users = User::all(); // Ambil semua user dari database
        return view('auth.register', compact('users'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' =>['required', 'in:Admin,Sale,Produksi,Gudang,Purchase']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        return redirect(route('register'));
    }
    public function delete(Request $request): RedirectResponse
    {
        $userIds = $request->input('user_ids', []);
        
        foreach ($userIds as $userId) {
            $user = User::findOrFail($userId);
            $user->delete();
        }

        return redirect()->back()->with('success', 'Users deleted successfully.');
    }
}
