<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\language;

class LanguageController extends Controller
{
    public function index()
    {
        $result['data']=language::all();
        return view('admin/language',$result);
    }

    public function manage_language(Request $request,$id='')
    {
        if($id>0){
            $arr=language::where(['id'=>$id])->get(); 

            $result['language']=$arr['0']->language;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }else{
            $result['language']='';
            $result['status']='';
            $result['id']=0;
            
        }
        return view('admin/manage_language',$result);
    }

    public function manage_language_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'language'=>'required'
        ]);

        if($request->post('id')>0){
            $model=language::find($request->post('id'));
            $msg="language updated";
        }else{
            $model=new language();
            $msg="language inserted";
        }
       
        $model->language=$request->post('language');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/language');
        
    }

    public function delete(Request $request,$id){
        $model=language::find($id);
        $model->delete();
        $request->session()->flash('message','language deleted');
        return redirect('admin/language');
    }

    public function status(Request $request,$status,$id){
        $model=language::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','language status updated');
        return redirect('admin/language');
    }
}
