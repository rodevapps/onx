<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'surname'];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }
}
