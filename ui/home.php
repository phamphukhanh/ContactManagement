<!DOCTYPE html>
<html lang="en">
<?php
include_once "../classes/user.php";
include_once "../classes/contact.php";
session_start();
// Kiểm tra xem có thông tin người dùng không
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    $displayName = $user->getFirstName();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatct List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        #message {
            margin-bottom: 9px;
            margin-right: 9px;
            margin-left: auto;
            width: fit-content;
            z-index: 1;
            position: fixed;
        }
    </style>
</head>

<body>
    <!-- Bắt các mã thông báo -->
    <?php
    // Thông báo thêm liên hệ thành công (added mang giá trị 1)
    if (isset($_GET['added']) && $_GET['added'] == 1) {
        echo
        '<div id="message" class="alert alert-success fixed-bottom">
            Contact added!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo thêm liên hệ thất bại (added mang giá trị 0)
    if (isset($_GET['added']) && $_GET['added'] == 0) {
        echo
        '<div id="message" class="alert alert-danger fixed-bottom" style="margin-top: 60px; z-index: 1031">
            An error occurred, please try again!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo xóa liên hệ thành công (deleted mang giá trị 1)
    if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
        echo
        '<div id="message" class="alert alert-success fixed-bottom" style="margin-top: 60px; z-index: 1031">
            Contact deleted!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo xóa liên hệ thất bại (deleted mang giá trị 0)
    if (isset($_GET['deleted']) && $_GET['deleted'] == 0) {
        echo
        '<div id="message" class="alert alert-danger fixed-bottom" style="margin-top: 60px; z-index: 1031">
            An error occurred, please try again!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo cập nhật liên hệ thành công (updated mang giá trị 1)
    if (isset($_GET['updated']) && $_GET['updated'] == 1) {
        echo
        '<div id="message" class="alert alert-success fixed-bottom" style="margin-top: 60px; z-index: 1031">
            Contact updated!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo cập nhật liên hệ thất bại (updated mang giá trị 0)
    if (isset($_GET['updated']) && $_GET['updated'] == 0) {
        echo
        '<div id="message" class="alert alert-danger fixed-bottom" style="margin-top: 60px; z-index: 1031">
            An error occurred, please try again!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo chặn liên hệ thành công (blocked mang giá trị 1)
    if (isset($_GET['blocked']) && $_GET['blocked'] == 1) {
        echo
        '<div id="message" class="alert alert-success fixed-bottom" style="margin-top: 60px; z-index: 1031">
            Contact blocked!
            <a href="./blocked.php" class="m-2">View</a>
            <button id="close-button" class="close ml-1" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo chặn liên hệ thất bại (blocked mang giá trị 0)
    if (isset($_GET['blocked']) && $_GET['blocked'] == 0) {
        echo
        '<div id="message" class="alert alert-danger fixed-bottom" style="margin-top: 60px; z-index: 1031">
            An error occurred, please try again!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo mở chặn liên hệ thành công (unblocked mang giá trị 1)
    if (isset($_GET['unblocked']) && $_GET['unblocked'] == 1) {
        echo
        '<div id="message" class="alert alert-success fixed-bottom" style="margin-top: 60px; z-index: 1031">
            Contact unblocked!
            <button id="close-button" class="close ml-1" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    // Thông báo mở chặn liên hệ thất bại (unblocked mang giá trị 0)
    if (isset($_GET['unblocked']) && $_GET['unblocked'] == 0) {
        echo
        '<div id="message" class="alert alert-danger fixed-bottom" style="margin-top: 60px; z-index: 1031">
            An error occurred, please try again!
            <button id="close-button" class="close" data-dismiss="alert" aria-label="Close">×</button>
        </div>';
    }
    ?>
    <!-- Thanh navigation -->
    <nav class="navbar navbar-expand navbar-dark fixed-top bg-primary">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../ui/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./new_contact.php">Add a new contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./blocked.php">View blocked list</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item ml-auto dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello, <?php echo $displayName; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../bl/login_register.php?action=logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Hiển thị danh sách liên hệ -->
    <div class="container" style="margin-top: 70px;">
        <h2>Your contacts</h2>
        <!-- Form tìm kiếm -->
        <form method="post" class="form-inline mb-3">
            <div class="form-group">
                <label for="searchInput" class="sr-only">Search</label>
                <input name="nameInput" type="text" class="form-control" id="searchInput" placeholder="Search contact by name">
            </div>
            <button name="find" class="btn btn-primary ml-2">Search</button>
        </form>

        <?php
        // Kiểm tra xem có yêu cầu tìm kiếm không
        if (isset($_POST["find"])) {
            // Nếu có yêu cầu tìm kiếm, chuyển hướng đến trang tìm kiếm (find_contacts.php)
            include_once "../bl/find_contacts.php";
        }
        // Nếu không có yêu cầu tìm kiếm
        else {
            // Hiển thị danh sách liên hệ mặc định như bình thường (view_contacts.php)
            include_once "../bl/view_contacts.php";
        }
        ?>
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