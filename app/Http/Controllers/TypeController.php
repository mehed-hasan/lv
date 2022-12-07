<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class TypeController extends Controller
{
   
function type_page(){
    return view('addType');
}


function type_list(){
    $typeLists = DB::table('types')->get();
    return view('typeList')->withTypeLists($typeLists);

}


function add_type(Request $request){
    $request->validate([
        'type' => 'required|unique:types|max:255',
    ]);

    $typeName =  $request->input('type');  

    DB::table('types')->insert([
        'type' => $typeName,
        'created_at' => Carbon::now()
    ]);


    return redirect('typePage')->with('message','Type created successfully.');

}





function type_edit_page(Request $request, $id){

    $thisRow = DB::table('types')->where('id', $id)->first();

    return view('/editType')->withThisRow($thisRow);
}

public function update_type(Request $request){

    $id =  $request->input('edit_id');

       $request->validate([
           'type' => 'required|unique:types|max:255',
       ]);
   
           // get id 
           $typeName =  $request->input('type');  
   
           DB::table('types')->where('id',$id)->update([
            'type' => $typeName,
            'updated_at' => Carbon::now()
            ]);
   
       session()->flash('message', 'Changes  saved !');
       return redirect('typeList');
   
   }
   


   

public function delete_type(Request $request)
{

    $id = $request->input('action');
    DB::table('types')->where('id',$id)->delete();
    return redirect('typeList')->with('message','Type deleted successfully !.');
}

}
