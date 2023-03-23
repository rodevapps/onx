<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'surname'];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
