<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::query()->orderBy('surname')->orderBy('name')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create', [
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'exists:'.Role::class.',id'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // assign the user the role of user
        $role = Role::query()->where('id', $request->role_id)->first();

        // assign the user the role of user
        $user->assignRole($role);
        $user->role_id = $role->id;
        $user->role_name = $role->name;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit', [
            'user' => User::query()->findOrFail($id),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$id],
            'role_id' => ['required', 'exists:'.Role::class.',id'],
        ]);

        $user = User::query()->findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        // assign the user the role of user
        $role = Role::query()->where('id', $request->role_id)->first();

        // remove all roles from the user
        $user->roles()->detach();

        $user->assignRole($role);
        $user->role_id = $role->id;
        $user->role_name = $role->name;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request){
        $request->validate([
            'search' => ['required', 'string', 'max:255'],
        ]);

        return view('users.result', [
            'users' => User::query()
                ->where('surname', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')
                ->orderBy('surname')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function password_update(Request $request, string $id)
    {
        try {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        } catch (ValidationException $e) {
            // Logga gli errori di validazione nel file di log
            Log::error('Errore di validazione della password per l\'utente con ID ' . $id, [
                'errors' => $e->errors(),
            ]);

            // Puoi decidere di ridirigere indietro con gli errori
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $user = User::query()->findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();


        return redirect()->route('users.index');
    }

    public function two_factor_disabled($id)
    {
        $user = User::query()->findOrFail($id);

        $user->google2fa_enabled = false;
        $user->google2fa_secret = null;
        $user->save();

        return redirect()->back()->with([
            'status' => __('profilo.2fa.disabled_message'),
            'alert-type' => 'success',
        ]);

    }
}
