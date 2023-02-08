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
use App\Models\user_representer;
use DB;
use App\Models\user_social;
use DateTime;
use Illuminate\Support\Facades\Hash;

class OrganisationController extends Controller
{
    public function index(Request $request){

        $organisation_ID = Session::get('organisation_ID');
        $arr=user_representer::where(['id'=>$organisation_ID])->get(); 
        $result['profile']=$arr['0']->profile;
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/organize/dashboard',$result);

    }

    public function manage_profile(Request $request){

        $organisation_ID = Session::get('organisation_ID');
        $result['organize_user'] = user_representer::where(['id'=>$organisation_ID])->first(); 

        $result['representers'] = representer::all();

        $result['usercity']= city::join('user_representers', 'cities.id', '=', 'user_representers.city_id')
            ->select('cities.*')
            ->where('user_representers.id', $organisation_ID)
            ->first();
        $result['cityarr']= city::join('user_representers', 'cities.state_id', '=', 'user_representers.state_id')
            ->select('cities.*')
            ->where('user_representers.id', $organisation_ID)
            ->get();
        $result['state']=state::all();
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/organize/manage_profile',$result);

    }

    public function manage_profile_process(Request $request){


        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:user_representers,email,'.$request->post('id'),   
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

        $id = $request->post('id');
        $name = $request->post('name');
        $email = $request->post('email');
        $company = $request->post('company');
        $representer_id = $request->post('representer_id');
        $about_company = $request->post('about_company');
        $state_id = $request->post('state_id');
        $city_id = $request->post('city_id');
        $zipcode = $request->post('zipcode');
        $website = $request->post('website');
        $phone_no = $request->post('phone_no');
        $whatsapp_no = $request->post('whatsapp_no');


        $user_representer = user_representer::find($id);
        $user_representer->name = $name;
        $user_representer->email = $email;
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

        $request->session()->flash('message','Profile has been Updated!');
        return redirect('organize/manage_profile');

    }

    public function change_password(){
        
        $organisation_ID = Session::get('organisation_ID');

        $arr=User::where(['id'=>$organisation_ID])->get(); 
        $result['id']=$arr['0']->id;
        $result['category']=Category::where('parent_id',null)->get();

        return view('front/organize/change_password',$result);

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

        $result=user_representer::find($id);
        if($result){
            if(Hash::check($current_password,$result->password)){
                
                if($password != $c_password){

                    $request->session()->flash('error','Please enter correct Confirm password');
                    return redirect('organize/change_password');
                }else{
                    $user = user_representer::find($id);
                    $user->password = hash::make($password);
                    $user->save();
                    $request->session()->flash('message','Password has been Updated!');
                    return redirect('organize/change_password');
                }

            }else{
                $request->session()->flash('error','Current password does not match!');
                return redirect()->back();
            }
        }
        
    }
}
