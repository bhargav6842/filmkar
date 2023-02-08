<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\blog;
use DB, File;
class BlogController extends Controller
{
    public function index()
    {
        $result['data']=blog::all();
        return view('admin/blog',$result);
    }

    public function manage_blog(Request $request,$id='')
    {
        if($id>0){
            $arr=blog::where(['id'=>$id])->get(); 

            $result['title']=$arr['0']->title;
            $result['thumbnail']=$arr['0']->thumbnail;
            $result['slug']=$arr['0']->slug;
            $result['blog']=$arr['0']->blog;
            $result['id']=$arr['0']->id;
        }else{
            $result['title']='';
            $result['thumbnail']='';
            $result['slug']='';
            $result['blog']='';
            $result['id']=0;
            
        }
        return view('admin/manage_blog',$result);
    }

    public function manage_blog_process(Request $request)
    {
        //return $request->post();
        
        $request->validate([
            'title'=>'required',
            // 'thumbnail'=>'required',
            'slug'=>'required|unique:blogs,slug,'.$request->post('id'),
            'blog'=>'required',
        ]);

        if($request->post('id')>0){
            $model=blog::find($request->post('id'));
            $msg="blog updated";
        }else{
            $model=new blog();
            $msg="blog inserted";
        }

        if($request->hasfile('thumbnail')){

            if($request->post('id')>0){
                $arrImage=DB::table('blogs')->where('id',$request->post('id'))->get();
                $old_profile = 'assets/blog/' .$arrImage[0]->thumbnail;
                if(file_exists($old_profile)) {  
            
                    File::delete($old_profile);
                }
            }
            $file=$request->file('thumbnail');
            $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $upload_path = 'assets/blog/';
            $file->move($upload_path, $name);
            $model->thumbnail=$name == null ? $request->post('thumbnail') : $name;
        }
       
        $model->title=$request->post('title');
        $model->slug=strtolower(str_replace(' ', '-', $request->post('slug')));
        $model->blog=$request->post('blog');
        $model->status=0;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/blog');
        
    }

    public function delete(Request $request,$id){
        $model=blog::find($id);
        $model->delete();
        $request->session()->flash('message','blog deleted');
        return redirect('admin/blog');
    }

    public function status(Request $request,$status,$id){
        $model=blog::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','blog status updated');
        return redirect('admin/blog');
    }

    
}
