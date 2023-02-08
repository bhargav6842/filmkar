<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        $result['data']=Category::where('parent_id',null)->get();
        $result['is_attr'] = 'yes';
        return view('admin/category',$result);
    }

    public function subcat_index()
    {
        $result['data']=Category::where('parent_id','!=',null)->get();
        $result['is_attr'] = 'no';
        return view('admin/category',$result);
    }

    
    public function manage_category(Request $request,$id='')
    {
        if($id>0){
            $arr=Category::where(['id'=>$id])->get(); 

            $result['category_name']=$arr['0']->category_name;
            $result['category_slug']=$arr['0']->category_slug;
            $result['parent_id']=$arr['0']->parent_id;
            $result['id']=$arr['0']->id;

            // $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['parent_id']='';
            $result['id']=0;

            // $result['category']=DB::table('categories')->where(['status'=>1])->get();
            
        }
        $result['category']=DB::table('categories')->where(['status'=>1])->get();

        return view('admin/manage_category',$result);
    }

    public function manage_category_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),   
        ]);

        if($request->post('id')>0){
            $model=Category::find($request->post('id'));
            $msg="Category updated";
        }else{
            $model=new Category();
            $msg="Category inserted";
        }

        $model->category_name=$request->post('category_name');
        $model->category_slug=strtolower(str_replace(' ', '-', $request->post('category_slug')));
        $model->parent_id=$request->post('parent_id');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/category');
        // return Redirect::to($request->request->get('http_referrer'));
        
    }

    public function delete(Request $request,$id){
        $model=Category::find($id);
        $model->delete();
        $request->session()->flash('message','Category deleted');
        return redirect('admin/category');
    }

    public function status(Request $request,$status,$id){
        $model=Category::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Category status updated');
        return redirect('admin/category');
    }

    public function is_attr(Request $request,$is_attr,$id){
        $model=Category::find($id);
        $model->is_attr=$is_attr;
        $model->save();
        $request->session()->flash('message','Category is_attr On');
        return redirect('admin/category');
    }

    
}
