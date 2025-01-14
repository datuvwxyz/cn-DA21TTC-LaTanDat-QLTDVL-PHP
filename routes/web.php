<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\FreelancerController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/introduce', [HomeController::class, 'introduce'])->name('introduce');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/send-contact', [HomeController::class, 'sendContact'])->name('sendContact');
Route::get('/jobs', [PostJobController::class, 'index'])->name('jobs');
//===============================ADMIN================================//
Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
Route::get('admin/home', [AdminController::class, 'home'])->name('admin_home');
Route::get('/admin/employer_index', [AdminController::class, 'listEmployers'])->name('admin_employer_index');
Route::get('/admin/freelancer_index', [AdminController::class, 'listFreelancers'])->name('admin_freelancer_index');
Route::get('/admin/post_list', [AdminController::class, 'jobsListed'])->name('admin_post_list');
Route::get('/admin/post_detail/{post_id}', [AdminController::class, 'jobDetail'])->name('admin_post_detail');
Route::post('/admin/approve_post/{post_id}', [AdminController::class, 'approvePosts'])->name('admin_approve_post');
Route::post('/admin/rejecte-post/{post_id}', [AdminController::class, 'rejectePosts'])->name('admin_rejecte_post');
Route::get('create_category', function () {
    return view('admin.pages.category.create_category');
})->name('create_category');
Route::get('edit_freelancer', function () {
    return view('admin.pages.freelancer.edit_freelancer');
})->name('edit_freelancer');
Route::get('/admin/detail_freelancer/{freelancer_id}', [AdminController::class, 'detailFreelancers'])->name('admin_detail_freelancer');
Route::get('create_employer', function () {
    return view('admin.pages.employer.create_employer');
})->name('create_employer');
Route::get('edit_employer', function () {
    return view('admin.pages.employer.edit_employer');
})->name('edit_employer');
Route::get('/admin/detail_employer/{employer_id}', [AdminController::class, 'detailEmployers'])->name('admin_detail_employer');
//===============================ACCOUNTS=============================//
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/post/login', [AccountController::class, 'post_login'])->name('post_login');;
Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/post/register', [AccountController::class, 'post_register'])->name('post_register');
Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
//===============================CATEGORY=============================//
Route::get('/category_index', [CategoryController::class, 'index'])->name('category_index');
Route::post('/add_category', [CategoryController::class, 'add'])->name('add_category');
Route::get('/edit_category/{category_id}', [CategoryController::class, 'edit'])->name('edit_category');
Route::post('/update_category/{category_id}', [CategoryController::class, 'update'])->name('update_category');
Route::get('/delete_category/{category_id}', [CategoryController::class, 'delete'])->name('delete_category');
//===============================SKILL=============================//
Route::get('/skill_index', [SkillController::class, 'index'])->name('skill_index');
Route::get('/create_skill', [SkillController::class, 'create'])->name('create_skill');
Route::post('/add_skill', [SkillController::class, 'add'])->name('add_skill');
Route::get('/edit_skill/{skill_id}', [SkillController::class, 'edit'])->name('edit_skill');
Route::post('/update_skill/{skill_id}', [SkillController::class, 'update'])->name('update_skill');
Route::get('/delete_skill/{skill_id}', [SkillController::class, 'delete'])->name('delete_skill');
//===============================FREELANCER=============================//
Route::get('/freelancer_setting', [FreelancerController::class, 'showProfileFreelancer'])->name('freelancer_setting');
Route::get('/edit_freelancer_setting', [FreelancerController::class, 'editProfileFreelancer'])->name('edit_freelancer_setting');
Route::post('/update_profile_freelancer', [FreelancerController::class, 'updateProfileFreelancer'])->name('update_profile_freelancer');
Route::post('/update_image_freelancer', [FreelancerController::class, 'updateImageProfile'])->name('update_image_freelancer');
//===============================EMPLOYER=============================//
Route::get('/employer_setting', [EmployerController::class, 'showProfileEmployer'])->name('employer_setting');
Route::get('/edit_employer_setting', [EmployerController::class, 'editProfileEmployer'])->name('edit_employer_setting');
Route::post('/update_profile_employer', [EmployerController::class, 'updateProfileEmployer'])->name('update_profile_employer');
Route::post('/update_image_employer', [EmployerController::class, 'updateImageProfile'])->name('update_image_employer');
//===============================JOBS=============================//
Route::get('/job_index', [PostJobController::class, 'index'])->name('job_index');
Route::get('/post_job', [PostJobController::class, 'createJob'])->name('post_job');
Route::post('/add_new_post', [PostJobController::class, 'AddNewJob'])->name('add_new_post');
Route::get('/edit_post/{post_id}', [PostJobController::class, 'editJob'])->name('edit_post');
Route::post('/update_post/{post_id}', [PostJobController::class, 'updateJob'])->name('update_post');
Route::post('/updateImage_post/{post_id}', [PostJobController::class, 'updateImageJob'])->name('updateImage_post');
Route::get('/delete_post/{post_id}', [PostJobController::class, 'deleteJob'])->name('delete_post');
Route::get('/post_listed', [PostJobController::class, 'jobsListed'])->name('post_listed');
Route::get('/post_detail/{post_id}', [PostJobController::class, 'jobDetail'])->name('post_detail');
Route::get('/detail_jobs_apply/{post_id}', [PostJobController::class, 'detailapplyJob'])->name('detail_jobs_apply');
Route::post('/jobs_apply/{post_id}', [PostJobController::class, 'applyJob'])->name('jobs_apply');
Route::get('/jobs_submited', [PostJobController::class, 'jobs_submited'])->name('jobs_submited');
Route::get('/jobs_submited_detail/{post_id}', [PostJobController::class, 'jobs_submited_detail'])->name('jobs_submited_detail');
//===============================//=============================//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
