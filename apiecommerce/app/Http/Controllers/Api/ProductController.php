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
                'status' => 400,
                'message' => "Aucun produit trouvé"
            ], 400);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'prix' => 'required|int',
            'description' => 'required',
            'id_category' => ['required','exists:categorie,id'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => "Remplissez tous les champs nécessaires        ",
                'erreur' => $validator->messages(),


            ], 422);
        }else{
            $product = Product::create([
            'name' => $request->name,
            'prix' => $request->prix,
            'description' => $request->description,
            'id_category' => $request->id_category,
            ]);

            if($product) {
                return response()->json([
                    'status' => 201,
                    'message' => "Product created",
                    'product' => $product,
                ], 201);
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
            'message' => "Product no found"
            ],404);
        }
    }

    public function edit($id){

        $products = Product::find($id);

        if($products){
            return response()->json([
                'status' => 200,
                'message' => $products,
            ], 200);
        }else{
            return response()->json([
            'status' => 404,
            'message' => "Product no found"
            ],404);
        }    
    }

    public function update(Request $request, int $id){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'description' => 'required',
            'prix' => 'required',
            'id_category' => ['required','exists:categorie,id'],            
          ]);
          if($validator-> fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }else {
        $products = Product::find($id);

        if($products) {

            $products->update([
                'name' => $request->name,
                'description' => $request->description,
                'prix' => $request->prix,
                'id_category' => $request->id_category,
            ]);

            return response()->json([
                'status' => 201,
                'message' => "Product update Successfully",
            ], 201);
        }else{
            return response()->json([
                'status' =>  404,
                "message" => "Product not found"
            ], 404);
        }
      }
    }

    public function destroy($id){
        $products = Product::find($id);

        if($products){
            $products->delete();
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

    public function categorie(int $id_category) {

        $products = Product::where('id_category', $id_category)->get();

        if($products->isNotEmpty()){
            return response()->json([
                'status' => 200,
                'message' => $products
            ], 200);
        }else{
            return response()->json([
            'status' => 404,
            'message' => "This product category is not found"
            ],404);
        } 

    }

    public function prix(Request $request) {
        $minPrice = $request->min_price;
        $maxPrice = $request->max_price;

        $products = Product::whereBetween('prix', [$minPrice, $maxPrice])->get();

        if($products->isNotEmpty()){
            return response()->json([
                'status' => 200,
                'message' => $products,
            ], 200);
        }else{
            return response()->json([
            'status' => 404,
            'message' => "This product category is not found"
            ],404);
        } 
    }
}
