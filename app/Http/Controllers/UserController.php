<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Data_user;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\Messagesortde;

class UserController extends Controller
{
    public function profile()
    {
        $nameuser = Auth::user()->name;
        $datauser = Data_user::where('email', Auth::user()->email)->first();
        return view('src.user.profile', compact('nameuser', 'datauser'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|min:4',
            'phone' => 'required|regex:/^\d{10}$/',
            'address' => 'required|string|min:4',
        ]);
        if ($validator->fails()) {
            $nameuser = Auth::user()->name;
            $datauser = Data_user::where('email', Auth::user()->email)->first();
            $errors = $validator->errors()->all();
            return view('src.user.profile', compact('nameuser', 'datauser', 'errors'));
        }
        try {
            User::where('id', Auth::id())->update(['name' => $request->fullName]);
            Data_user::where('user_id', Auth::id())->update([
                'name' => $request->fullName,
                'phone_number' => $request->phone,
                'address' => $request->address,
            ]);
            $nameuser = Auth::user()->name;
            $datauser = Data_user::where('email', Auth::user()->email)->first();
            $success = 'Profile updated successfully';
            return view('src.user.profile', compact('nameuser', 'datauser', 'success'));
        } catch (\Exception $e) {
            $nameuser = Auth::user()->name;
            $datauser = Data_user::where('email', Auth::user()->email)->first();
            $error = 'Failed to update profile';
            return view('src.user.profile', compact('nameuser', 'datauser', 'error'));
        }
    }

    public function allDoctors()
    {
        $nameuser = Auth::user()->name;
        $datauser = Data_user::where('email', Auth::user()->email)->first();
        $allDoctors = Doctor::all();
        return view('src.user.alldoctors', compact('nameuser', 'datauser', 'allDoctors'));
    }

    public function searchDoctors(Request $request)
    {
      $query = $request->searchvalue;
      $nameuser = Auth::user()->name;
      $datauser = Data_user::where('email', Auth::user()->email)->first();
      $allDoctors = Doctor::where('name', 'like', '%' . $query . '%')
        ->orWhere('specialization', 'like', '%' . $query . '%')
        ->orWhere('license_number', 'like', '%' . $query . '%')
        ->orWhere('address', 'like', '%' . $query . '%')
        ->orWhere('experience', 'like', '%' . $query . '%')
        ->orWhere('certifications', 'like', '%' . $query . '%')
        ->get();
      return view('src.user.alldoctors', compact('nameuser', 'datauser', 'allDoctors'));
    }

    public function meassagelist()
    {
        $datamessage = new Messagesortde();
        $nameuser = Auth::user()->name;
        $datauser = Data_user::where('email', Auth::user()->email)->first();
        $datamessage = $datamessage->sortMessageslasetes();
        return view('src.user.mesagelist', compact('nameuser', 'datauser', 'datamessage'));
    }

    public function meassangeroom($id)
    {
        if (!Doctor::where('user_id', $id)->exists()) {
            return redirect()->route('user.meassagelist');
        }
        $datamessage = new Messagesortde();
        $datamessage = $datamessage->get_all_messages_doctor($id);
        $datadoctor = Doctor::where('user_id', $id)->first();
        return view('src.user.meassangeroom', compact('datamessage', 'datadoctor'));
    }
}
