@extends('dashboard')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .banner-slider {
        position: relative;
        width: 100%;
        max-height: 600px;
        overflow: hidden;
        background-color: #f4f4f4;
    }

    .banner-slider img {
        width: 100%;
        height: auto;
        display: block;
    }

    .banner-slider .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        pointer-events: none;
    }

    .banner-slider .text-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 3rem;
        font-weight: bold;
        color: #333;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        text-align: center;
        z-index: 2;
    }

    .job-container-fluid {
        display: flex;
        min-height: 100vh;
        border: 2px solid #ccc;
    }

    .job-sidebar {
        width: 280px;
        background-color: #ffffff;
        padding: 1.5rem;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        position: absolute;
        height: 100vh;
        overflow-y: auto;
    }

    .job-sidebar h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #ccc;
    }

    .job-filter-section {
        margin-bottom: 2rem;
    }

    .job-filter-section select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #ccc;
        border-radius: 0.5rem;
        background-color: #fff;
        font-size: 0.95rem;
        color: #4a5568;
        transition: all 0.2s ease;
    }

    .job-filter-section select:hover {
        border-color: #cbd5e0;
    }

    .job-filter-section select:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    }

    .job-main-content {
        flex: 1;
        margin-left: 280px;
        padding: 2rem;
        border: 2px solid #ccc;
    }

    .job-counters {
        margin-bottom: 20px;
    }

    .search-container {
        margin-bottom: 2rem;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 1rem 3rem 1rem 1.5rem;
        border: 2px solid #ccc;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: all 0.2s ease;
        background-color: #fff;
    }

    .search-input:focus {
        outline: none;
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.15);
    }

    .search-icon {
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
    }

    .job-card {
        background-color: #ffffff;
        border: 2px solid #ccc;
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .job-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    }

    .job-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .company-logo {
        width: 7.5rem;
        height: 7.5rem;
        border-radius: 0.75rem;
        object-fit: cover;
    }

    .job-details h2 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .job-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        color: #718096;
        font-size: 0.95rem;
    }

    .job-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .position {
        text-align: left;
    }

    .area {
        margin-left: -40px;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background-color: #4299e1;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #3182ce;
    }

    .time-badge {
        font-size: 0.875rem;
        color: #718096;
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        background-color: #f7fafc;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 0.5rem;
    }

    .pagination .page-link {
        padding: 0.5rem 1rem;
        border: 2px solid #ccc;
        border-radius: 0.5rem;
        color: #4a5568;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background-color: #f7fafc;
    }

    .pagination .active {
        background-color: #4299e1;
        color: #ffffff;
        border-color: #4299e1;
    }

    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .hidden {
        display: none;
    }

    @media (max-width: 1024px) {
        .job-sidebar {
            width: 240px;
        }

        .job-main-content {
            margin-left: 240px;
        }
    }

    @media (max-width: 768px) {
        .job-container-fluid {
            flex-direction: column;
        }

        .job-sidebar {
            width: 100%;
            height: auto;
            position: relative;
            margin-bottom: 1rem;
        }

        .job-main-content {
            margin-left: 0;
        }

        .job-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .job-meta {
            flex-wrap: wrap;
        }
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }
</style>
<div class="banner-slider">
    <img src="{{asset('frontend/img/banner.jpeg')}}" alt="Banner" />
    <div class="overlay"></div>
    <div class="text-overlay">Tìm việc</div>
</div>

<div class="job-container-fluid">
    <!-- Sidebar -->
    <aside class="job-sidebar">
        <div class="job-filter-section">
            <h3>Lĩnh vực</h3>
            <select name="category_id" id="category" class="filter-select">
                <option value="">Tất cả lĩnh vực</option>
                @foreach ($categories as $category)
                <option value="{{ $category->category_id }}"
                    {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="job-filter-section">
            <h3>Khu vực</h3>
            <select name="area" id="area" class="filter-select">
                <option value="">Tất cả khu vực</option>
                @foreach ($areas as $area)
                <option value="{{ $area }}"
                    {{ request('area') == $area ? 'selected' : '' }}>
                    {{ $area  }}
                </option>
                @endforeach
            </select>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="job-main-content">
        <div class="job-counters">
            @include('pages.partials.job_counters')
        </div>
        <!-- Search Bar -->
        <form id="search-form" class="search-container">
            <input
                type="text"
                name="keyword"
                class="search-input"
                placeholder="Nhập tên bài đăng"
                value="{{ request('keyword') }}"
                onkeyup="performSearch(this.value)">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </form>

        <!-- Job Listings -->
        <div class="job-listings-container">
            @include('pages.partials.job_listings', ['postJobs' => $postJobs])
        </div>
        <!-- Pagination -->
        <div class="pagination">
            @if ($postJobs->hasPages())
            <div class="flex items-center justify-center gap-2 mt-8">
                {{-- Previous Page Link --}}
                @if ($postJobs->onFirstPage())
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Quay lại</span>
                @else
                <a href="{{ $postJobs->previousPageUrl() }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    Quay lại
                </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($postJobs->getUrlRange(1, $postJobs->lastPage()) as $page => $url)
                @if ($page == $postJobs->currentPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-indigo-600 text-white">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($postJobs->hasMorePages())
                <a href="{{ $postJobs->nextPageUrl() }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    Tiếp
                </a>
                @else
                <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Tiếp</span>
                @endif
            </div>
            @endif
        </div>
    </main>
    <div class="loading-spinner hidden">
        <div class="spinner"></div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="keyword"]');
        const categorySelect = document.querySelector('select[name="category_id"]');
        const provinceSelect = document.querySelector('select[name="area"]');
        const jobListingsContainer = document.querySelector('.job-listings-container');
        const jobCountersContainer = document.querySelector('.job-counters');
        let searchTimeout;

        const fetchResults = () => {
            const url = new URL(window.location.href);
            const category = categorySelect.value;
            const province = provinceSelect.value;
            const keyword = searchInput.value.trim();

            // Build URL params
            if (keyword) url.searchParams.set('keyword', keyword);
            else url.searchParams.delete('keyword');

            if (category) url.searchParams.set('category_id', category);
            else url.searchParams.delete('category_id');

            if (province) url.searchParams.set('area', province);
            else url.searchParams.delete('area');

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Logic khi có cả 2 select
                    if (category && province) {
                        // Nếu một trong hai không có dữ liệu, hiện không tìm thấy
                        if (data.totalByCategory === 0 || data.totalByArea === 0) {
                            jobCountersContainer.innerHTML = '<span>Không tìm thấy kết quả nào.</span>';
                            jobListingsContainer.innerHTML = '';
                            return;
                        }
                    }

                    jobListingsContainer.innerHTML = data.listings;
                    jobCountersContainer.innerHTML = data.counters;
                    window.history.pushState({}, '', url);
                })
                .catch(error => console.error('Error:', error));
        };

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(fetchResults, 300);
        });

        categorySelect.addEventListener('change', fetchResults);
        provinceSelect.addEventListener('change', fetchResults);
    });
</script>
@endsection