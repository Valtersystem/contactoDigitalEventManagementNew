<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    public function viewAny(User $user)
    {
        return true; // qualquer autenticado pode ver a lista
    }

    public function view(User $user, Event $event)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->events()->where('events.id', $event->id)->exists();
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Event $event)
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Event $event)
    {
        return $user->isAdmin();
    }
}
