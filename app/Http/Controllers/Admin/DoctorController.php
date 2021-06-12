<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Specialty;
use App\Http\Controllers\Controller;

class DoctorController extends Controller{
  
    public function index(){
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create(){
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'dni' => 'required',
            'address' => 'min:5'
        ]);

        $user = User::create(
            $request->only('name', 'email', 'phone', 'dni', 'address')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->password)
            ]
        );
        $user->specialties()->attach($request->specialties);
        $notification = 'El doctor se ha creado satisfactoriamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    public function edit(User $doctor){
        $specialties = Specialty::all();
        $specialties_id = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialties_id'));
    }

    public function update(Request $request, $id){        
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'dni' => 'required',
            'address' => 'min:5'
        ]);
        $user = User::doctors()->findOrFail($id);
        $data = $request->only('name', 'email', 'phone', 'dni', 'address');
        $password = $request->password;
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->specialties);
        $notification = 'El doctor se ha editado satisfactoriamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    public function destroy(User $doctor){
        $doctorName = $doctor->name;        
        $doctor->delete();
        $notification = "El medico $doctorName se ha eliminado correctamente";
        return redirect('/doctors')->with(compact('notification'));
    }
}
