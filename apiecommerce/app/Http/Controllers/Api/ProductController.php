<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        //Logique pour avoir tous les produits
    }

    public function store(){
        // Logique pour ajouter les produits
    }

    public function show($id){
        //logique pour voir un seul produit
    }

    public function edit($id){
        // Logique pour voir un produit qu'on peut modifier
    }

    public function update(Request $request, int $id){
        //Logique pour modifier un produit
    }

    public function destroy($id){
        //Logique pour supprimer des articles
    }

    public function categorie($categorie) {

        //Logique pour récupérer des produits selon une catégorie
    }

    public function price($price) {
        //Logique pour récupérer les produits selon le prix
    }
}
