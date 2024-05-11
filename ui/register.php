<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Bắt mã thông báo để hiển thị thông báo tương ứng -->
    <?php
    if (isset($_GET['registered']) && $_GET['registered'] == 0) {
        echo
        '<div id="success-message" class="alert alert-danger">
            Your email is already registered, please choose another one!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    ?>

    <div class="container p-3" style="height: 200px; width: 460px;">
        <div class="row ">
            <div class="col">
                <div class="card border-primary rounded">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="../bl/login_register.php" method="post">
                            <div class="form-group">
                                <label for="first_name">Firstname:</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Lastname:</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username (Your email):</label>
                                <input type="email" class="form-control" name="new_username" id="new_username" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button name="register" class="btn btn-success btn-block">Register</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        Already had an account? <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Xử lý sự kiện ẩn/hiện password
        document.addEventListener("DOMContentLoaded", function() {
            var passwordInput = document.getElementById("new_password");
            var toggleButton = document.querySelector(".input-group-text");
            var toggleIcon = toggleButton.querySelector("i");

            toggleButton.addEventListener('click', function(event) {
                event.preventDefault();
                if (passwordInput.getAttribute("type") === "text") {
                    passwordInput.setAttribute('type', 'password');
                    toggleIcon.classList.remove("fa-eye-slash");
                    toggleIcon.classList.add("fa-eye");
                } else if (passwordInput.getAttribute("type") === "password") {
                    passwordInput.setAttribute('type', 'text');
                    toggleIcon.classList.remove("fa-eye");
                    toggleIcon.classList.add("fa-eye-slash");
                }
            });
        });

        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'block';

            // Thiết lập hẹn giờ tự động tắt sau 5 giây (5000 milliseconds)
            var autoCloseTimeout = setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000); // Đặt thời gian tắt tự động ở đây (5 giây trong ví dụ này)

            // Thêm sự kiện cho nút tắt thông báo
            var closeButton = document.getElementById('close-button');
            if (closeButton) {
                closeButton.addEventListener('click', function() {
                    // Hủy hẹn giờ nếu người dùng tắt thông báo bằng cách nhấn nút tắt
                    clearTimeout(autoCloseTimeout);
                    successMessage.style.display = 'none';
                });
            }
        }
    </script>
</body>

</html>