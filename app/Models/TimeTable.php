<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;
    
    protected $table = 'session_timetable';
    protected $primaryKey = 'id';
    protected $fillable = [
        'matkul',
        'date_session',
        'start_time',
        'end_time',
    ];
}
