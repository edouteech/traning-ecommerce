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

        // On recupére les informations des categories en JSON
        return response()->json($categorie);
    }

    public function store(Request $request) {

        // La validation de données

        $this->validate($request, ['nom_categorie' => 'required|max:100']);

        // if($this->fails()){
        //     return response()->json([
        //         'status' => '500',
        //         'message' => 'Le champs reserver aux catégories ne doit pas être vide'
        //     ]); 
        // }

        // On crée une nouvelle categorie

        $categorie = Categorie::create([
            'nom_categorie' => $request->nom_categorie
        ]);

        // On retourne les informations de la nouvelle categorie en JSON

        return response()->json($categorie, 201);



     }


    public function show(Categorie $categorie)
    {
        // On retourne les informations des categories en JSON
        return response()->json($categorie);
    }
    // ... more methods ...

    public function update(Request $request, Categorie $categorie) {
        //  La validation de données
dd($categorie);
        $this->validate($request, ['nom_categorie' => 'required|max:100']);

        // On modifie les informations des categories

        $categorie->update([
            'nom_categorie' => $request->nom_categorie
        ]);

        // On retourne la reponse sous forme JSON

        return response([
            'message' => 'Modification effectuer'
        ]);
     }

     public function destroy(Categorie $categorie) {
        // On supprime les categories

        $categorie ->delete();

        // On retourne la réponse en JSON
        return response()->json();
     }

    
}
