<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\RepresenterController;
// use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\OrganisationController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('create',[AdminController::class,'create']);
Route::get('admin',[AdminController::class,'index']);
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){
Route::get('admin/dashboard',[AdminController::class,'dashboard']);
// language
Route::get('admin/language',[LanguageController::class,'index']);
Route::get('admin/language/manage_language',[LanguageController::class,'manage_language']);
Route::get('admin/language/manage_language/{id}',[LanguageController::class,'manage_language']);
Route::post('admin/language/manage_language_process',[LanguageController::class,'manage_language_process'])->name('language.manage_language_process');
Route::get('admin/language/delete/{id}',[LanguageController::class,'delete']);
Route::get('admin/language/status/{status}/{id}',[LanguageController::class,'status']);
// language

// category
Route::get('admin/category',[CategoryController::class,'index']);
Route::get('admin/subcategory',[CategoryController::class,'subcat_index']);
Route::get('admin/category/manage_category',[CategoryController::class,'manage_category']);
Route::get('admin/category/manage_category/{id}',[CategoryController::class,'manage_category']);
Route::post('admin/category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('category.manage_category_process');
Route::get('admin/category/delete/{id}',[CategoryController::class,'delete']);
Route::get('admin/category/status/{status}/{id}',[CategoryController::class,'status']);
Route::get('admin/category/is_attr/{is_attr}/{id}',[CategoryController::class,'is_attr']);
// category

// blog
Route::get('admin/blog',[BlogController::class,'index']);
Route::get('admin/blog/manage_blog',[BlogController::class,'manage_blog']);
Route::get('admin/blog/manage_blog/{id}',[BlogController::class,'manage_blog']);
Route::post('admin/blog/manage_blog_process',[BlogController::class,'manage_blog_process'])->name('blog.manage_blog_process');
Route::get('admin/blog/delete/{id}',[BlogController::class,'delete']);
Route::get('admin/blog/status/{status}/{id}',[BlogController::class,'status']);
// blog

// blog
Route::get('admin/representer',[RepresenterController::class,'index']);
Route::get('admin/representer/manage_representer',[RepresenterController::class,'manage_representer']);
Route::get('admin/representer/manage_representer/{id}',[RepresenterController::class,'manage_representer']);
Route::post('admin/representer/manage_representer_process',[RepresenterController::class,'manage_representer_process'])->name('representer.manage_representer_process');
Route::get('admin/representer/delete/{id}',[RepresenterController::class,'delete']);
Route::get('admin/representer/status/{status}/{id}',[RepresenterController::class,'status']);
// blog

// pending
Route::get('admin/users/pending',[AdminController::class,'pending_users'])->name('users.pending');
Route::get('admin/users/status/{status}/{id}',[AdminController::class,'userstatus']);
Route::get('admin/users/details/{id}',[AdminController::class,'userdetails']);
// pending

// approved
Route::get('admin/users/approved',[AdminController::class,'approved_users'])->name('users.approved');
Route::get('admin/users/isfeatured/{isfeatured}/{id}',[AdminController::class,'isfeatured'])->name('users.isfeatured');
// approved

Route::get('admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error','Logout sucessfully');
    return redirect('admin');
});
});
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/category/{slug}',[HomeController::class,'details'])->name('details');
Route::get('/blog',[HomeController::class,'blog'])->name('blog');
Route::get('/blog/{slug}',[HomeController::class,'blogdetails']);

Route::get('/blog/details/{slug}',[HomeController::class,'blogdetails'])->name('blog.blogdetails');
Route::get('/vendor/details/{username}',[HomeController::class,'vendordetails'])->name('user.vendordetails');
Route::get('register',[HomeController::class,'register'])->name('user.register');
Route::get('register-organisation',[HomeController::class,'register_organisation'])->name('user.register.organisation');
Route::get('/getcitybystate/{id}', [HomeController::class,'getcitybystate']);
Route::get('/getsubcat', [HomeController::class,'getsubcat']);
Route::get('/getisattrcategory', [HomeController::class,'getisattrcategory']);
Route::post('user_register',[UserController::class,'user_register'])->name('user.user_register');
Route::get('login',[UserController::class,'index'])->name('user.login');
Route::post('user/auth',[UserController::class,'auth'])->name('user.auth');
Route::post('organisation_user/auth',[UserController::class,'organisation_user_auth'])->name('organisation_user.auth');
Route::post('organisation_user/register',[UserController::class,'organisation_register'])->name('organisation.register');
Route::get('/logout', function () {
    session()->forget('USER_ID');
    session()->forget('USER_NAME');
    session()->forget('organisation_ID');
    session()->forget('organisation_NAME');
    session()->flash('error','Logout sucessfully');
    return redirect('login');
})->name('user.logout');
Route::group(['middleware'=>'user_auth'],function(){

Route::get('user/dashboard',[ProfileController::class,'index'])->name('user.dashboard');
Route::get('user/manage_profile',[ProfileController::class,'manage_profile'])->name('user.manage_profile');
Route::post('user/manage_profile_process',[ProfileController::class,'manage_profile_process'])->name('user.manage_profile_process');

Route::get('user/manage_videos',[ProfileController::class,'manage_videos'])->name('user.videos');
Route::post('user/manage_videos_process',[ProfileController::class,'manage_videos_process'])->name('user.manage_videos_process');

Route::post('user/manage_gallery_process',[ProfileController::class,'manage_gallery_process'])->name('user.manage_gallery_process');
Route::get('user/manage_gallery',[ProfileController::class,'manage_gallery'])->name('user.gallery');

Route::get('user/manage_socialmedia',[ProfileController::class,'manage_socialmedia'])->name('user.socialmedia');
// Route::get('user/manage_socialmedia/{user_id}',[ProfileController::class,'manage_socialmedia']);
Route::post('user/manage_socialmedia_process',[ProfileController::class,'manage_socialmedia_process'])->name('user.manage_socialmedia_process');

Route::get('user/delete/video/{id}',[ProfileController::class,'manage_video_delete']);
Route::get('user/gallery/delete/{id}',[ProfileController::class,'manage_gallery_delete']);
Route::get('user/change_password',[ProfileController::class,'change_password'])->name('user.change_password');
Route::post('user/change_password_process',[ProfileController::class,'change_password_process'])->name('user.change_password_process');
});

Route::group(['middleware'=>'OrganisationUserAuth'],function(){

Route::get('organize/dashboard',[OrganisationController::class,'index'])->name('organize.dashboard');
Route::get('organize/manage_profile',[OrganisationController::class,'manage_profile'])->name('organize.manage_profile');
Route::post('organize/manage_profile_process',[OrganisationController::class,'manage_profile_process'])->name('organize.manage_profile_process');
Route::get('organize/change_password',[OrganisationController::class,'change_password'])->name('organize.change_password');
Route::post('organize/change_password_process',[OrganisationController::class,'change_password_process'])->name('organize.change_password_process');

});

