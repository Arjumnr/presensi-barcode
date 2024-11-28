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
        'id_student', 
        'id_timetable', 
        'scanned_at'
    ];
}
