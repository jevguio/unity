<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'room', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
