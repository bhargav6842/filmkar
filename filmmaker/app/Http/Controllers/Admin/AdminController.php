<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\user_gallery;
use App\Models\user_category;
use App\Models\user_videos;
use App\Models\Admin\language;
use App\Models\Admin\city;
use App\Models\Admin\state;
use App\Models\Admin\Category;
use DateTime;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('admin');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('admin');
        }
    }

    public function dashboard()
    {

        $pendding_users = User::where('status','0')->count();
        $approved_users = User::where('status','1')->count();
        return view('admin.dashboard',compact('pendding_users','approved_users'));
    }

    public function create(){

        // $model = new Admin();
        // $model->email = "admin@admin.com";
        $model = Admin::find(1);
        $model->password = hash::make("admin");
        $model->save();
    }

    public function pending_users(){

        $result['pendding_users'] = User::where('status','0')->get();
        return view('admin.pending_users',$result);

    }

    public function approved_users(){

        $result['pendding_users'] = User::where('status','1')->get();
        return view('admin.approved_users',$result);

    }

    public function userstatus(Request $request,$status,$id){
        $model=User::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','status updated');

        if($status == 1){
            return redirect('admin/users/pending');
        }else{
        return redirect('admin/users/approved');
        }
    }

    public function isfeatured(Request $request,$isfeatured,$id){
        $model=User::find($id);
        $model->isfeatured=$isfeatured;
        $model->save();
        $request->session()->flash('message','status updated');
        return redirect('admin/users/approved');

    }

    public function userdetails(Request $request,$id){

        $result['category']=Category::where('parent_id',null)->get();

        $result['vendor'] = User::leftjoin('states', 'users.state_id', '=', 'states.id')
        ->leftjoin('cities', 'users.city_id', '=', 'cities.id')
        ->select('users.*','states.name as state','cities.city as city')
        ->where('users.id',$id)
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

        return view('admin/user_details',$result);

    }

}
