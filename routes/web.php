<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FullcalendarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Strona główna aplikacji
Route::get('/', function () {
    return view('welcome');
})->name('homePage');

// Strona główna z grami
Route::get('/games', [GameController::class, 'index'])->name('games.index')->middleware('auth');
// Tabelka z grami dla adminów
Route::get('/admin-games', [GameController::class, 'adminGames'])->name('admin-games.admin-games')->middleware('role:Admin,Moderator');
// Tabelka z niezatwierdzonymi grami dla adminów
Route::get('/admin-games-unverified', [GameController::class, 'adminGamesUnverified'])->name('admin-games.admin-games-unverified')->middleware('role:Admin,Moderator');
// Tabelka z niezatwierdzonymi grami dla adminów
Route::put('/admin-games-unverified/{game}', [GameController::class, 'verifyGame'])->name('games.verify-game')->middleware('role:Admin,Moderator');
// Formularz do dodawania gry
Route::get('/games/create', [GameController::class, 'create'])->name('games.create')->middleware('role:Admin,Moderator');
// Zapisanie gry do bazy
Route::post('/games/create', [GameController::class, 'store'])->name('games.store')->middleware('role:Admin,Moderator');
// Formularz do dodawania gry przez użytkownika
Route::get('/games/add', [GameController::class, 'addByUser'])->name('games.add-by-user')->middleware('role:Użytkownik');
// Zapisanie do bazy gry od użytkownika
Route::post('/games/add', [GameController::class, 'storeUserGame'])->name('games.store-user-game')->middleware('role:Użytkownik');
// Formularz do edycji gry
Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit')->middleware('role:Admin,Moderator');
// Zapisanie do bazy edytowanej gry
Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update')->middleware('role:Admin,Moderator');
// Usunięcie gry z bazy
Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy')->middleware('role:Admin,Moderator');
// Wyświetlenie strony z grami użytkownika
Route::get('/games/user-games', [GameController::class, 'userGames'])->name('games.user-games')->middleware('auth');
// Pokazanie wszystkich informacji o wybranej grze
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show')->middleware('auth');
// Usunięcie relacji pomiędzy grą a użytkownikiem
Route::delete('/games/{game}', [GameController::class, 'removeUserGames'])->name('users.remove-user-games')->middleware('auth');
// Dodanie gry użytkownikowi
Route::put('/games/{game}', [GameController::class, 'updateUserGames'])->name('users.update-user-games')->middleware('auth');
// Strona z listą użytkowników
Route::get('/users', [UserController::class, 'index'])->name('users.admin.index')->middleware('role:Admin');
// Usunięcie użytkownika
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('role:Admin');
// Formularz z opcjami wyboru roli dla użytkownika
Route::get('/users/{user}/edit-role', [UserController::class, 'editRole'])->name('users.admin.edit-role')->middleware('role:Admin');
// Zapisanie nowej roli do bazy
Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.update-role')->middleware('role:Admin');
// Wyświetlenie strony z możliwością edycji profilu
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
// Wyświetlenie formularza do zmiany hasła
Route::get('/users/{user}/edit/change-password', [UserController::class, 'changePassword'])->name('users.change-password')->middleware('auth');
// Zapisanie nowego hasła
Route::put('/users/{user}/edit-password', [UserController::class, 'updatePassword'])->name('users.update-password')->middleware('auth');
    /*// Formularz z listą do wyboru gier, które posiada użytkownik
    Route::get('/users/{user}/update-games', [UserController::class, 'editGames'])->name('users.edit-games')->middleware('auth');*/
// Formularz do utworzenia użytkownika przez admina
Route::get('/users/create-by-admin', [UserController::class, 'createByAdmin'])->name('users.admin.create-by-admin')->middleware('role:Admin');
// Zapisanie użytkownika, którego utworzył admin
Route::post('/users/create-by-admin/store', [UserController::class, 'storeCreateByAdmin'])->name('users.store-by-admin')->middleware('role:Admin');
// Formularz rejestracji
Route::get('/register', [UserController::class, 'create'])->name('register');
// Zapisanie użytkownika do bazy
Route::post('/register', [UserController::class, 'store']);
// Wylogowanie użytkownika
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
// Formularz logowania
Route::get('/login', [UserController::class, 'login'])->name('login');
// Zalogowanie użytkownika
Route::post('/login', [UserController::class, 'authenticate']);
// Główna strona z listami grup
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index')->middleware('auth');
// Strona z listą grup, które utworzyłe
Route::get('/groups/admin-my-groups', [GroupController::class, 'adminMyGroups'])->name('groups.admin-my-groups')->middleware('auth');
// Strona z listą grup, w których jestem dodany
Route::get('/groups/my-groups', [GroupController::class, 'myGroups'])->name('groups.my-groups')->middleware('auth');
// Formularz tworzenia nowej grupy
Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create')->middleware('auth');
// Zapisanie nowej grupy do bazy
Route::post('/groups/create', [GroupController::class, 'store'])->name('groups.store')->middleware('auth');
// Usunięcie grupy
Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy')->middleware(['group.admin', 'role:Admin']);
// Dodanie nowego użytkownika do grupy
Route::post('/groups/{group}/add-users', [GroupController::class, 'addUsers'])->name('groups.add-users')->middleware(['role:Admin', 'group.admin']);
// Usunięcie użytkownika z grupy
Route::delete('/groups/{group}/remove-user/{user}', [GroupController::class, 'removeUser'])->name('groups.remove-user')->middleware(['role:Admin', 'group.admin']);
// Widok z użytkownikami w danej grupie
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show')->middleware('auth');
// Widok z kalendarzem
Route::get('/fullcalendar', [FullcalendarController::class, 'index'])->name('fullcalendar')->middleware('auth');
Route::get('/fullcalendar/events', [FullcalendarController::class, 'events'])->name('fullcalendar.events')->middleware('auth');
Route::post('/fullcalendar/store', [FullcalendarController::class, 'store'])->name('fullcalendar.store')->middleware('auth');
Route::delete('/fullcalendar/{event}', [FullcalendarController::class, 'destroy'])->name('fullcalendar.destroy')->middleware('auth');
Route::post('fullcalendar/saveGroupId', [FullcalendarController::class,'saveGroupId'])->name('fullcalendar.saveGroupId')->middleware('auth');
