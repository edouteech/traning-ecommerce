<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function postOrder(Request $request){
        $states = ["in_stock", "out_stock", "closed", "neutre" ];


        $validator =  Validator::make($request->all(),[
            'user_id' => ['required','exists:students,id'],
            'state' => ['required'],
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
                    "message" =>"Les valeurs du states doivent etre out_stock, in_stock, closed, neutre"
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
                'status' => 500,
                'message' => "Erreur survenue lors de la suppression de la commande"
            ],500);
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

}
