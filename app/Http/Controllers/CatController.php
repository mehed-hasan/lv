<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class CatController extends Controller
{


function cat_page(){
    return view('addCat');
}


function cat_list(){
    $catLists = DB::table('cats')->get();
    return view('catList')->withCatLists($catLists);

}

function add_cat(Request $request){
    $request->validate([
        'cat_name' => 'required|unique:cats|max:255',
        'cat_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
    ]);
 
    $catName =  $request->input('cat_name');  
    $catImage = $request->file('cat_image');
    $uid = uniqid();  

    $catImageName = $uid.'.'.$catImage->getClientOriginalExtension();
    $catImage->move('uploads/cats',$catImageName);  
    DB::table('cats')->insert([
        'cat_name' => $catName,
        'cat_image' => $catImageName,
        'created_at' => Carbon::now()
    ]);

    return redirect('catPage')->with('message','Category created successfully.');

}

    

function cat_edit_page(Request $request, $id){
    $thisRow = DB::table('cats')->where('id', $id)->first();
    return view('/editCat')->withThisRow($thisRow);

}


 function update_cat(Request $request){

 $id =  $request->input('edit_id');
$catName =  $request->input('cat_name');  
$updated_img = $request->file('cat_image');


 $get_info = DB::table('cats')->where('id',$id)->first();
 $cat_name = $get_info->cat_name;
 $prev_image = $get_info->cat_image;


if($cat_name === $catName){

}else{
    $request->validate([
        'cat_name' => 'required|unique:cats|max:255',
        // 'cat_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
    ]);

}



        $uid = uniqid();  

     
        if($updated_img == ''){
            DB::table('cats')->where('id',$id)->update([
                'cat_name' => $catName,
                'updated_at' => Carbon::now()
                ]);
        }else{
                // Unlink previous and update it !

                $updated_img_name = $uid.'.'.$updated_img->getClientOriginalExtension();

                if(file_exists('uploads/cats/'.$prev_image)){
                    @unlink('uploads/cats/'.$prev_image);
                    $updated_img->move('uploads/cats',$updated_img_name);  
                
                }else{
                    session()->flash('error_messege', 'No file on that path.');
                    return redirect('/catList');
                }

                DB::table('cats')->where('id',$id)->update([
                    'cat_name' => $catName,
                    'cat_image' => $updated_img_name,
                    'updated_at' => Carbon::now()
                    ]);

        }


    session()->flash('message', 'Changes saved !');
    return redirect('catList');

}




public function del_cat(Request $request)
{
    $id = $request->input('action');
    $this_row = DB::table('cats')->where('id', $id)->first();
    $this_image_name = $this_row->cat_image;
    DB::table('cats')->where('id',$id)->delete();


    @unlink('uploads/cats/'.$this_image_name);

    session()->flash('message', 'Cats  deleted successfully !');

    $catLists = DB::table('cats')->get();
    return redirect('catList')->with('message','Category deleted successfully.');
}

}
