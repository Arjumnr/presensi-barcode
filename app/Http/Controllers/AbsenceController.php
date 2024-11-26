<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index(){
        return view('admin.absence.index');
    }

    public function create(){
        return view('admin.absence.form');
    }

    // public function 
}
