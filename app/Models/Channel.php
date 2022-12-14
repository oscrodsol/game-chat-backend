<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'channel_name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
