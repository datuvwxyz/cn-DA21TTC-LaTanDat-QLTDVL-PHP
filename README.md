# Xây dựng Website quản lý và tuyển dụng việc làm Freelancer bằng PHP & Framework Laravel
## Mô tả đề tài
Website quản lý và tuyển dụng việc làm Freelancer sẽ được thiết kế để tối ưu hóa quá trình kết nối giữa nhà tuyển dụng và freelancer, đồng thời nâng cao khả năng tìm kiếm và quản lý công việc trực tuyến. Giao diện website sẽ đơn giản, dễ sử dụng, giúp người dùng dễ dàng tìm kiếm freelancer hoặc dự án theo các tiêu chí như kỹ năng, ngành nghề và địa điểm. Ngoài ra, quản trị viên cũng có thể dễ dàng quản lý thông tin người dùng, dự án và giao dịch thông qua các chức năng như thêm, sửa và xóa dữ liệu.
- Tạo nền tảng tìm việc và tuyển dụng trực tuyến
- Cung cấp bài đăng để dễ tìm kiếm việc làm dành cho freelancer
## Công nghệ sử dụng
### Backend
- PHP
- Framework Laravel
- MySQL
### Frontend
- HTML/CSS/Javascript
- Bootstrap
- SCSS
- Tailwind
## Kiến trúc hệ thống
Sử dụng mô hình MVC và route để định tuyến dữ liệu đảm bảo view và dữ liệu tương tác với nhau một cách đồng bộ và hiệu quả nhất có thể
## Chức năng chính
### Quản lý người dùng
- Đăng ký/đăng nhập
- Quản lý hồ sơ cá nhân
### Quản lý bài đăng
- Admin: xem chi tiết bài đăng, duyệt hoặc từ chối tin tuyển dụng
- Freelancer: xem, nộp cv ứng tuyển
- Nhà tuyển dụng: duyệt tin tuyển dụng ứng tuyển của freelancer, thêm, sửa, xóa, xem thông tin chi tiết tin tuyển dụng
### Thống kê và vẽ biểu đồ
- Thống kê người dùng, trạng thái tin tuyển dụng
- Hiển thị biểu đồ bằng Chart.js hoặc D3.js
### Chức năng tìm kiếm và lọc tin tuyển dụng
- Tìm kiếm theo ký tự
- Tìm kiếm theo danh mục hoặc khu vực
## Đối tượng sử dụng
### Freelancer
- Cập nhật hồ sơ cá nhân
- Đăng ký, nộp cv ứng tuyển dựa trên tin tuyển dụng
### Admin
- Quản lý hệ thống, giám sát hoạt động
### Nhà tuyển dụng
- Cập nhật hồ sơ cá nhân
- Thêm, sửa, xóa, xem thông tin chi tiết tin tuyển dụng
## Phân quyền
### Freelancer
- Quyền xem tin tuyển dụng, đăng ký nộp cv ứng tuyển
- Xem được danh sách trạng thái tin tuyển dụng đã ứng tuyển
### Admin
- Quyền quản lý người dùng và tin tuyển dụng
- Quyền quản lý danh mục, kỹ năng
### Nhà tuyển dụng
- Quyền xem tin tuyển dụng, duyệt tin ứng tuyển
- Xem được danh sách tin tuyển dụng đã đăng và trạng thái đã được admin duyệt hay chưa
