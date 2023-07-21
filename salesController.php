<?php

namespace App\Http\Controllers;

use App\sales;
use Illuminate\Http\Request;
use App\testUsers;
use PHPUnit\Util\Xml\SuccessfulSchemaDetectionResult;
use  Illuminate\support\Facades\DB;

class salesController extends Controller
{
   
   public function buy(Request $request){
   

   
      \DB::beginTransaction();
      
      try{
         $product = testUsers::find($request->id);
         $remain = $product->stock;
   
         //もし在庫が0になっていたら
         if($remain == 0){
            return response('在庫がありません',400);
         }
         //もし在庫が0以上なら
        if($remain > 0){
         //セールステーブルにデータを追加
         $sale = new Sales();
         $sale->fill([
         'product_id'=>$product->id,
         'created_at'=>now(),
         'updated_at'=>now()   
         ]);
         //在庫を1つ減らす
         $product->stock=$remain-1;
         $product->save();
         $sale->save();

        }

        DB::commit();
        return response()->json(['message'=>'購入が完了しました','sale'=>$sale,]);
        
      }
      catch(\Throwable $e){
         DB::rollback();
         return response('購入できませんでした',400);
      }
      
     
   
      
      
   }




}
