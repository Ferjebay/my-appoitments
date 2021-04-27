<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}
    
	public function index(){
		$specialties = Specialty::all();
		return view('specialties.index', compact('specialties'));
	}

	public function create(){
		return view('specialties.create');
	}

	private function perfomValidation($request){
		$request->validate([
			'name' => 'required|min:3',
			'description' => 'required'
		]);
	}

	public function store(Request $request){
		$this->perfomValidation($request);

		$specialty = new Specialty();
		$specialty->name 		= $request->name;
		$specialty->description = $request->description;
		$specialty->save();
		$notification = 'La especialidad se ha creado correctamente';
		return redirect('/specialties')->with(compact('notification'));
	}

	public function update(Request $request, Specialty $specialty){
		$this->perfomValidation($request);

		$specialty->name 		= $request->name;
		$specialty->description = $request->description;
		$specialty->save();
		$notification = 'La especialidad se ha editado correctamente';
		return redirect('/specialties')->with(compact('notification'));
	}

	public function edit(Specialty $specialty){
		return view('specialties.edit', compact('specialty'));
	}

	public function destroy(Specialty $specialty){
		$deletedName = $specialty->name;
		$specialty->delete();
		$notification = 'La especialidad ' .$deletedName. ' se ha eliminado correctamente';
		return redirect('/specialties')->with(compact('notification'));
	}

}
