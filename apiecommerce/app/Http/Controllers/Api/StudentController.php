<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();
        if($students-> count()  > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'message' => $students
                ], 200);
        }else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => "No records found"
                ], 404);
        }
        
    }
    public function store(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:191',
        'email' => 'required|max:191',
        'role' => 'required',
        'password' => "required"
        
      ]);

      if($validator-> fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
      }else {
        $students = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),


        ]);
        if($students) {
            return response()->json([
                'status' => 200,
                'message' => "Students Created Successfully",
            ], 200);
        }else{
            return response()->json([
                'status' =>  500,
                "message" => "users not create"
            ], 500);
        }
      }
    }
    public function show($id) {
        $students = Student::find($id);

        if($students) {
            return response()->json([
                'status' => 200,
                'message' => $students,
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => "Utilisateurs nan trouvé",
            ], 404);

        }
    }
    public function edit($id){
        $students = Student::find($id);

        if($students) {
            return response()->json([
                'status' => 200,
                'message' => $students,
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => "Utilisateurs nan trouvé",
            ], 404);

        }
    }
    public function update(Request $request, int $id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'role' => 'required',
            'password' => "required"
            
          ]);
    
          if($validator-> fails()) {
                return response()->json([
                    'status' => 422,
                    'error' => $validator->messages()
                ], 422);
          }else {
            $students = Student::find($id);

            if($students) {

                $students->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => $request->password,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Students update Successfully",
                ], 200);
            }else{
                return response()->json([
                    'status' =>  404,
                    "message" => "users not update"
                ], 404);
            }
          }
    }

    public function destroy($id){
        $students = Student::find($id);

        if($students){
            $students->delete();
            return response()->json([
                'status' =>  200,
                "message" => "users  delete"
            ], 200);

        }else{
            return response()->json([
                'status' =>  404,
                "message" => "users no  find"
            ], 404);
        }
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        $student = Student::where('email', $request->email)->first();
        if($student){

            if(Hash::check($request->password, $student->password)){
                // Création de la session
                Session::put('user', $student);

                return response()->json([
                    'status' => 200,
                    'message' => "Connexion Reussie"
                ]);
            }else{
                return response()->json([
                    'status' => 400,
                    'message' => "Vérifier les informations que tu m'envoies",
                ], 400);
            }
        }else{
            return response()->json([
                'status' => 400,
                'message' => "Vérifier les informations"
            ]);
        }
    }

    public function logout(Request $request)
{
    $request->session()->forget('user');

    if (!$request->session()->has('user')) {
        return response()->json([
            'status' => 200,
            'message' => 'Vous venez de vous déconnecter',
        ], 200);
    } else {
        return response()->json([
            'status' => 500,
            'message' => 'Erreur lors de la déconnexion',
        ], 500);
    }
}

}