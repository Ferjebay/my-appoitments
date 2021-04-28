<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class PatientController extends Controller{
       
    public function index()
    {
        $patients = User::patients()->paginate(5);
        return view('patients.index', compact('patients'));
    }

    public function create(){
        return view('patients.create');
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
                'role' => 'patient',
                'password' => bcrypt($request->password)
            ]
        );
        $notification = 'El paciente se ha creado satisfactoriamente';
        return redirect('/patients')->with(compact('notification'));
    }

    public function edit(User $patient){
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'digits:10',
            'dni' => 'digits:10',
            'address' => 'min:5'
        ]);
        $user = User::patients()->findOrFail($id);
        $data = $request->only('name', 'email', 'phone', 'dni', 'address');
        $password = $request->password;
        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();
        $notification = 'El paciente se ha editado satisfactoriamente';
        return redirect('/patients')->with(compact('notification'));
    }

    public function destroy(User $patient){
        $patientName = $patient->name;        
        $patient->delete();
        $notification = "El paciente $patientName se ha eliminado correctamente";
        return redirect('patients')->with(compact('notification'));
    }
}
