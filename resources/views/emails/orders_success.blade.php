<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        .container {
            background: linear-gradient(90deg, #F63D68 0%, #FEA3B4 100%, #C9687A 100%);
            padding: 50px;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 50px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 170px;
            margin-left: -325px;
        }

        h2 {
            color: #ffffff;
        }

        p {
            color: #ffffff;
            line-height: 1.5;
        }

        .password-container {
            background-color: #ffffff;
            padding: 0px 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            display: inline-block;
        }


        .password {
            color: #F63D68;
            font-weight: bold;
            padding: inherit;
        }

        .footer {
            /* Căn giữa theo chiều ngang */
            display: flex;
            justify-content: center;
        }

        .johnny-div {
            /* Căn giữa theo chiều dọc */
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            padding-left: 6px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .img-icon {
            width: 120px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://firebasestorage.googleapis.com/v0/b/utc-app-ae5b9.appspot.com/o/logo%20(1).png?alt=media&token=464d3888-e0b2-4cc3-89c2-b7ffc55452f1"
                alt="Logo">
        </div>
        <h2>Xin chào!</h2>
        <p>Chúng tôi xác nhận rằng đơn hàng của bạn đã được tạo thành công.</p>

        <p>Thông tin đơn hàng:</p>
        <ul style="color: #ffffff">
            {{-- <li>Tên khách hàng: {{ $order->tenNguoiDung }}</li> --}}
            {{-- <li>Số điện thoại: {{ $order->taiKhoan }}</li> --}}
            {{-- <li>Địa chỉ: {{ $order->address }}</li> --}}
            {{-- <li>Phương thức thanh toán: @if ($order->payment_method == 1) Chuyển khoản @else Tiền mặt @endif</li> --}}
            <li>Nội dung: {{ $order['content'] }}</li>
            <li>Tổng giá: {{ number_format($order['price'], 0, ',', '.') }}</li>
        </ul>

        <br><br>

        <p style="text-align:center;">Pháp lý | Bảo mật | Điều kiện & Điều khoản</p>

        <p style="text-align:center;">Email này được gửi đến những thành viên đã đăng ký tham gia nhận thông tin.</p>

        <p style="text-align:center;">
            Ⓒ 2018-2023 TMSC. All rights reserved.
            Email này được gửi bởi Công ty TNHH Công Nghệ Y Tế TMSC Việt Nam.
            Địa chỉ tại LK 13 Romantic Park, Phường Xuân La, Tây Hồ, Hà Nội
            * Vui lòng không trả lời thư điện tử này
        </p>
        Trân trọng!
        </p>
        <div class="footer">
            <div class="johnny-div">
                <a href="https://ovumb.com/"><img class="img-icon"
                        src="https://firebasestorage.googleapis.com/v0/b/utc-app-ae5b9.appspot.com/o/link.png?alt=media&token=0b1f20f4-b8d2-469d-b85c-26ccbd0e5e63"
                        alt="Logo"></a>
            </div>
        </div>
    </div>
</body>

</html>
