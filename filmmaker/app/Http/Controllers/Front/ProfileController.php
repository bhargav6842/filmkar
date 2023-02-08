<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\User;
use App\Models\user_category;
use App\Models\user_attr;
use App\Models\user_language;
use Session, DB;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\user_videos;
use App\Models\user_gallery;
use App\Models\user_social;
class ProfileController extends Controller
{
    public function index(Request $request){

        $id = Session::get('USER_ID');
        $arr=User::where(['id'=>$id])->get(); 
        $result['profile']=$arr['0']->profile;
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/user/dashboard',$result);

    }

    public function manage_profile(Request $request){

        $id = Session::get('USER_ID');

        if($id>0){
            $arr=User::where(['id'=>$id])->get(); 
            $result['lanarr']= user_language::join('languages', 'user_languages.language_id', '=', 'languages.id')
            ->select('user_languages.*', 'languages.language')
            ->where('user_languages.user_id', $id)
            ->get();
            $result['catarr']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id', null)
            ->get();

            $result['subcatarr']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id','!=', null)
            ->get();
            
            $result['usersubcat']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->where('categories.parent_id','!=', null)
            ->get();

            $result['usercity']= city::join('users', 'cities.id', '=', 'users.city_id')
            ->select('cities.*')
            ->where('users.id', $id)
            ->first();
            $result['cityarr']= city::join('users', 'cities.state_id', '=', 'users.state_id')
            ->select('cities.*')
            ->where('users.id', $id)
            ->get();

            $result['userattrarr']= user_attr::join('users', 'user_attrs.user_id', '=', 'users.id')
            ->select('user_attrs.*')
            ->where('users.id', $id)
            ->first();

            if($result['userattrarr'] != ""){

                $result['attr_id'] = $result['userattrarr']->id;
                $result['eyecolor'] = $result['userattrarr']->eyecolor;
                $result['haircolor'] = $result['userattrarr']->haircolor;
                $result['dresssize'] = $result['userattrarr']->dresssize;
                $result['shoesize'] = $result['userattrarr']->shoesize;
                $result['hairtype'] = $result['userattrarr']->hairtype;
                $result['talent_height_in_CM'] = $result['userattrarr']->talent_height_in_CM;
                $result['waist_in_CM'] = $result['userattrarr']->waist_in_CM;
                $result['dnone'] = '';
            }else{
                $result['attr_id'] = '';
                $result['eyecolor'] = '';
                $result['haircolor'] = '';
                $result['dresssize'] = '';
                $result['shoesize'] = '';
                $result['hairtype'] = '';
                $result['talent_height_in_CM'] = '';
                $result['waist_in_CM'] = '';
                $result['dnone'] = 'd-none';
            }


            $result['username']=$arr['0']->username;
            $result['firstname']=$arr['0']->firstname;
            $result['lastname']=$arr['0']->lastname;
            $result['email']=$arr['0']->email;
            $result['phonenumber']=$arr['0']->phonenumber;
            $result['profile']=$arr['0']->profile;
            $result['gender']=$arr['0']->gender;
            $result['state_id']=$arr['0']->state_id;
            $result['city_id']=$arr['0']->city_id;
            $result['birthdate']=$arr['0']->birthdate;
            $result['year_of_experience']=$arr['0']->year_of_experience;
            $result['about_you']=$arr['0']->about_you;
            $result['id']=$arr['0']->id;


            $result['catarrselected']= user_category::join('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('user_categories.user_id', $id)
            ->get();

            $catarrselected = array();
            foreach($result['catarrselected'] as $onecat){
                array_push($catarrselected,$onecat->id);
            }
            $result['catarrselected']=$catarrselected;
           
            $lanarrselected = array();
            foreach($result['lanarr'] as $onelan){
                array_push($lanarrselected,$onelan->language_id);
            }
            $result['lanarrselected']=$lanarrselected;
            $result['subcatselected']=Category::whereIn('parent_id',$catarrselected)->where('parent_id','!=',null)->get();

        }else{
            $result['username']='';
            $result['firstname']='';
            $result['lastname']='';
            $result['email']='';
            $result['phonenumber']='';
            $result['gender']='';
            $result['state_id']='';
            $result['city_id']='';
            $result['birthdate']='';
            $result['year_of_experience']='';
            $result['about_you']='';
            $result['id']=0;

            // $result['category']=DB::table('categories')->where(['status'=>1])->get();
            
        }
        $result['category']=Category::where('parent_id',null)->get();
        $result['subcategory']=Category::where('parent_id','!=',null)->get();
        $result['languages']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        return view('front/user/manage_profile',$result);

    }

    public function manage_profile_process(Request $request){

        // return $request->post();
        $request->validate([
            'username'=>'required|unique:users,username,'.$request->post('id'),
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users,email,'.$request->post('id'),
            'phonenumber'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'gender'=>'required',
            // 'languages'=>'required',
            'birthdate'=>'required',
            'year_of_experience'=>'required',
            'about_you'=>'required',
        ]);

        $id = $request->post('id');
        $username = $request->post('username');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $phonenumber = $request->post('phonenumber');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $gender = $request->post('gender');
        $categories = $request->post('categories');
        // return $categories;
        if($categories ==  null){
            $request->session()->flash('error','You need to atleast choose one category!');
            return redirect('user/manage_profile');
        }
        $languages = $request->post('language');
        if($languages ==  null){
            $request->session()->flash('error','You need to atleast choose one language!');
            return redirect('user/manage_profile');
        }
        // return $categories;
        $birthdate = $request->post('birthdate');
        $year_of_experience = $request->post('year_of_experience');
        $about_you = $request->post('about_you');

        $eyecolor = $request->post('eyecolor');
        $haircolor = $request->post('haircolor');
        $dresssize = $request->post('dresssize');
        $shoesize = $request->post('shoesize');
        $hairtype = $request->post('hairtype');
        $talent_height_in_CM = $request->post('talent_height_in_CM');
        $waist_in_CM = $request->post('waist_in_CM');
        $attr_id = $request->post('attr_id');
        // return $attr_id;

        $user = User::find($id);

        if($request->hasfile('profile')){

            if($request->post('id')>0){
                $arrImage=DB::table('users')->where('id',$id)->get();
                $old_profile = 'assets/profile/' .$arrImage[0]->profile;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }

            $file=$request->file('profile');
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $upload_path = 'assets/profile/';
            $file->move($upload_path, $name);
            $user->profile=$name == null ? $request->post('profile') : $name;
        }


        $user->username = strtolower($username);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phonenumber = $phonenumber;
        $user->password = $user->password;
        $user->state_id = $state_id;
        $user->city_id = $city_id;
        $user->gender = $gender;
        $user->birthdate = $birthdate;
        $user->year_of_experience = $year_of_experience;
        $user->about_you = $about_you;
        $user->save();

        if($eyecolor != '' && $haircolor != '' && $dresssize != '' && $shoesize != '' && $hairtype != '' 
        && $talent_height_in_CM != '' && $waist_in_CM != ''){

            if($attr_id != ""){
                $user_attr = user_attr::find($attr_id);
                $user_attr->user_id = $user->id;
                $user_attr->eyecolor = $eyecolor;
                $user_attr->haircolor = $haircolor;
                $user_attr->dresssize = $dresssize;
                $user_attr->shoesize = $shoesize;
                $user_attr->hairtype = $hairtype;
                $user_attr->talent_height_in_CM = $talent_height_in_CM;
                $user_attr->waist_in_CM = $waist_in_CM;
                $user_attr->save();
            }else{
                $user_attr = new user_attr;
                $user_attr->user_id = $user->id;
                $user_attr->eyecolor = $eyecolor;
                $user_attr->haircolor = $haircolor;
                $user_attr->dresssize = $dresssize;
                $user_attr->shoesize = $shoesize;
                $user_attr->hairtype = $hairtype;
                $user_attr->talent_height_in_CM = $talent_height_in_CM;
                $user_attr->waist_in_CM = $waist_in_CM;
                $user_attr->save();
            }
        }

        $user_category = user_language::where('user_id',$id)->wherenotin('language_id',$languages)->delete();
    
        foreach($languages as $list){
            $user_language = user_language::where('user_id',$id)->where('language_id',$list)->first();

            if(!$user_category){
                $user_language = new user_language;
                $user_language->user_id = $id;
                $user_language->language_id = $list;
                $user_language->save();
            }
            else{
                $user_language->user_id = $id;
                $user_language->language_id = $list;
                $user_language->save();
            }
        }

        $user_category = user_category::where('user_id',$id)->wherenotin('cat_id',$categories)->delete();


        foreach($categories as $list){
            $user_category = user_category::where('user_id',$id)->where('cat_id',$list)->first();

            $is_attr_category = Category::where('is_attr','1')->first();
            // return $is_attr_category->category_name;
            $isattrcategoryname[] = $is_attr_category->id;


            $category_name = Category::where('id',$list)->first();

            $categoryname[] = $category_name->id;


            if(!$user_category){
                $user_category = new user_category;
                $user_category->user_id = $id;
                $user_category->cat_id = $list;
                $user_category->save();
            }
            else{
                $user_category->user_id = $id;
                $user_category->cat_id = $list;
                $user_category->save();
            }
            
        }
        // return $categoryname;


        if( !empty(array_intersect($isattrcategoryname, $categoryname))){

            // user_attr::where('user_id',$id)->delete();
        }else{
            user_attr::where('user_id',$id)->delete();
        }

        $request->session()->flash('message','Profile has been Updated!');
        return redirect('user/manage_profile');

    }

    public function change_password(){
        
        $id = Session::get('USER_ID');
        $arr=User::where(['id'=>$id])->get(); 
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/user/change_password',$result);

    }

    public function change_password_process(Request $request){

        $request->validate([
            'current_password'=>'required',
            'password'=>'required',
            'c_password'=>'required',
        ]);

        $id = $request->post('id');
        $current_password = $request->post('current_password');
        $password = $request->post('password');
        $c_password = $request->post('c_password');

        $result=User::find($id);
        if($result){
            if(Hash::check($current_password,$result->password)){
                
                if($password != $c_password){

                    $request->session()->flash('error','Please enter correct Confirm password');
                    return redirect('user/change_password');
                }else{
                    $user = User::find($id);
                    $user->password = hash::make($password);
                    $user->save();
                    $request->session()->flash('message','Password has been Updated!');
                    return redirect('user/change_password');
                }

            }else{
                $request->session()->flash('error','Current password does not match!');
                return redirect()->back();
            }
        }
        
    }

    public function manage_videos(Request $request,$id=''){
        $id = Session::get('USER_ID');
        $arr=User::where(['id'=>$id])->get(); 
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['category']=Category::where('parent_id',null)->get();

        $result['videosArr'] = user_videos::where('user_id',$id)->get();

        // return $result['videosArr'];

        return view('front/user/manage_videos',$result);

    }

    public function manage_videos_process(Request $request){

        $ids = $request->post('id');
        $videoarr = $request->post('video_link');
        // $user_id = Session::get('USER_ID');

        $request->validate([
            'video_link'=>'required',
        ]);
        
        foreach($videoarr as $key => $video){
            
            $str = $video;
            $pattern = '/^(https?:\/\/)?(www\.youtube\.com\/watch\?v=|youtu.be\/)(?P<id>[0-9a-z-_?=]+)(?P<list>[&?]list=[0-9a-z-_]*)*/i';
            if(preg_match($pattern, $str)){

                if(isset($ids[$key])){
                    $model=user_videos::find($ids[$key]);
                    $model->video_link=$video;
                    $model->save();
                }
                else{
                    $model=new user_videos();
                    $model->user_id=Session::get('USER_ID');
                    $model->video_link=$video;
                    $model->save();
                }
            }else{
                $request->session()->flash('error','Please enter a youtube link!');
                return redirect('user/manage_videos');
            }
            

        }

        // foreach($video_link as $video){
        //     $model=new user_videos();
        //     $model->user_id=Session::get('USER_ID');
        //     $model->video_link=$video;
        //     $model->save();
        // }
        
        $request->session()->flash('message','Profile has been Updated!');
        return redirect('user/manage_videos');

    }

    public function manage_video_delete(Request $request, $id){

        $user_id = Session::get('USER_ID');
        
        $query = user_videos::where('id',$id)->where('user_id',$user_id)->delete();

        return redirect('user/manage_videos');
    }

    public function manage_gallery(Request $request){

        $id = Session::get('USER_ID');
        $arr=User::where(['id'=>$id])->get(); 
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['username']=$arr['0']->username;
        $result['category']=Category::where('parent_id',null)->get();
        
        $result['galleryArr'] = user_gallery::where('user_id',$id)->get();

        return view('front/user/manage_gallery',$result);
    }

    public function manage_gallery_process(Request $request){


        $user_id = Session::get('USER_ID');
        // return $request->post();
        $arr=User::where(['id'=>$user_id])->first(); 


        $files = "";
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {

                $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $upload_path = 'assets/gallery/'.$arr->username.'/';
                $file->move($upload_path, $name);

                $user_gallery = new user_gallery;
                $user_gallery->user_id =  $user_id;
                $user_gallery->image = $name;
                $user_gallery->save();
            }
        }
        $request->session()->flash('message','Profile has been Updated!');
        return redirect('user/manage_gallery');
    }

