<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListPresent extends Model
{
    use HasFactory;
    
    protected $table = 'list_present';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user', 
        'id_timetable', 
        'scanned_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function timetable()
    {
        return $this->belongsTo(TimeTable::class, 'id_timetable');
    }
}
