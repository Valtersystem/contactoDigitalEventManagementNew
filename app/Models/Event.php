<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'location',
        'is_active',
    ];

    // 🔥 Relacionamento Many-to-Many com usuários (gerentes)
    public function managers()
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->withTimestamps();
    }
}
