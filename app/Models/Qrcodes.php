<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcodes extends Model
{
    use HasFactory;

    protected $table = 'qrcodes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'timetable_id',
        'qr_data',
        'qr_code_image_path',
    ];


    // Relasi dengan tabel TimeTable
    public function timetable()
    {
        return $this->belongsTo(TimeTable::class, 'timetable_id');
    }


    
}
