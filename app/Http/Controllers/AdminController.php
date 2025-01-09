<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Employer;
use App\Models\Freelancer;
use App\Models\PostJob;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listFreelancers()
    {
        $freelancer_accounts = Account::where('role', 'freelancer')->with('freelancer')->get();
        return view('admin.pages.freelancer.freelancer_index', compact('freelancer_accounts'));
    }

    public function detailFreelancers($freelancer_id)
    {
        $freelancer = Freelancer::findOrFail($freelancer_id);
        return view('admin.pages.freelancer.detail_freelancer', compact('freelancer'));
    }

    public function listEmployers()
    {
        $employer_accounts = Account::where('role', 'employer')->with('employer')->get();
        return view('admin.pages.employer.employer_index', compact('employer_accounts'));
    }

    public function detailEmployers($employer_id)
    {
        $employer = Employer::findOrFail($employer_id);
        return view('admin.pages.employer.detail_employer', compact('employer'));
    }

    public function jobsListed()
    {
        $postJobs = PostJob::with(['category', 'employer', 'skills'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.pages.list_post.posts_index', compact('postJobs'));
    }

    public function jobDetail($post_id)
    {
        $post = PostJob::findOrFail($post_id);
        return view('admin.pages.list_post.detail_post', compact('post'));
    }

    public function approvePosts($post_id)
    {
        try {
            $post = PostJob::findOrFail($post_id);
            $post->status = 'Active';
            $post->save();
            return redirect()->back()
                ->with('success', 'Bài đăng đã được duyệt!!!')
                ->with('post_id', $post->post_id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Bài đăng chưa được duyệt!!')
                ->with('post_id', $post_id);
        }
    }

    public function rejectePosts($post_id)
    {
        try {
            $post = PostJob::findOrFail($post_id);
            $post->status = 'Rejected';
            $post->save();
            return redirect()->back()
                ->with('success', 'Đã từ chối bài đăng!!!')
                ->with('post_id', $post->post_id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Bài đăng chưa được từ chối!!')
                ->with('post_id', $post_id);
        }
    }

    public function inprogressPosts($post_id)
    {
        try {
            $post = PostJob::findOrFail($post_id);
            $post->status = 'InProgress';
            $post->save();
            return redirect()->back()
                ->with('success', 'Đăng ký thành công chờ xác!!!')
                ->with('post_id', $post->post_id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Bài đăng chưa được từ chối!!')
                ->with('post_id', $post_id);
        }
    }

    public function home()
    {
        $totalVisitors = Account::whereIn('role', ['freelancer', 'employer'])->count();
        $freelancers = Account::where('role', 'freelancer')->count();
        $employers = Account::where('role', 'employer')->count();

        $totalPosts = PostJob::count();
        $pendingPosts = PostJob::where('status', 'Pending')->count();
        $rejectedPosts = PostJob::where('status', 'Rejected')->count();
        $activePosts = PostJob::where('status', 'Active')->count();
        $expiredPosts = PostJob::where('status', 'Expired')->count();;

        $dailyPosts = PostJob::selectRaw('COUNT(*) as count, DATE(created_at) as date')
            ->whereYear('created_at', date('Y')) // Lọc theo năm hiện tại
            ->groupBy('date') // Nhóm theo ngày
            ->orderBy('date') // Sắp xếp theo ngày
            ->get();

        $dates = [];
        $postCounts = [];

        // Chuẩn bị dữ liệu cho biểu đồ
        foreach ($dailyPosts as $post) {
            $dates[] = $post->date; // Lưu ngày vào mảng $dates
            $postCounts[] = $post->count; // Lưu số lượng bài viết vào mảng $postCounts
        }

        return view('admin.pages.home', compact(
            'totalVisitors',
            'freelancers',
            'employers',
            'totalPosts',
            'pendingPosts',
            'rejectedPosts',
            'activePosts',
            'expiredPosts',
            'dates',
            'postCounts'
        ));
    }
}
