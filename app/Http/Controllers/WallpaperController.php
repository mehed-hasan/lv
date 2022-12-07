<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class WallpaperController extends Controller
{   


    function wp_page(){
        $wpCats = DB::table('cats')->get();
        $wpTypes = DB::table('types')->get();

        return view('addWp')->withWpCats($wpCats)->withWpTypes($wpTypes);
    }




    function wp_list(){
        $wpLists = DB::table('wallpapers')->get();
        return view('welcome')->withWpLists($wpLists);
    
    }
    

    function add_wp(Request $request){
        $request->validate([
            'wp_name' => 'required|max:255',
            'wp_cat' =>'required|max:255',
            'wp_type'=>'required|max:255',
            'wp_subscription' => 'required|max:255',
            'wp_thumb' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'wp_img' => 'required|mimes:jpeg,png,jpg,gif,svg',

        ]);
     
        $wpName =  $request->input('wp_name');  
        $wpCat =  $request->input('wp_cat');  
        $wpType =  $request->input('wp_type');  
        $wpSubscription =  $request->input('wp_subscription');  
        $wpThumb = $request->file('wp_thumb');
        $wpImg = $request->file('wp_img');
        $uid = uniqid();  
    
        $wpThumbImgName = $uid.'.'.$wpThumb->getClientOriginalExtension();
        $wpImgName = $uid.'.'.$wpImg->getClientOriginalExtension();

        $wpThumb->move('uploads/wallpapers',$wpThumbImgName);
        $wpImg->move('uploads/thumbnails',$wpImgName);
        DB::table('wallpapers')->insert([
            'wallpaper_name' => $wpName,
            'wallpaper_cat' => $wpCat,
            'wallpaper_type' => $wpType,
            'wallpaper_subscription'=>$wpSubscription,
            'wallpaper_thumb'=>$wpThumbImgName,
            'wallpaper_image' =>$wpImgName,
            'created_at' =>Carbon::now()
        ]);


        return redirect('/wpPage')->with('message','Category created successfully.');
    
    }




    function wp_edit_page(Request $request, $id){
        $thisRow = DB::table('wallpapers')->where('id', $id)->first();
        $wpCats = DB::table('cats')->get();
        $wpTypes = DB::table('types')->get();
        return view('/editWp')->withThisRow($thisRow)->withWpCats($wpCats)->withWpTypes($wpTypes);
    
    }




    
    function update_wp(Request $request){

        $id =  $request->input('edit_id');
 
        $get_info = DB::table('wallpapers')->where('id',$id)->first();
        $wp_prev_name = $get_info->wallpaper_name;
        $wp_prev_image = $get_info->wallpaper_image;
        $wp_prev_thumb_image = $get_info->wallpaper_thumb;

        $wpName =  $request->input('wp_name');  
        $wpCat =  $request->input('wp_cat');  
        $wpType =  $request->input('wp_type');  
        $wpSubscription =  $request->input('wp_subscription');  
        $updated_thumb_img = $request->file('wp_thumb');
        $updated_img = $request->file('wp_img');

        $updated_thumb_img_name = '';
        $updated_img_name ='';
        $uid = uniqid();  

       
       if($wp_prev_name === $wpName){
       
       }else{
           $request->validate([
               'wp_name' => 'required|max:255',
               // 'cat_image' => 'required|mimes:jpeg,png,jpg,gif,svg',
           ]);
       
       }

               if($updated_thumb_img == '' && $updated_img == ''){
                $updated_thumb_img_name = $wp_prev_thumb_image;
                $updated_img_name =$wp_prev_image ;
               }
               
               else if ($updated_thumb_img == '' && $updated_img !== ''){

                       $updated_img_name = $uid.'.'.$updated_img->getClientOriginalExtension();
                       $updated_thumb_img_name = $wp_prev_thumb_image;

                      
                       if(file_exists('uploads/wallpapers/'.$wp_prev_image)){
                           @unlink('uploads/wallpapers/'.$wp_prev_image);
                           $updated_img->move('uploads/wallpapers',$updated_img_name);  
                       
                       }else{
      
                           session()->flash('error_messege', 'No file on that path.');
                           return redirect('/');
                       }
               }

               else if ($updated_thumb_img !== '' && $updated_img == ''){

                $updated_thumb_img_name = $uid.'.'.$updated_thumb_img->getClientOriginalExtension();
                $updated_img_name = $wp_prev_image;

                if(file_exists('uploads/thumbnails/'.$wp_prev_thumb_image)){
                    @unlink('uploads/thumbnails/'.$wp_prev_thumb_image);
                    $updated_thumb_img->move('uploads/thumbnails',$updated_thumb_img_name);  
                }else{
                    
                    session()->flash('error_messege', 'No file on that path.');   
                    return redirect('/');
                }

               }

               else if ($updated_thumb_img !== '' && $updated_img !== ''){


                $updated_img_name = $uid.'.'.$updated_img->getClientOriginalExtension();
                $updated_thumb_img_name = $uid.'.'.$updated_thumb_img->getClientOriginalExtension();

                if(file_exists('uploads/wallpapers/'.$wp_prev_image) && file_exists('uploads/thumbnails/'.$wp_prev_thumb_image)){
                    @unlink('uploads/wallpapers/'.$wp_prev_image);
                    @unlink('uploads/thumbnails/'.$wp_prev_thumb_image);

                    $updated_img->move('uploads/wallpapers',$updated_img_name);  
                    $updated_thumb_img->move('uploads/thumbnails',$updated_thumb_img_name);  

                
                }else{
                    session()->flash('error_messege', 'No file on that path.');   
                    return redirect('/');
                }

               } 

  
               DB::table('wallpapers')->where('id',$id)->update([
                'wallpaper_name' => $wpName,
                'wallpaper_cat' => $wpCat,
                'wallpaper_type' => $wpType,
                'wallpaper_subscription'=>$wpSubscription,
                'wallpaper_thumb'=>$updated_thumb_img_name,
                'wallpaper_image' =>$updated_img_name,
                'updated_at' =>Carbon::now()
                ]);
       
 
           session()->flash('message', 'Changes saved !');
           return redirect('/');
       
       }


    public function del_wp(Request $request)
{
    $id = $request->input('action');
    
    $this_row = DB::table('wallpapers')->where('id', $id)->first();
    $this_thumb_img_name = $this_row->wallpaper_thumb;
    $this_img_name = $this_row->wallpaper_image;

    DB::table('wallpapers')->where('id',$id)->delete();


    @unlink('uploads/thumbnails/'.$this_thumb_img_name);
    @unlink('uploads/wallpapers/'.$this_img_name);

    session()->flash('message', 'Wallpaper  deleted successfully !');
    return redirect('/')->with('message','Category deleted successfully.');
}
    
}
