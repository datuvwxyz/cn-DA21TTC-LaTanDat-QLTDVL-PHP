@extends('admin.dashboard')

@section('content')
<div class="container-fluid'">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DANH MỤC CÔNG VIỆC</h6>
        </div>
        @if(Session::has('success'))
        <div id="notification" class="notification success">
            <span>{{ Session::get('success') }}</span>
            <button onclick="closeNotification()" class="close-btn">✖</button>
        </div>
        @endif

        @if(Session::has('fail'))
        <div id="notification" class="notification error">
            <span>{{ Session::get('fail') }}</span>
            <button onclick="closeNotification()" class="close-btn">✖</button>
        </div>
        @endif
        <div class="card-header py-1">
            <a href="{{ route('create_category') }}"><button type="button" class="btn btn-outline-primary">Thêm</button></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_category as $i => $category)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('edit_category', ['category_id' => $category->category_id]) }}">
                                    <button type="button" class="btn btn-outline-info">Sửa</button>
                                </a>
                                <a href="{{ route('delete_category', ['category_id' => $category->category_id]) }}">
                                    <button type="button" class="btn btn-outline-danger">Xóa</button>
                                </a>
                                <a href=" {{ route('skill_index') }} ">
                                    <button type="button" class="btn btn-outline-link">Xem thông tin kỹ năng</button>
                                </a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    .notification {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 60px;
        right: 10px;
        background-color: #f0f9eb;
        color: #2e7d32;
        border-left: 5px solid #2e7d32;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        max-width: 400px;
        animation: fadeIn 0.5s ease-out, fadeOut 1s ease-out 4.5s;
        animation-iteration-count: 1;
    }

    .notification.error {
        background-color: #fdecea;
        color: #c62828;
        border-left: 5px solid #c62828;
    }

    .notification .close-btn {
        background: none;
        border: none;
        font-size: 16px;
        cursor: pointer;
        color: inherit;
    }
</style>

<script>
    function closeNotification() {
        const notification = document.getElementById('notification');
        if (notification) {
            notification.style.display = 'none';
        }
    }

    // Tự động ẩn thông báo sau 5 giây
    setTimeout(() => {
        closeNotification();
    }, 5000);
</script>
@endsection