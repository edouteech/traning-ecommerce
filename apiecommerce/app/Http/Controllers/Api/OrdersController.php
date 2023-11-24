<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderProducts;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function index(){
        $orders = Orders::all();
        if ($orders->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => $orders
            ], 200);
        }else{
            return response()->json([
                'status' => 400,
                "message" => "Pas de stock"
            ], 400);
        } 
    }

    public function store(Request $request){
        $states = ["fail", "created", "pending", "complete" ];
        $validator =  Validator::make($request->all(),[
            'user_id' => ['required','exists:students,id'],
            'state' => ['required', Rule::in($states)],
            'product' => 'required|array',
            'product.*.product_id' => 'required|exists:product,id',
            'product.*.quantity' => 'required|integer|min:1',
        
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => 422,
                "message" => $validator->messages(),
            ], 422);
        }else {
            if(in_array($request->state, $states)){
                $orders = Orders::create([
                    'user_id' => $request->user_id,
                    'state' => $request->state,
                    ]);
                        $product = $request->input('product', []);

                        foreach ($product as $products) {
                            $product_id = $products['product_id'];
                            $quantity = $products['quantity'];
            
                            // Ajoutez la relation many-to-many entre la commande et le produit
                            $orders->products()->attach($product_id, ['quantity' => $quantity]);
                        }
            
                    if($orders){
                        return response()->json([
                            'status' => 201,
                            'message' => 'Order created successfully'
                        ],201);
                    }else{
                        return response()->json([
                            'status' => 500,
                            'message' => "Erreur survenu lors de la création de la commande"
                        ], 500);
                    }
            }else{
                return response()->json([
                    "status" => 422,
                    "message" =>"Les valeurs du states doivent etre ". implode(", ",$states)
                ], 422);
            }
           
        }
    }

    public function destroy($id) {
        $orders = Orders::find($id);

        if($orders){
            $orders->delete();

            return response()->json([
                'status'=> 200,
                'message' => 'Orders deleted successfully',
            ], 200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => "Cette commande n'est pas trouvé"
            ],400);
        }
    }

    public function show(int $id) {
        $orders = Orders::find($id);

        
        if($orders) {
            return response()->json([
                'status' => 200,
                'message'=> $orders,
            ],200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => "Commande non trouvé"
            ],400);
        }
    }

    public function getOrderProducts() {

        //Créeons une variable qui contient  les données
        $orderProductsData = [];
    
        // Récupéreons toutes les order_products avec les relations products et orders
        $orderProducts = OrderProducts::with(['product', 'order'])->get();
    
        foreach ($orderProducts as $orderProduct) {
            $orderId = $orderProduct->order->id;
            $order_state = $orderProduct->order->state;
            $productId = $orderProduct->product->id;
            $productName = $orderProduct->product->name;
            $product_prix = $orderProduct->product->prix;
            $quantity = $orderProduct->quantity;
    
            // Mettons maintenant  les données de order_product au tableau $orderProductsData
            $orderProductsData[] = [
                "order_id" => $orderId,
                "product_id" => $productId,
                "product_name" =>$productName,
                "order_state" =>$order_state,
                "price_of_product" => $product_prix,
                "quantity" => $quantity,
            ];
        }
    
        // Return après avoir traité toutes les order_products
        return response()->json([
            "status" => 200,
            "data" => $orderProductsData,
        ], 200);
    }
    

}
