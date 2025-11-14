<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $events = Event::all();
        } else {
            $events = $user->events;
        }

        return response()->json($events);
    }

    public function store(EventStoreRequest $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name']);

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);

        return response()->json($event);
    }

    public function update(EventUpdateRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validated();

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $event->update($validated);

        return response()->json($event);
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json(['message' => 'Evento removido']);
    }
}
