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
use App\Models\user_language;
use App\Models\user_representer;
use App\Models\user_attr;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function index(Request $request){
        $result['category']=Category::where('parent_id',null)->get();
        
        return view('front/login',$result);

    }
    public function user_register(Request $request){

        // return $request->post();
        
        $request->validate([
            'username'=>'required|unique:users',
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'c_password'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'gender'=>'required',
            'categories'=>'required',
            'language'=>'required',
            'birthdate'=>'required',
            'year_of_experience'=>'required',
            'about_you'=>'required',
        ]);

        $username = $request->post('username');
        $firstname = $request->post('firstname');
        $lastname = $request->post('lastname');
        $email = $request->post('email');
        $phonenumber = $request->post('phonenumber');
        $password = $request->post('password');
        $c_password = $request->post('c_password');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $gender = $request->post('gender');
        $categories = $request->post('categories');
        // $subcategory = $request->post('subcategory');
        $languages = $request->post('language');
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

        

        if($password != $c_password){

            $request->session()->flash('error','Please enter correct Confirm password');
            return redirect('register');
        }

        $user = new User;
        $user->username = strtolower($username);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phonenumber = $phonenumber;
        $user->password = hash::make($password);
        $user->state_id = $state_id;
        $user->city_id = $city_id;
        $user->gender = $gender;
        $user->birthdate = $birthdate;
        $user->year_of_experience = $year_of_experience;
        $user->about_you = $about_you;

        $user->save();

        if($eyecolor != '' && $haircolor != '' && $dresssize != '' && $shoesize != '' && $hairtype != '' 
        && $talent_height_in_CM != '' && $waist_in_CM != ''){

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

        foreach($languages as $list){
            $user_language = new user_language;
            $user_language->user_id = $user->id;
            $user_language->language_id = $list;
            $user_language->save();
        }

        foreach($categories as $list){
            $user_category = new user_category;
            $user_category->user_id = $user->id;
            $user_category->cat_id = $list;
            $user_category->save();
        }
        return redirect('/login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=User::where(['email'=>$email])->first();
        
        if($result){
            if($result->status == '0'){
                $request->session()->flash('error','Your account is unactive plz contact admin.');
                return redirect('/login');
            }
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('USER_ID',$result->id);
                $request->session()->put('USER_NAME',$result->username);
                return redirect('/');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/login');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/login');
        }
    }

    public function organisation_user_auth(Request $request){

        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=user_representer::where(['email'=>$email])->first();
        
        if($result){
            if($result->status == '0'){
                $request->session()->flash('error','Your account is unactive plz contact admin.');
                return redirect('/login');
            }
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('organisation_ID',$result->id);
                $request->session()->put('organisation_NAME',$result->name);
                return redirect('/');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/login');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/login');
        }
    }

    public function organisation_register(Request $request){

        // return $request->post();

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:user_representers',
            'password'=>'required',
            'cpassword'=>'required',
            'company'=>'required',
            'representer_id'=>'required',
            'about_company'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'zipcode'=>'required',
            'website'=>'required',
            'phone_no'=>'required',
            'whatsapp_no'=>'required'
        ]);

        $name = $request->post('name');
        $email = $request->post('email');
        $password = $request->post('password');
        $cpassword = $request->post('cpassword');
        $company = $request->post('company');
        $representer_id = $request->post('representer_id');
        $about_company = $request->post('about_company');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $zipcode = $request->post('zipcode');
        $website = $request->post('website');
        $phone_no = $request->post('phone_no');
        $whatsapp_no = $request->post('whatsapp_no');

        if($password != $cpassword){
            $request->session()->flash('error','Please enter valid password!');
            return redirect()->back();
        }

        $user_representer = new user_representer;
        $user_representer->name = $name;
        $user_representer->email = $email;
        $user_representer->password = hash::make($password);
        $user_representer->company = $company;
        $user_representer->representer_id = $representer_id;
        $user_representer->about_company = $about_company;
        $user_representer->state_id = $state_id;
        $user_representer->city_id = $city_id;
        $user_representer->zipcode = $zipcode;
        $user_representer->website = $website;
        $user_representer->phone_no = $phone_no;
        $user_representer->whatsapp_no = $whatsapp_no;
        $user_representer->save();

        $request->session()->flash('message','Register Succsess!');
        return redirect('/login');
    }
}
