<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
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

    public function store(Request $request) { }


    public function show($id)
    {
        // Logic to display a specific task
    }
    // ... more methods ...

    public function update(Request $request, Categorie $categorie) { }

    
}
