<div id="job-listings">
    @foreach($postJobs as $job)
    <div class="job-card">
        <div class="job-info">
            <img
                src="{{ asset('storage/' . $job->image) }}"
                class="company-logo">
            <div class="job-details">
                <h2>{{ $job->title }}</h2>
                <div class="job-meta">
                    <span class="position">{{ $job->position }}</span>
                    <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                    <span class="area">{{ $job->area }}</span>
                </div>
            </div>
        </div>
        <div class="job-actions">
            <span class="time-badge">
                {{ $job->created_at->diffForHumans() }}
            </span>
            <a href="{{ route('detail_jobs_apply', $job->post_id) }}" class="btn btn-primary">Chi tiết</a>
        </div>
    </div>
    @endforeach
    @if($postJobs->count() == 0)
    <p class="text-center text-gray-500 mt-8">Không tìm thấy kết quả nào.</p>
    @endif
</div>