@php
    $total = null;

    // Nếu có cả 2 select category và area
    if ($totalByCategory !== null && $totalByArea !== null) {
        // Nếu 1 trong 2 = 0 thì hiển thị không tìm thấy
        if ($totalByCategory == 0 || $totalByArea == 0) {
            $total = 0;
        } else {
            // Ngược lại lấy giá trị nhỏ nhất
            $total = min($totalByCategory, $totalByArea);
        }
    } elseif ($totalByCategory === null && $totalByArea !== null) {
        // Nếu category là null và area không null
        $total = $totalByArea;
    } elseif ($totalByCategory !== null && $totalByArea === null) {
        // Nếu category không null và area là null
        $total = $totalByCategory;
    } else {
        // Nếu chỉ có 1 select thì lấy giá trị của select đó
        $total = $totalByCategory ?? $totalByArea ?? $totalByKeyword ?? $postJobs->total();
    }
@endphp

@if($total == 0)
    <span>Không tìm thấy kết quả nào.</span>
@else
    <span>{{ $total }} bài viết được tìm thấy</span>
@endif
