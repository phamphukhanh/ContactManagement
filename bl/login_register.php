<?php
include_once "../dal/user_dal.php";

$userDAL = new user_dal();

// Đăng ký
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem nút "Register" đã được nhấn hay chưa
    if (isset($_POST["register"])) {
        // Lấy giá trị username từ form có method POST
        $username = $_POST["new_username"];

        /*
            Kiểm tra xem user đã tồn tại hay chưa.
            Ở đây sử dụng lại hàm getUserByEmail().
            Để cụ thể hóa vấn đề và tránh nhầm lẫn, các bạn cũng có thể viết một hàm khác để kiểm tra user đã tồn tại hay chưa.
            */
        if ($userDAL->getUserByEmail($username) != null) {
            // Nếu đã tồn tại, chuyển hướng lại trang đăng ký kèm mã thông báo thất bại (số 0).
            header(
                "Location: ../ui/register.php?registered=0"
            );
            // Đóng kết nối database và kết thúc xử lý
            $user_dal->close();
            exit();
        }
        // Nếu chưa tồn tại
        else {
            // Lấy các dữ liệu từ form có method POST, đổ vào một đối tượng User
            $newUser = new User();
            $newUser->setFirstName($_POST["first_name"]);
            $newUser->setLastName($_POST["last_name"]);
            $newUser->setUsername($username);
            // Mã hóa password trước khi lưu vào database
            $password = $_POST["new_password"];
            $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));

            if ($userDAL->insertNewAccount($newUser)) {
                // Nếu thêm thành công, chuyển hướng đến trang đăng nhập kèm mã thông báo thành công (số 1).
                header(
                    "Location: ../ui/login.php?registered=1"
                );
                // Đóng kết nối database và kết thúc xử lý
                $user_dal->close();
                exit();
            }
        }
    }
}

// Đăng nhập
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem nút "Login" đã được nhấn hay chưa
    if (isset($_POST["login"])) {
        // Lấy giá trị username từ form có method POST
        $username = $_POST["username"];
        $password = $_POST["password"];
        // Lấy password từ database dựa trên username
        $database_password = $userDAL->getUserByEmail($username)->getPassword();
        // Kiểm tra xem password nhập vào có khớp với password trong database hay không
        if (password_verify($password, $database_password)) {
            $user = $userDAL->getUserByEmail($username);
            session_start();
            $_SESSION["user_info"] = $user;
            header("Location: ../ui/home.php");
            // Đóng kết nối database và kết thúc xử lý
            $user_dal->close();
            exit();
        } else {
            header(
                "Location: ../ui/login.php?login=0"
            );
            // Đóng kết nối database và kết thúc xử lý
            $user_dal->close();
            exit();
        }
    }
}

// Kiểm tra nếu action là logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Hủy toàn bộ session
    session_destroy();

    // Chuyển hướng về trang đăng nhập
    header("Location: ../ui/login.php");
    // Đóng kết nối database và kết thúc xử lý
    $user_dal->close();
    exit();
}
