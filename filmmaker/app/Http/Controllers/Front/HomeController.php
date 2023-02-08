<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\blog;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\representer;
use App\Models\User;
use Session;
use App\Models\user_gallery;
use App\Models\user_category;
use App\Models\user_videos;
use DB;
use App\Models\user_social;
use DateTime;
class HomeController extends Controller
{
    public function index(){

        $result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::where('isfeatured', '1')->where('status', '1')->get();

        foreach($result['category'] as $list){

            $cat_id = $list->id;
            $temp['id'] = $list->id;
            $temp['category_name'] = $list->category_name;
            $temp['category_slug'] = $list->category_slug;
            $count = User::leftjoin('user_categories', 'users.id', '=', 'user_categories.user_id')
            ->leftjoin('categories', 'user_categories.cat_id', '=', 'categories.id')
            ->where('user_categories.cat_id',$cat_id)
            ->count();
            $temp['count'] = $count;
            $result['category_count'][] = $temp;
        }
        // return $result['category_count'][0]['id'];

        return view('front/home',$result);
    }

    public function register(){

        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        return view('front/register',$result);
    }

    public function register_organisation(){
        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();
        $result['representers']=representer::all();

        return view('front/register_organisation',$result);
    }

    public function contact(){

        $result['category']=Category::where('parent_id',null)->get();
        $result['language']=language::all();
        $result['state']=state::all();
        $result['city']=city::all();

        return view('front/contact',$result);
    }

    public function getcitybystate(Request $request, $id){

        $arr = city::where('state_id',$id)->get();
        
        foreach($arr as $list){
        echo "<option value=".$list->id.">$list->city</option>";
        }
    }

    public function getsubcat(Request $request){
        

        $id = $request->get('array');
        $subcatid = $request->get('subcatarray');

        $str_arr = preg_split ("/\,/", $id);
        $str_sub_arr = preg_split ("/\,/", $subcatid);
        $arr = Category::whereIn('parent_id',$str_arr)->get();

        // $arrselected = Category::whereIn('id',$subcatid)->get();

        // $arrayofsub = array();
        // foreach($arrselected as $list){

        //     array_push($arrayofsub,$list->id);
        // }
        // return $arrayofsub;

        
        foreach($arr as $list){
        // echo "<option value=".$list->id.">$list->category_name</option>";
        if(in_array($list->id, $str_sub_arr)){
            echo "<option value=".$list->id." selected>";
        }else{
            echo "<option value=".$list->id.">";
        }
        echo "$list->category_name</option>";

        }

    }

    public function getisattrcategory(Request $request){
        

        $id = $request->get('array');

        $category_ids = preg_split ("/\,/", $id);

        // return $category_ids;
        
        $is_attr_category = Category::select('id')->where('is_attr','1')->get();

        foreach($is_attr_category as $list){
            $isattrcategoryname[] = $list->id;
        }

        if( !empty(array_intersect($isattrcategoryname, $category_ids))){

            echo 1;
        }else{
            echo 0;
        }

    }

    public function details(Request $request,$slug){


        // $user = User::find(1);
        // return $user->categories;
        $result['category']=Category::where('parent_id',null)->get();

        $result['categorybyslug']=Category::where('parent_id',null)->where('category_slug',$slug)->first();
        $id = $result['categorybyslug']->id;

        $result['vendor'] = user_category::leftjoin('users', 'user_categories.user_id', '=', 'users.id')
        ->leftjoin('categories', 'user_categories.cat_id', '=', 'categories.id')
        ->select('users.*')
        ->where('user_categories.cat_id', $id)
        ->where('users.status', '1')
        ->get();

        $result['vendorcount'] = count($result['vendor']);


        return view('front/vendor',$result);


    }

    public function vendordetails(Request $request,$username){
        $result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::leftjoin('states', 'users.state_id', '=', 'states.id')
        ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
        ->select('users.*','states.name as state','cities.city as city')
        ->where('username',$username)
        ->where('users.status', '1')
        ->first();

        $result['galleryArr'] = user_gallery::where('user_id',$result['vendor']->id)->get();

        $bday = new DateTime($result['vendor']->birthdate); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
        $result['yearsold'] = $diff->y;

        // return $result['vendor'];
        
        foreach($result['vendor']->categories as $list){

            $result['categoryname'][] = $list->category_name;
        }
        $result['videosarr'] = user_videos::where('user_id',$result['vendor']->id)->get();
        $result['user_social'] = user_social::where('user_id',$result['vendor']->id)->first();

        // return $result['videosarr'];
        // substr($url, strrpos($url, '/') + 1);
        return view('front/vendordetails',$result);

    }

    public function blog(){

        $result['blog']=blog::all();
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/blog',$result);
    }

    public function blogdetails(Request $request,$slug){
        $result['category']=Category::where('parent_id',null)->get();

        $result['signleblog']=blog::where('slug',$slug)->first();

        return view('front/blogdetails',$result);


    }
        
}
