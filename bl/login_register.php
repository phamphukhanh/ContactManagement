<?php
include_once "../dal/user_dal.php";

$userDAL = new user_dal();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem nút "Register" đã được nhấn hay chưa
    if (isset($_POST["register"])) {
        // Lấy các giá trị từ form có method POST
        $newUser = new User();
        $newUser->setFirstName($_POST["first_name"]);
        $newUser->setLastName($_POST["last_name"]);
        $newUser->setUsername($_POST["new_username"]);
        $newUser->setPassword($_POST["new_password"]);

        if ($userDAL->getUserByEmail($newUser->getUsername()) != null) {
            header(
                "Location: ../ui/register.php?registered=0"
            );
            exit();
        } elseif ($userDAL->insertNewAccount($newUser)) {
            // Nếu thêm thành công, chuyển hướng hoặc hiển thị thông báo thành công.
            // Điều hướng đến trang login.php với thông báo thành công
            header(
                "Location: ../ui/login.php?registered=1"
            );
            exit();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Kiểm tra xem nút "Login" đã được nhấn hay chưa
    if (isset($_POST["login"])) {
        // Lấy giá trị username từ form có method POST
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($userDAL->getLoginPassword($username) === $password) {
            $user = $userDAL->getUserByEmail($username);
            session_start();
            $_SESSION["user_info"] = $user;
            header("Location: ../ui/home.php");
            exit();
        } else {
            header(
                "Location: ../ui/login.php?login=0"
            );
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
    exit();
}
