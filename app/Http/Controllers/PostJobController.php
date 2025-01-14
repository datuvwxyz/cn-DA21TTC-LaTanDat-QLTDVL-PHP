<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Category;
use App\Models\Freelancer;
use App\Models\PostJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostJobController extends Controller
{
    public function jobs_submited()
    {
        $accountId = session('user_id');

        $freelancer = Freelancer::where('account_id', $accountId)->first();

        if (!$freelancer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer');
        }

        $appliedJobs = PostJob::with(['category', 'employer', 'skills'])
            ->whereHas('freelancers', function ($query) use ($freelancer) {
                $query->where('post_job_freelancer.freelancer_id', $freelancer->freelancer_id); // Chỉ định rõ tên bảng
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pages.users.jobs_submited', compact('appliedJobs'));
    }

    public function jobs_submited_detail($post_id)
    {
        $accountId = session('user_id');

        $freelancer = Freelancer::where('account_id', $accountId)->first();

        if (!$freelancer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin freelancer');
        }
        
        $post = PostJob::with(['freelancers', 'category'])->findOrFail($post_id);
        return view('pages.users.jobs_submited_detail', compact('post'));
    }

    // Hiển thị danh sách các bài đăng tuyển dụng
    public function index(Request $request)
    {
        $areas = config('provinces');
        $categories = Category::with('skills')->get();

        $query = PostJob::query()
            ->with(['category', 'employer', 'skills'])
            ->where('status', 'Active');

        $totalByCategory = null;
        $totalByArea = null;
        $totalByKeyword = null;

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
            $totalByCategory = PostJob::where('category_id', $request->category_id)
                ->where('status', 'Active')
                ->count();
        }

        // Xử lý lọc theo province nếu có  
        if ($request->filled('area')) {
            $query->where('area', $request->area);
            $totalByArea = PostJob::where('area', $request->area)
                ->where('status', 'Active')
                ->count();
        }

        // Xử lý tìm kiếm nếu có
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('title', 'like', "%{$keyword}%");
            $totalByKeyword = PostJob::where('title', 'like', "%{$keyword}%")
                ->where('status', 'Active')
                ->count();
        }

        // Lấy kết quả và phân trang
        $postJobs = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'listings' => view('pages.partials.job_listings', compact('postJobs'))->render(),
                'counters' => view('pages.partials.job_counters', compact('postJobs', 'totalByCategory', 'totalByArea', 'totalByKeyword'))->render()
            ]);
        }

        return view('pages.jobs', compact('postJobs', 'categories', 'areas',  'totalByCategory', 'totalByArea', 'totalByKeyword'));
    }

    public function jobsListed()
    {
        $accountId = session('user_id');

        $employer = Employer::where('account_id', $accountId)->first();

        if (!$employer) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhà tuyển dụng');
        }

        $postJobs = PostJob::with(['category', 'employer', 'skills'])
            ->where('employer_id', $employer->employer_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pages.employers.jobs_listed', compact('postJobs'));
    }

    public function jobDetail($post_id)
    {
        $post = PostJob::findOrFail($post_id);
        return view('pages.employers.jobs_listed_detail', compact('post'));
    }

    // Hiển thị form tạo bài đăng tuyển dụng
    public function createJob()
    {
        try {
            $categories = Category::with('skills')->get();
            $employers = Employer::all();
            $provinces = config('provinces');
            return view('pages.employers.post_job', compact('categories', 'employers', 'provinces'));
        } catch (\Exception $e) {
            return back()->withErrors('Lỗi khi lấy dữ liệu danh mục hoặc nhà tuyển dụng: ' . $e->getMessage());
        }
    }

    // Lưu bài đăng tuyển dụng mới
    public function AddNewJob(Request $request)
    {
        $accountId = session('user_id');
        $employer = Employer::where('account_id', $accountId)->first();
        $employerId = $employer->employer_id;
        $employerId = Employer::where('account_id', $accountId)->value('employer_id');

        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'expiration_date' => 'nullable|date',
            'area' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'skills' => 'required|array',
            'skills.*' => 'exists:skill,skill_id'
        ]);

        try {
            $post = new PostJob();
            $post->title = $request->input('title');
            $post->position = $request->input('position');
            $post->description = trim($request->input('description'));
            $post->expiration_date = $request->input('expiration_date');
            $post->area = $request->input('area');
            $post->employer_id = $employerId;
            $post->category_id = $request->input('category_id');

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('post_images', 'public');
                $post->image = $imagePath;
            }

            $post->save();

            if ($request->has('skills') && is_array($request->skills)) {
                $post->skills()->sync($request->skills);
            }

            return redirect()->route('post_job')->with('success', 'Đăng thành công');
        } catch (\Exception $e) {
            return redirect()->route('post_job')->with('error', 'Đăng không thành công');
        }
    }

    public function editJob($post_id)
    {
        $employerId = session('user_id');

        try {
            $post = PostJob::with(['category', 'skills'])->findOrFail($post_id);
            $categories = Category::with('skills')->get();
            $provinces = config('provinces');
            return view('pages.employers.edit_post_job', compact('post', 'categories', 'provinces'));
        } catch (\Exception $e) {
            return back()->withErrors('Lỗi khi lấy dữ liệu bài đăng tuyển dụng: ' . $e->getMessage());
        }
    }

    public function updateJob(Request $request, $post_id)
    {
        $accountId = session('user_id');
        $employer = Employer::where('account_id', $accountId)->first();
        $employerId = $employer->employer_id;
        $employerId = Employer::where('account_id', $accountId)->value('employer_id');
        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'expiration_date' => 'nullable|date',
            'area' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,category_id',
            'skills' => 'required|array',
            'skills.*' => 'exists:skill,skill_id'
        ]);

        try {
            $post = PostJob::findOrFail($post_id);

            $post->title = $request->input('title');
            $post->position = $request->input('position');
            $post->description = trim($request->input('description'));
            $post->expiration_date = $request->input('expiration_date');
            $post->area = $request->input('area');
            $post->employer_id = $employerId;
            $post->category_id = $request->input('category_id');
            $post->status = 'Pending';

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('post_images', 'public');
                $post->image = $imagePath;
            }

            if ($request->has('skills') && is_array($request->skills)) {
                $post->skills()->sync($request->skills);
            }

            $post->update();

            return redirect()->back()->with('success', 'Bài đăng tuyển dụng đã được cập nhật.');
        } catch (\Exception $e) {
            return back()->withErrors('Lỗi khi cập nhật bài đăng tuyển dụng: ' . $e->getMessage());
        }
    }

    public function updateImageJob(Request $request, $post_id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $post = PostJob::where('post_id', $post_id)->first();

            if (!$post) {
                return redirect()->back()->with('error', 'Không tìm thấy bài đăng tuyển dụng.');
            }

            if ($request->hasFile('image')) {
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }

                $imagePath = $request->file('image')->store('post_images', 'public');
                $post->image = $imagePath;
            }

            $post->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật không thành công, vui lòng thử lại!');
        }
    }

    public function deleteJob($post_id)
    {
        try {
            $postJob = PostJob::findOrFail($post_id);
            $postJob->delete();

            return redirect()->route('post_listed')->with('success', 'Bài đăng tuyển dụng đã được xóa.');
        } catch (\Exception $e) {
            return back()->withErrors('Lỗi khi xóa bài đăng tuyển dụng: ' . $e->getMessage());
        }
    }
    public function detailapplyJob($post_id)
    {
        $post = PostJob::findOrFail($post_id);
        return view('pages.jobs_detail_apply', compact('post'));
    }

    public function applyJob(Request $request, $post_id)
    {
        $messages = [
            'cv_file.required' => 'Vui lòng upload CV của bạn',
            'cv_file.mimes' => 'CV phải là file PDF, DOC hoặc DOCX',
            'cv_file.max' => 'Kích thước file không được vượt quá 8MB'
        ];

        $request->validate([
            'cv_file' => 'required|mimes:pdf,doc,docx|max:8000'
        ], $messages);

        try {
            $postJob = PostJob::where('post_id', $post_id)
                ->where('status', 'Active')
                ->where('expiration_date', '>', now())
                ->first();

            if (!$postJob) {
                throw new \Exception('Tin tuyển dụng không tồn tại hoặc đã hết hạn');
            }

            $freelancer = session('user_id');
            if (!$freelancer) {
                throw new \Exception('Không tìm thấy thông tin freelancer');
            }

            if (!$request->hasFile('cv_file')) {
                throw new \Exception('Không tìm thấy file CV');
            }

            $file = $request->file('cv_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Sửa cách lưu file
            $path = $request->file('cv_file')->storeAs('cvFile', $filename, 'public');

            $postJob->freelancers()->attach($freelancer, [
                'cv_file' => $path, // Lưu đường dẫn đầy đủ
                'applied_at' => now()
            ]);

            return redirect()->back()->with('success', 'Ứng tuyển thành công!');
        } catch (\Exception $e) {
            // Log lỗi để debug
            Log::error('Apply Job Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}
