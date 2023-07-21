<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\testUsers;
use App\models\companies;

class testUsersController extends Controller
{

        public function showList(){
        $companies = companies::all();
        $test_users = testUsers::all();

        return  view('list',['test_users' => $test_users],['companies' => $companies]);
      
    }

    public function showDetail($id){
        /**商品詳細画面
         * @param int $id
         * @return view
         */
        $test_user = testUsers::find($id);
        

        if(is_null($test_user)){
            
            return redirect(route('list'));
        }

        return  view('detail',['test_user' => $test_user]);
      
    }

    public function showCreate(){
        return view('create');
    }
    //商品登録

    public function exeStore(Request $request){

        $inputs = $request->all();

        $companies = companies::all();
   
        \DB::beginTransaction();
        try{
            testUsers::create($inputs);
            $uploaded_image = $request->file('profile_image');
            \DB::commit();
        }
        catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
       
       return redirect()->route('list')->with("message",config('const.status_list.1'));

    }
    
    public function showEdit($id){
        /**商品編集画面
         * @param int $id
         * @return view
         */

        $test_user = testUsers::find($id);

        if(is_null($test_user)){
            return redirect(route('list'));
        }

        return  view('edit',['test_user' => $test_user]);
      
    }

    public function exeUpdate(Request $request){
        
        $inputs = $request->all();

        $companies = companies::all();

        \DB::beginTransaction();
        try{
            $test_user = testUsers::find($inputs['id']);
            $test_user->fill([
            'company_id'=>$inputs['company_id'],
            'product_name'=>$inputs['product_name'],
            'price'=>$inputs['price'],
            'stock'=>$inputs['stock'],
            'comment'=>$inputs['comment'],
            'img_path'=>$inputs['img_path']
            ]);
            
            $uploaded_image = $request->file('profile_image');
            $test_user->save();
            \DB::commit();
        }
        catch(\Throwable $e){
            abort(500);
            \DB::rollback();
        }
        
 
        
        return redirect()->route('list')->with("message",config('const.status_list.2'));
        
  
    }

        /**商品削除画面
         * @param int $id
         * @return view
         */
        /*public function exeDelete($id){

        
        try{
            testUsers::destroy($id);
        }
        catch(\Throwable $e){
            abort(500);
        }

        return redirect()->route('list')->with("message",config('const.status_list.3'));
      
    }*/

    public function search($keyword){

        $test_users = testUsers::
         where('product_name','like','%'.$keyword.'%')
        //2の上限
        /*->where('price','<=',50)
        ->where('stock','<=',5)*/
        ->get();

        return response()->json([
            'result'    => $test_users,
        ]);



    }
        public function destroy(Request $request) {

            DB::beginTransaction();
            try{
            $user = testUsers::findOrFail($request->id);

            $user->delete();
            DB::commit();
            }
            catch(\Throwable $e){
            abort(500);
            }
       
    }

    public function sort($name,$sort){
        $test_users = testUsers::orderBy($name,$sort)->get();
        return response()->json([
            'result'    => $test_users,
        ]);

   
    }
}
 

    
