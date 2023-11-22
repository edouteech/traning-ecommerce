<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Order_Products;

class SellController extends Controller
{
    //use App\Models\Orders;
    public function addProductToOrder(Request $request, $orderId)
    
    {
        // dd($orderId);
        // $request->validate([
        //     'product_id' => 'required|exists:products,id',
        //     'quantity' => 'required|integer|min:1',
        // ]);
        
        // $order = Orders::findOrFail($orderId);
        // $product = Product::findOrFail($request->product_id);
        
        // $order->products()->attach($product, ['quantity' => $request->quantity]);

        // return response()->json(['message' => 'Produit ajouté à la commande avec succès'], 201);
        
        
        
        // // On verifiie les entrées de l'utisateur 
        // $request->validate([
        //     'product_id' => 'required|exists:product,id',
        //     'quantity' => 'required|integger|min:1'
        // ]);
        // // $product = Product::findOrFail($request->product_id);
        // // $order = Orders::findOrFail($request->order_id);
        
        // $order = Orders::findOrFail($orderId);
        // $product = Product::findOrFail($request->product_id);

        // // Ajoute le produit à la commande avec la quantité spécifiée
        // $order->products()->attach($product, ['quantity' => $request->quantity]);

        // return response()->json(['message' => 'Produit ajouté à la commande avec succès'], 200);

        // Validation des données de la requête
    $request->validate([
        'product_id' => 'required|exists:product,id',
        'quantity' => 'required|integer|min:1',
    ]);
    

    // Récupération de l'ordre et du produit
    try {
        $order = Orders::findOrFail($orderId);
        $product = Product::findOrFail($request->input('product_id'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Si l'ordre ou le produit n'est pas trouvé, retourner une réponse d'erreur
        return response()->json(['message' => 'Commande ou produit non trouvé'], 404);
    }

    // Ajout du produit à la commande avec la quantité spécifiée
    $order->products()->attach($product, ['quantity' => $request->input('quantity')]);

    // Réponse de succès
    return response()->json(['message' => 'Produit ajouté à la commande avec succès'], 201);




    }


    public function removeProductFromOrder(Request $request, $orderId)
    {
        // $request->validate([
        //     'product_id' => 'required|exists:products,id',
        // ]);

        // $order = Orders::findOrFail($orderId);
        // $product = Product::findOrFail($request->input('product_id'));

        // $order->products()->detach($product);

        // return response()->json(['message' => 'Produit retiré de la commande avec succès'], 200);

        // $order = Orders::findOrFail($orderId);

        // if($order) {

        //     // Supprime la commande
        //     $order->delete();
        //     return response() -> json([
        //         'status' => 200,
        //         'message' => 'Commande delete'
        //     ], 200);
        // } else {
        //     return response() -> json([
        //         'status' => 400,
        //         'message' => 'Command not found'
        //     ], 400);
        // }

        try {
            $order = Orders::findOrFail($orderId);
    
            // Supprime la commande et toutes ses relations avec les produits
            $order->delete();
    
            return response()->json(['message' => 'Commande supprimée avec succès'], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si la commande n'est pas trouvée, retourner une réponse d'erreur
            return response()->json(['message' => 'Commande non trouvée'], 404);
        }


       
    }



    public function getOrderProducts($orderId)
    {
        // $order = Orders::with('products')->findOrFail($orderId);
        // // dd($orderId);

        // if($order -> count > 0) {

        //     return response()->json([
        //         'statu' => 200,
        //         'message' => $order
        //     ]);        
        // } else {
        //     return response() ->json([
        //         'statu' => 400,
        //         'message' => 'Aucune commande n\'a ete retrouver'
        //     ], 400);
        // }

        try {
            $order = Order_Products::findOrFail($orderId);
    
            return response()->json([
                'status' => 200,
                'data' => $order
            ]);

            // \Illuminate\Database\Eloquent\ModelNotFoundException $e Cette exception est lancée lorsque la méthode findOrFail ne trouve pas d'enregistrement correspondant dans la base de données. Laravel utilise cet exception pour signaler qu'une recherche d'enregistrement spécifique a échoué.
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Aucune commande n\'a été trouvée'
            ], 404);
        }

    }

}