    public function manage_gallery_delete(Request $request, $id){
        
        $user_id = Session::get('USER_ID');

        $query = user_gallery::where('id',$id)->where('user_id',$user_id)->delete();
        if($query == 1){
            $request->session()->flash('message','Photo Deleted!');
        }else{
            $request->session()->flash('error','something went wrong!');
        }
        return redirect('user/manage_gallery');
    }

    public function manage_socialmedia(Request $request,$user_id=''){

        $id = Session::get('USER_ID');
        $arr=User::where(['id'=>$id])->get();
        $result['id']=$arr['0']->id;
        $result['profile']=$arr['0']->profile;
        $result['username']=$arr['0']->username;
        $result['category']=Category::where('parent_id',null)->get();
        $result['social']=user_social::where('user_id',$id)->first();

        // if($user_id>0){
        //     $arr=user_social::where(['user_id'=>$user_id])->first(); 

        //     $result['facebook']=$arr->facebook;
        //     $result['instagram']=$arr->instagram;
        //     $result['linkdin']=$arr->linkdin;
        //     $result['twitter']=$arr->twitter;
        //     $result['user_id']=$arr->id;
        // }else{
        //     $result['facebook']='';
        //     $result['instagram']='';
        //     $result['linkdin']='';
        //     $result['twitter']='';
        //     $result['user_id']=0;
            
        // }

        return view('front/user/manage_socialmedia',$result);
    }

    public function manage_socialmedia_process(Request $request){


        // return $request->post();

        $user_id = Session::get('USER_ID');
        
        if($request->post('user_id')>0){
            $user_social=user_social::where(['user_id'=>$user_id])->first();
        }else{
            $user_social=new user_social();
        }

        $user_social->user_id = $user_id;
        $user_social->facebook = $request->post('facebook');
        $user_social->instagram = $request->post('instagram');
        $user_social->linkedin = $request->post('linkedin');
        $user_social->twitter = $request->post('twitter');
        $user_social->save();
        $request->session()->flash('message','Social Media has been Updated!');
        return redirect('user/manage_socialmedia');
    }
}
