<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\representer;

class RepresenterController extends Controller
{
    public function index()
    {
        $result['data']=representer::all();
        return view('admin/representer',$result);
    }

    public function manage_representer(Request $request,$id='')
    {
        if($id>0){
            $arr=representer::where(['id'=>$id])->get(); 

            $result['representers']=$arr['0']->representers;
            $result['id']=$arr['0']->id;
        }else{
            $result['representers']='';
            $result['id']=0;
            
        }
        return view('admin/manage_representer',$result);
    }

    public function manage_representer_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'representers'=>'required'
        ]);

        if($request->post('id')>0){
            $model=representer::find($request->post('id'));
            $msg="representer updated";
        }else{
            $model=new representer();
            $msg="representer inserted";
        }
       
        $model->representers=$request->post('representers');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/representer');
        
    }

    public function delete(Request $request,$id){
        $model=representer::find($id);
        $model->delete();
        $request->session()->flash('message','representer deleted');
        return redirect('admin/representer');
    }

    public function status(Request $request,$status,$id){
        $model=representer::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','representer status updated');
        return redirect('admin/representer');
    }
}
