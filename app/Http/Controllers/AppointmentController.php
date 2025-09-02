<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with('doctor') // Eager load the doctor relationship
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('src.user.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @param  \App\Models\User  $doctor
     * @return \Illuminate\View\View
     */
    public function create(User $doctor)
    {
        return view('src.user.appointments.create', compact('doctor'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:now',
            'reason' => 'nullable|string|max:255',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Appointment booked successfully!');
    }
}