<!DOCTYPE html>
<html lang="en">
<?php
include_once "../classes/user.php";
include_once "../bl/add_contact.php";

// Kiểm tra xem có thông tin người dùng không
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    $displayName = $user->getFirstName();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Thanh navigation -->
    <nav class="navbar navbar-expand navbar-dark fixed-top bg-primary">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../ui/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add a new contact</a>
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
    <div class="container" style="margin-top: 70px;">
        <div class="row">
            <div class="col-md-8">
                <h2>Add a new contact</h2>
            </div>
        </div>
        <form action="../bl/add_contact.php" method="post">
            <div class="form-group">
                <label for="contact_name">Name:</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="mail">Email (Optional):</label>
                <input type="email" class="form-control" id="mail" name="mail">
            </div>
            <div class="form-group">
                <label for="mail">Company (Optional):</label>
                <input type="text" class="form-control" id="company" name="company">
            </div>
            <div class="form-group">
                <label for="mail">Notes (Optional):</label>
                <input type="text" class="form-control" id="notes" name="notes">
            </div>
            <button name="add" type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</body>

</html>