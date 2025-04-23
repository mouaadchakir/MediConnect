<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Data_user;
use Illuminate\Support\Facades\Validator;
use App\Services\Messagesortde;

class DoctorController extends Controller
{
    public function profile()
    {
        $namedoctor = Auth::user()->name;
        $datadoctor = Doctor::where('email', Auth::user()->email)->first();
        return view('src.doctor.profile', compact('namedoctor', 'datadoctor'));
    }

    public function updatedoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'specialization' => 'required|string|min:4',
            'license_number' => 'required|string|min:4',
            'working_hours' => 'required|string|min:1',
            'experience' => 'required|integer|min:1',
            'certifications' => 'required|string|min:4',
            'phone_number' => 'required|regex:/^\d{10}$/',
            'address' => 'required|string|min:4',
        ]);
        if ($validator->fails()) {
            $namedoctor = Auth::user()->name;
            $datadoctor = Doctor::where('email', Auth::user()->email)->first();
            $errors = $validator->errors()->all();
            return view('src.doctor.profile', compact('namedoctor', 'datadoctor', 'errors'));
        }
        try {
            Doctor::where('user_id', Auth::id())->update([
                'name' => $request->name,
                'specialization' => $request->specialization,
                'license_number' => $request->license_number,
                'working_hours' => $request->working_hours,
                'experience' => $request->experience,
                'certifications' => $request->certifications,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            $namedoctor = Auth::user()->name;
            $datadoctor = Doctor::where('email', Auth::user()->email)->first();
            $success = 'Profile updated successfully';
            return view('src.doctor.profile', compact('namedoctor', 'datadoctor', 'success'));
        } catch (\Exception $e) {
            $namedoctor = Auth::user()->name;
            $datadoctor = Doctor::where('email', Auth::user()->email)->first();
            $error = 'Failed to update profile';
            return view('src.doctor.profile', compact('namedoctor', 'datadoctor', 'error'));
        }
    }

    public function meassagelist()
    {
        $datamessage = new Messagesortde();
        $nameuser = Auth::user()->name;
        $datauser = Doctor::where('email', Auth::user()->email)->first();
        $datamessage = $datamessage->sortMessageslasetes();
        return view('src.doctor.mesagelist', compact('nameuser', 'datauser', 'datamessage'));
    }

    public function meassangeroom($id)
    {
        if (!Data_user::where('user_id', $id)->exists()) {
            return redirect()->route('doctor.meassagelist');
        }
        $datamessage = new Messagesortde();
        $datamessage = $datamessage->get_all_messages_doctor($id);
        $datadoctor = Data_user::where('user_id', $id)->first();
        return view('src.doctor.meassangeroom', compact('datamessage', 'datadoctor'));
    }
}
