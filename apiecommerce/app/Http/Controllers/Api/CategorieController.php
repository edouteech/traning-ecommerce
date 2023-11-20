<?php

namespace App\Http\Controllers\Api;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategorieController extends Controller
{
   
   
    public function index()
    {
        // On recupere toutes les categories
        $categorie = Categorie::all();

        if($categorie ->count() > 0 ) {
            return response() -> json([
                'status' => 200,
                'message' => $categorie
            ]);
        }else {
            return response() -> json ([
                'status' => 400,
                'message' => 'Aucune categorie trouver'
            ], 400);
        }


        // On recupére les informations des categories en JSON
        // return response()->json($categorie);
    }

    public function store(Request $request) {

        // La validation de données
        $validator = Validator::make($request->all(), [
            'nom_categorie' => 'required'
          
        ]);

        if($validator->fails()) {
            return response() -> json ([
                'statu' => 400,
                'message' => 'Veiller remplire le champ',
                'erreur' => $validator->messages(),
            ], 422);
        } else {
            $categorie = Categorie::create([
                'nom_categorie' => $request->nom_categorie
            ]);
            if($categorie) {
                return response() ->json([
                    'status' => 201,
                    'message' => 'categorie created',
                    'categorie' => $categorie
                ], 201);
            }else {
                return response() -> json([
                    'statu' => 500,
                    'message' => 'erreur survenu lors de la creation'
                ], 500);
            }
    
        }
    }


        // $this->validate($request, ['nom_categorie' => 'required|max:100']);

        // if($this->fails()){
        //     return response()->json([
        //         'status' => '500',
        //         'message' => 'Le champs reserver aux catégories ne doit pas être vide'
        //     ]); 
        // }

        // On crée une nouvelle categorie

        

        // On retourne les informations de la nouvelle categorie en JSON

        // return response()->json($categorie, 201);


    public function show(Categorie $categorie)
    {
        // On retourne les informations des categories en JSON
        // return response()->json($categorie);

        $categorie = Categorie::find($categorie);

        if($categorie){
            return response()->json([
                'status' => 200,
                'message' => $categorie,
            ], 200);
        }else{
            return response()->json([
            'status' => 404,
            'message' => "Product no found"
            ],404);
        }
    }
    // ... more methods ...

    public function update(Request $request, Categorie $categorie) {
        //  La validation de données
        // dd($categorie);
        // $this->validate($request, ['nom_categorie' => 'required|max:100']);

        // On modifie les informations des categories

        // $categorie->update([
        //     'nom_categorie' => $request->nom_categorie
        // ]);

        // On retourne la reponse sous forme JSON

        // return response([
        //     'message' => 'Modification effectuer'
        // ]);


        $validator = Validator::make($request->all(), [
            'nom_categorie' => 'required|max:191'
        ]);

        if($validator-> fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
                ], 422);
        } else {

            $categorie = Categorie::find($categorie);
        
                if($categorie) {
            
                        $categorie->update([
                            'nom-categorie' => $request->nom_categorie,
                            
                        ]);
                        return response()->json([
                            'status' => 201,
                            'message' => "Product update Successfully",
                        ], 201);

                } else{
                        return response()->json([
                                'status' =>  404,
                                "message" => "Product not found"
                        ], 404);
                    }
                }

    }

    public function destroy(Categorie $categorie) {
        // On supprime les categories

        $categorie ->delete();

        // On retourne la réponse en JSON
        return response()->json();

        $categorie = Categorie::find($categorie);

        if($categorie){

        $categorie->delete();
        return response()->json([
            'status' =>  200,
            "message" => "Product  delete"
        ], 200);

        }else{

                return response()->json([
                    'status' =>  404,
                    "message" => "Product no  found"
                ], 404);
            }    
        }

    
}
