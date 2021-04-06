<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	//
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'image', 'created_at', 'updated_at'];

    public function tasks(){
    	return $this->hasOne(Task::class);// У таска может быть только 1 статус
    }

    public function notes(){
    	return $this->hasOne(Note::class);// У нескольких разных заметок может быть только 1 статус
    }
}
