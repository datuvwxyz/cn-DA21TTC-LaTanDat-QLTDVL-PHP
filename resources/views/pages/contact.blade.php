@extends('dashboard')

@section('content')
<style>
    .contact-form {
        background-color: #fff;
        padding: 40px 20px;
        max-width: 800px;
        margin: 50px auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 100px;
    }

    .contact-form h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .contact-form p {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
    }

    .contact-form form {
        display: flex;
        flex-direction: column;
    }

    .contact-form label {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .contact-form input,
    .contact-form textarea {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        border: 2px solid #ccc;
    }

    .contact-form button {
        padding: 12px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    .contact-form button:hover {
        background-color: #555;
    }
</style>
<section class="contact-form">
    <div class="container">
        <h1>Liên Hệ Với Chúng Tôi</h1>
        <p>Chúng tôi luôn sẵn sàng hỗ trợ bạn! Hãy để lại thông tin của bạn dưới đây.</p>
        <form action="{{ route('sendContact') }}" method="post">
            @csrf
            <label for="name">Tên của bạn:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Tin nhắn của bạn:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Gửi Liên Hệ</button>
        </form>
    </div>
</section>

@if(Session::has('success'))
<script>
    Swal.fire({
        title: "Thành công!",
        text: "{{ Session::get('success') }}",
        icon: "success",
        confirmButtonText: "OK"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('contact') }}";
        }
    });
</script>
@endif

@if(Session::has('error'))
<script>
    Swal.fire({
        title: "Thất bại!",
        text: "{{ Session::get('error') }}",
        icon: "error",
        confirmButtonText: "Thử lại"
    });
</script>
@endif
@endsection