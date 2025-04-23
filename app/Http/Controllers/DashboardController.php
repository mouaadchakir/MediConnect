<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Data_user;

class DashboardController extends Controller
{
    public function index()
    {
        $views = [
            'user' => 'src.user.dashboard',
            'doctor' => 'src.doctor.dashboard',
            'admin' => 'src.admin.dashboard',
            'supervisor' => 'src.supervisor.dashboard'
        ];
        $count_users = User::where('role', 'user')->count();
        $count_doctors = User::where('role', 'doctor')->count();
        $porsontage_users = round(($count_users / ($count_users + $count_doctors)) * 100);
        $porsontage_doctors = round(($count_doctors / ($count_users + $count_doctors)) * 100);
        $doctorsCount = [$count_doctors, $count_users, $porsontage_doctors, $porsontage_users];
        $nameuser = Auth::user()->name;
        if (Auth::user()->role == 'doctor') { $datauser = Doctor::where('email', Auth::user()->email)->first(); }
        if (Auth::user()->role == 'user') { $datauser = Data_user::where('email', Auth::user()->email)->first(); }
        if (Auth::user()->role == 'admin') { $datauser = User::where('id', Auth::user()->id)->first();}
        $topDoctors = Doctor::orderBy('rating', 'desc')->take(round(Doctor::count() / 4, 0))->get();
        $topDoctors = $topDoctors->shuffle()->take(3);
        return view($views[Auth::user()->role] ?? redirect()->route('logout'), compact('doctorsCount', 'nameuser', 'datauser', 'topDoctors'));
    }
}
