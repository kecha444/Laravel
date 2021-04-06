<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tasks';
    protected $fillable = ['name', 'image', 'status_id', 'created_at', 'updated_at'];
    
    public function status(){
    	return $this->belongsTo(Status::class);//связь с таблицей статус, чтобы работать с status_id
    	//Один и тот же статус может быть у многих задач одновременно
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function groups(){//связь многие ко многим
        return $this->belongsToMany(Group::class);
    }
}
