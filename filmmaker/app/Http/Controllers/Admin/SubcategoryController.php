<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use DB;

class SubcategoryController extends Controller
{
    public function index()
    {
        $result['data'] = Subcategory::join('categories', 'subcategories.cat_id', '=', 'categories.id')
        ->select('subcategories.*', 'categories.category_name')
        ->get();
        return view('admin/subcategory',$result);
    }

    public function manage_subcategory(Request $request,$id='')
    {
        if($id>0){
            $arr=Subcategory::where(['id'=>$id])->get(); 

            $result['cat_id']=$arr['0']->cat_id;
            $result['subcategory_name']=$arr['0']->subcategory_name;
            $result['subcategory_slug']=$arr['0']->subcategory_slug;
            $result['id']=$arr['0']->id;
        }else{
            $result['cat_id']='';
            $result['subcategory_name']='';
            $result['subcategory_slug']='';
            $result['id']=0;            
        }

        $result['category']=DB::table('categories')->where(['status'=>1])->get();

        return view('admin/manage_subcategory',$result);
    }

    public function manage_subcategory_process(Request $request)
    {
        // return $request->post();
        
        $request->validate([
            'cat_id'=>'required',
            'subcategory_name'=>'required',
            'subcategory_slug'=>'required|unique:subcategories,subcategory_slug,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=Subcategory::find($request->post('id'));
            $msg="Subcategory updated";
        }else{
            $model=new Subcategory();
            $msg="Subcategory inserted";
        }

        $model->cat_id=$request->post('cat_id');
        $model->subcategory_name=$request->post('subcategory_name');
        $model->subcategory_slug=strtolower(str_replace(' ', '-', $request->post('subcategory_slug')));
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/subcategory');
        
    }

    public function delete(Request $request,$id){
        $model=Subcategory::find($id);
        $model->delete();
        $request->session()->flash('message','Subcategory deleted');
        return redirect('admin/subcategory');
    }

    public function status(Request $request,$status,$id){
        $model=Subcategory::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Subcategory status updated');
        return redirect('admin/subcategory');
    }
}
