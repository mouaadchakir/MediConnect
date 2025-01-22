<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Data_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  public function showRegistrationForm() { return view('register'); }

  public function register(Request $request) {
    $validatdata = [
      'fullname' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'role' => 'required|string|in:doctor,user',
      'password' => 'required|string|min:8|confirmed:cpassword',
      'sex' => 'required|string|in:male,female'
    ];

    $validator_data = Validator::make($request->all(), $validatdata);

    if ($validator_data->fails()) { return redirect()->back()->withErrors($validator_data)->withInput(); }

    $data = $request->all();
    $data['password'] = Hash::make($data['password']);
    $data['image'] = 'https://randomuser.me/api/portraits/' . ($data['sex'] == 'male' ? 'men/' : 'women/') . rand(0, 90) . '.jpg';

    $user_data = User::create([
      'name' => $data['fullname'],
      'email' => $data['email'],
      'role' => $data['role'],
      'password' => $data['password'],
    ]);

    if ($data['role'] == 'doctor') {
      Doctor::create([
        'user_id' => $user_data->id,
        'name' => $data['fullname'],
        'image' => $data['image'],
        'email' => $data['email'],
        'sex' => $data['sex']
      ]);
    }
 
    if ($data['role'] == 'user') {
      Data_user::create([
        'user_id' => $user_data->id,
        'name' => $data['fullname'],
        'image' => $data['image'],
        'email' => $data['email'],
        'sex' => $data['sex']
      ]);
    }

    return redirect()->route('login')->with('success', 'Utilisateur créé');
  }
}
