<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class DoctorController extends Controller{
  
    public function index(){
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create(){
        return view('doctors.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'phone' => 'digits:10',
            'dni' => 'digits:10',
            'address' => 'min:5'
        ]);

        User::create(
            $request->only('name', 'email', 'phone', 'dni', 'address')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->password)
            ]
        );
        $notification = 'El doctor se ha creado satisfactoriamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    public function edit(User $doctor){
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id){        
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'digits:10',
            'dni' => 'digits:10',
            'address' => 'min:5'
        ]);
        $user = User::doctors()->findOrFail($id);
        $data = $request->only('name', 'email', 'phone', 'dni', 'address');
        $password = $request->password;
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
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
