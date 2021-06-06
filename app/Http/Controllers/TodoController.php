<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB,Validator,Exception;

use App\Todo;

class TodoController extends Controller
{
    //

    public function todos_index() {
  
    	$todos = Todo::get();

    	return view('welcome')->with('todos',$todos);
    }


    public function todos_save(Request $request) {

    	try {

    		DB::beginTransaction();

    		$validator = Validator::make($request->all(),
    			['name' => 'required']);

    		if($validator->fails()){

    			$error_messages = implode(',', $validator->messages()->all());

    			throw new Exception($error_messages, 101);
    			
    		} 

    		$todo_details = new Todo;

    		$todo_details->name = $request->name;

    		if($todo_details->save()){

    			DB::commit();

    			return redirect()->back()->with('success','Todo created successfully');

    		}

    		throw new Exception("Todo creation failed", 101);
    		

    	} catch(Exception $e) {

    		DB::rollback();

    		return redirect()->back()->withInput()->with('error',$e->getMessage());
    	}
    }

    public function todos_delete(Request $request) {

    	try {

    		DB::beginTransaction();

    		$todo_details = Todo::find($request->todo_id);

    		if(!$todo_details) {

    			throw new Exception("Todo not found", 101);
    			
    		}

    		if($todo_details->delete()){

    			DB::commit();

    			return redirect()->back()->with('success','Data Deleted successfully');

    		}

			throw new Exception("Todo deletion failed", 101);
			    		    		

    	} catch(Exception $e) {

    		DB::rollback();

    		return redirect()->back()->withInput()->with('error',$e->getMessage());
    	}
    }
}
