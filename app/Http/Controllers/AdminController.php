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

    public function searchDoctors(Request $request)
    {
      $query = $request->searchvalue;
      $allDoctors = Doctor::where('name', 'like', '%' . $query . '%')
        ->orWhere('specialization', 'like', '%' . $query . '%')
        ->orWhere('license_number', 'like', '%' . $query . '%')
        ->orWhere('address', 'like', '%' . $query . '%')
        ->orWhere('experience', 'like', '%' . $query . '%')
        ->orWhere('certifications', 'like', '%' . $query . '%')
        ->get();
      return view('src.admin.alldoctors', compact('allDoctors'));
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.alldoctors')->with('success', 'Doctor deleted successfully.');
    }
}
