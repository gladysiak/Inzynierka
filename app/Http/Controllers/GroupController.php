<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index() {
        $user = auth()->user();
        $adminGroups = $user->adminGroups;

        return view('groups.index', [
            'groups' => Group::latest()->filter(request(['search']))->paginate(10),
            'adminGroups' => $adminGroups,
            'user' => $user
        ]);
    }

    public function adminMyGroups() {
        $user = auth()->user();
        $adminGroups = $user->adminGroups;

        return view('groups.admin-my-groups', [
            'groups' => Group::latest()->filter(request(['search']))->paginate(10),
            'adminGroups' => $adminGroups,
            'user' => $user
        ]);
    }

    public function myGroups() {
        $user = auth()->user();
        $adminGroups = $user->adminGroups;

        return view('groups.my-groups', [
            'groups' => Group::latest()->filter(request(['search']))->paginate(10),
            'adminGroups' => $adminGroups,
            'user' => $user
        ]);
    }

    public function create() {
        return view('groups.create');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'group_name' => 'required',
        ], [
            'group_name.required' => 'Nazwa grupy jest wymagana'
        ]);

        $group = Group::create($formFields);

        $user = auth()->user();
        $group->admin()->associate($user);
        $group->save();

        return redirect('/groups')->with('message', 'Grupa została utworzona!');
    }

    public function show (Group $group) {
        $users = $group->users()->with('games')->get();


        return view('groups.show', compact('group', 'users'));
    }

    public function destroy(Group $group) {
        $group->users()->detach();
        $group->delete();
        return redirect('/groups')->with('message', 'Usunięto grupę');
    }

    public function addUsers(Request $request, Group $group)
    {
        $userName = $request->input('user_name');

        $user = User::where('name', $userName)->first();

        if (!$user) {
            return back()->with('error', 'Użytkownik o podanej nazwie nie istnieje');
        }

        $group->users()->attach($user->id);

        return redirect('/groups')->with('message', 'Użytkownik został dodany do grupy');
    }

    public function removeUser(Group $group, User $user)
    {
        $group->users()->detach($user->id);

        return redirect('/groups')->with('message', 'Użytkownik został usunięty z grupy');
    }
}
