<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Event;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class FullcalendarController extends Controller
{
    public function index(Request $request)
    {
    $user = Auth::user();

    if ($user->last_event_id) {
        // Jeśli last_event_id jest ustawione, wyświetl powiadomienie na stronie głównej
        $user->last_event_id = null; // Ustaw last_event_id na null, aby nie wyświetlać powiadomienia ponownie
        $user->save(); // Zapisz zmiany w bazie danych
        $request->session()->flash('eventAddedNotification', true); // Ustaw sesję powiadomienia
    }

    $groups = Group::all(); // Pobierz wszystkie grupy
    $selectedGroupId = Session::get('selected_group_id'); // Pobierz identyfikator grupy z sesji

    return view('calendar.fullcalendar', compact('groups', 'selectedGroupId'));
    }


    public function events(Request $request)
    {
        $user = Auth::user();
        $groupIdFromSession = Session::get('selected_group_id'); // Odczytaj identyfikator grupy z sesji

        // Sprawdź, czy identyfikator grupy został zapisany w sesji
        if ($groupIdFromSession) {
            $group = $user->groups()->find($groupIdFromSession);

            // Jeśli użytkownik nie należy do grupy o podanym identyfikatorze z sesji,
            // zwracamy pustą kolekcję wydarzeń
            if (!$group) {
                return response()->json([]);
            }
        } else {
            // Jeśli identyfikator grupy nie jest zapisany w sesji, wykorzystaj identyfikator grupy użytkownika
            $group = $user->groups()->find($request->group);

            // Jeśli użytkownik nie należy do grupy o podanym identyfikatorze,
            // zwracamy pustą kolekcję wydarzeń
            if (!$group) {
                return response()->json([]);
            }
        }

        $events = $group->events;

        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
            ];
        });

        return response()->json($formattedEvents);
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'group' => 'required|exists:groups,id',
        ]);
    // Pobierz grupę
        $group = Group::findOrFail($request->group);
        $users = $group->users;

        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->user_id = Auth::id();
        $event->group_id = $request->group;
        // Zapisz wydarzenie
        $event->save();

        foreach ($users as $user) {
            $user->last_event_id = $event->id;
            $user->save();
        }
        $request->session()->flash('eventAddedNotification', true);

        // Zapisz identyfikator grupy w sesji użytkownika
        Session::put('selected_group_id', $request->group);
        

    
        return response()->json($event);
    }


    public function destroy(Request $request, $event)
    {
        $event = Event::where('user_id', Auth::id())->find($event);
        if (!$event) {
            return response()->json(['message' => 'Nie znaleziono spotkania.'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Spotkanie usunięte.']);
    }
    public function saveGroupId(Request $request)
    {
        $request->validate([
            'group' => 'required|exists:groups,id',
        ]);

        // Zapisz identyfikator grupy w sesji
        Session::put('selected_group_id', $request->group);

        return response()->json(['message' => 'Identyfikator grupy został zapisany w sesji.']);
    }

}
