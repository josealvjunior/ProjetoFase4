<?php

namespace project\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];

    public function client()
    {
        return $this->hasMany(Projects::class);
    }
}
