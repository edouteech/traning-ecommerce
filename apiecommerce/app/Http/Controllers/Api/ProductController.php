<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index() {
        //Logique pour avoir tous les produits
        $product = Product::all();

        if($product->count() > 0 ) {
            return response()->json([
                'status' => 200,
                'message' => $product,
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'message' => "Aucun produit trouvé"
            ], 200);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price' => 'required|int',
            'describe' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => "Remplissez tous les champs nécessaires        ",
                'erreur' => $validator->messages(),


            ], 422);
        }else{
            $product = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'describe' => $request->describe
            ]);

            if($product) {
                return response()->json([
                    'status' => 200,
                    'message' => "Product created",
                    'product' => $product,
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Erreur survenu lors de la création du produits"
                ], 500);
            }
        }
    }

    public function show($id){
        $products = Product::find($id);

        if($products){
            return response()->json([
                'status' => 200,
                'message' => $products,
            ], 200);
        }else{
            return response()->json([
            'status' => 404,
            'message' => "Product no find"
            ],404);
        }
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
