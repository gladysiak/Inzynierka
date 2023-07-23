<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;
use App\Models\Game;
use App\Models\Event;
use App\Events\UserDeleted;

class UserController extends Controller
{
    public function index() {
        return view('users.index', [
            'users' => User::latest()->filter(request(['search']))->paginate(10),
            'roles' => Role::all()
        ]);
    }

    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {
        $messages = [
            'name.required' => 'Login jest wymagany.',
            'name.min' => 'Login musi mieć co najmniej :min znaków.',
            'name.unique' => 'Użytkownik o podanym loginie już istnieje.',
            'email.required' => 'Email jest wymagany.',
            'email.email' => 'Podany adres email jest nieprawidłowy.',
            'email.unique' => 'Podany adres email już istnieje.',
            'password.required' => 'Pole hasło jest wymagane.',
            'password.confirmed' => 'Podane hasła nie są takie same.',
            'password.min' => 'Hasło musi zawierać co najmniej :min znaków.',
        ];

        $formFields = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ], $messages);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        $role = Role::where('name', 'Uzytkownik')->first();
        $user->roles()->attach($role);

        auth()->login($user);

        return redirect('/')->with('message', 'Udało Ci się utworzyć konto. Jesteś już zalogowany :)');
    }

    public function createByAdmin() {
        return view('users.create-by-admin', [
            'roles' => Role::all()
        ]);
    }

    public function storeCreateByAdmin(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        $role = Role::findOrFail($formFields['role_id']);
        $user->roles()->attach($role);

        return redirect('/users')->with('message', 'Nowy użytkownik został dodany');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Zostałeś wylogowany');
    }

    public function login() {
        return view('users.login');
    }

    public function authenticate(Request $request) {
        $messages = [
            'email.required' => 'Email jest wymagany.',
            'email.email' => 'Podany adres email jest nieprawidłowy.',
            'password.required' => 'Pole hasło jest wymagane.',
        ];

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ], $messages);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            $user = auth()->user();

            // Sprawdź, czy istnieje last_event_id dla użytkownika
            if ($user->last_event_id) {
                $lastEvent = Event::find($user->last_event_id);

                if ($lastEvent) {
                    $groupName = $lastEvent->group->group_name;
                    $message = "Nowe wydarzenie w grupie: $groupName";

                    // Wyświetl powiadomienie na stronie
                    session()->flash('notification', $message);
                }
            }

            return redirect('/')->with('message', 'Zalogowano pomyślnie');
        }

        return back()->withErrors(['email' => 'Nieprawidłowe dane'])->onlyInput('email');
    }

    public function destroy(User $user) {
        $user->delete();

        event(new UserDeleted($user));

        return redirect('/');
    }

    public function editRole(User $user) {
        $roles = Role::all();

        return view('users.edit-role', compact('user', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $role = Role::findOrFail($request->input('role'));
        $user->roles()->sync([$role->id]);

        return redirect('/users')->with('message', 'Rola użytkownika została zmieniona');
    }

    public function edit() {
        $user = auth()->user();

        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function changePassword(User $user) {
        return view('users.change-password', [
            'user' => $user
        ]);
    }

    public function editGames() {
        $games = Game::all();
        $user = auth()->user();

        return view('users.edit-games', compact('games', 'user'));
    }

    /*public function updateGames(Request $request, User $user)
    {
        dd($request->input('games'));
        $user->games()->sync($request->input('games'));

        return redirect('/users/'.$user->id.'/edit')->with('message', 'Zalogowano pomyślnie');
    }*/

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Podane hasła nie są identyczne.',
            'new_password.min' => 'Podane musi mieć co najmniej :min znaków.',
            'new_password.required' => 'Pole jest wymagane.',
            'current_password.required' => 'Pole jest wymagane.',
        ]);

        $user = auth()->user();

        if (!password_verify($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Podano nieprawidłowe aktualne hasło.']);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect('/users/'.$user->id.'/edit')->with('message', 'Hasło zostało zmienione.');
    }
}
