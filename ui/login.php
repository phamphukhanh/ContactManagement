<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Bắt các mã thông báo và hiển thị thông báo tương ứng -->
    <?php
    // Nếu mã thông báo là 0, hiển thị thông báo cho biết tài khoản đã tồn tại
    if (isset($_GET['registered']) && $_GET['registered'] == 1) {
        echo
        '<div id="message" class="alert alert-success">
        Account created successfully!
        <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Nếu mã thông báo là 1, hiển thị thông báo cho biết tài khoản đã được tạo thành công
    else
    if (isset($_GET['login']) && $_GET['login'] == 0) {
        echo
        '<div id="message" class="alert alert-danger">
            Invalid username or password!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    ?>
    <div class="container p-3" style="height: 200px; width: 460px;">
        <div class="row ">
            <div class="col">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Login</h4>
                    </div>

                    <div class="card-body">
                        <form action="../bl/login_register.php" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <button name="login" class="btn btn-success btn-block">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        Not a user? <a href="register.php">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Lắng nghe sự kiện khi nút "Đóng" được bấm
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'block';

            // Thiết lập hẹn giờ tự động tắt sau 5 giây (5000 milliseconds)
            var autoCloseTimeout = setTimeout(function() {
                message.style.display = 'none';
            }, 3000); // Đặt thời gian tắt tự động ở đây (5 giây trong ví dụ này)

            // Thêm sự kiện cho nút tắt thông báo
            var closeButton = document.getElementById('close-button');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    // Hủy hẹn giờ nếu người dùng tắt thông báo bằng cách nhấn nút tắt
                    clearTimeout(autoCloseTimeout);
                    message.style.display = 'none';
                });
            }
        }
        if (typeof window.history.replaceState == 'function') {
            window.history.replaceState({}, '', window.location.href.split('?')[0]);
        }
    </script>
</body>

</html>