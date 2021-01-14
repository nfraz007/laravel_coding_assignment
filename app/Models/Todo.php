<?php

namespace App\Models;

use App\Models\Enums\TodoStatus;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public function getStatusLabelAttribute(){
        return TodoStatus::get($this->status);
    }

    public function scopePending($query){
    	return $query->where("status", TodoStatus::pending);
    }

    public function scopeCompleted($query){
    	return $query->where("status", TodoStatus::completed);
    }

    public function scopeNot_deleted($query){
    	return $query->where("status", "!=", TodoStatus::deleted);
    }

    public function parent(){
        return $this->belongsTo(Todo::class, "parent_id");
    }
}
