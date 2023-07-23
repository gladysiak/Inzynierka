<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function index() {
        return view('games.index', [
            'games' => Game::filter(request(['search']))->where('game_verified', true)->get()
        ]);
    }

    public function adminGames() {
        return view('games.admin-games', [
            'games' => Game::filter(request(['search']))->paginate(10)
        ]);
    }

    public function adminGamesUnverified() {
        return view('games.admin-games-unverified', [
            'games' => Game::filter(request(['search']))->where('game_verified', false)->paginate(10)
        ]);
    }

    public function verifyGame(Game $game) {
        $game->update(['game_verified' => true]);

        return redirect('/admin-games-unverified')->with('message', 'Gra została zweryfikowana.');
    }

    public function create() {
        return view('games.create');
    }

    public function store(Request $request) {
        $messages = [
            'game_name.required' => 'Proszę podać nazwę gry.',
            'game_desc.required' => 'Proszę podać opis gry.',
            'game_players_num.required' => 'Proszę podać liczbę graczy.',
            'game_players_age.required' => 'Proszę podać wiek graczy.',
            'game_producer.required' => 'Proszę podać producenta gry.',
            'game_image.required' => 'Proszę wybrać obraz gry.',
            'game_image.image' => 'Wybrany plik musi być obrazem.',
            'game_image.mimes' => 'Wybrany plik musi mieć format: jpeg, png, jpg, gif.',
            'game_image.max' => 'Wybrany plik nie może być większy niż 2MB.',
        ];

        $formFields = $request->validate([
            'game_name' => 'required',
            'game_desc' => 'required',
            'game_players_num' => 'required',
            'game_players_age' => 'required',
            'game_producer' => 'required',
            'game_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $formFields['game_image'] = $imageName;
        }
        $formFields['game_verified'] = true;

        Game::create($formFields);

        return redirect('/admin-games')->with('message', 'Gra została utworzona!');
    }

    public function addByUser() {
        return view('games.add-by-user');
    }

    public function storeUserGame(Request $request) {
        $messages = [
            'game_name.required' => 'Proszę podać nazwę gry.',
            'game_desc.required' => 'Proszę podać opis gry.',
            'game_players_num.required' => 'Proszę podać liczbę graczy.',
            'game_players_age.required' => 'Proszę podać wiek graczy.',
            'game_producer.required' => 'Proszę podać producenta gry.',
            'game_image.required' => 'Proszę wybrać obraz gry.',
            'game_image.image' => 'Wybrany plik musi być obrazem.',
            'game_image.mimes' => 'Wybrany plik musi mieć format: jpeg, png, jpg, gif.',
            'game_image.max' => 'Wybrany plik nie może być większy niż 2MB.',
        ];

        $formFields = $request->validate([
            'game_name' => 'required',
            'game_desc' => 'required',
            'game_players_num' => 'required',
            'game_players_age' => 'required',
            'game_producer' => 'required',
            'game_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $formFields['game_image'] = $imageName;
        }

        Game::create($formFields);

        return redirect('/games')->with('message', 'Twoje zgłoszenie zostało przyjęte!');
    }

    public function show (Game $game) {
        return view('games.show', [
           'game' => $game
        ]);
    }

    public function edit (Game $game) {
        return view('games.edit', [
            'game' => $game
        ]);
    }

    public function update(Request $request, Game $game) {
        $messages = [
            'game_name.required' => 'Proszę podać nazwę gry.',
            'game_desc.required' => 'Proszę podać opis gry.',
            'game_players_num.required' => 'Proszę podać liczbę graczy.',
            'game_players_age.required' => 'Proszę podać wiek graczy.',
            'game_producer.required' => 'Proszę podać producenta gry.',
            'game_image.image' => 'Wybrany plik musi być obrazem.',
            'game_image.mimes' => 'Wybrany plik musi mieć format: jpeg, png, jpg, gif.',
            'game_image.max' => 'Wybrany plik nie może być większy niż 2MB.',
        ];

        $formFields = $request->validate([
            'game_name' => 'required',
            'game_desc' => 'required',
            'game_players_num' => 'required',
            'game_players_age' => 'required',
            'game_producer' => 'required',
            'game_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], $messages);

        if ($request->hasFile('game_image')) {
            $image = $request->file('game_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);

            $formFields['game_image'] = $imageName;
        }

        $game->update($formFields);

        return back()->with('message', 'Dane gry zostały zaktualizowane');
    }

    public function destroy(Game $game) {
        $game->delete();
        return redirect('/games')->with('message', 'Gra została usunięta');
    }

    public function userGames() {
        $games = Game::all();
        $user = auth()->user();

        return view('games.user-games', compact('games', 'user'));
    }

    public function updateUserGames(Game $game)
    {
        $user = auth()->user();
        $user->games()->attach($game->id);

        return back()->with('message', 'Dodano do kolekcji');
    }

    public function removeUserGames(Game $game)
    {
        $user = auth()->user();
        $user->games()->detach($game->id);

        return redirect('games/user-games')->with('message', 'Usunięto z kolekcji');
    }
}
