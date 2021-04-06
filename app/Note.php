<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'notes';
    protected $fillable = ['name', 'status_id', 'created_at', 'updated_at'];

	public function status(){
	    return $this->belongsTo(Status::class);
	}
}