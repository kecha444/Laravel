<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = false;


public function tasks(){//связь многие ко многим
        return $this->belongsToMany(Task::class);
    }
}