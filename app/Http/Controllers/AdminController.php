<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Data_user;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allDoctors()
    {
        $allDoctors = Doctor::all();
        return view('src.admin.alldoctors', compact('allDoctors'));
    }
}
