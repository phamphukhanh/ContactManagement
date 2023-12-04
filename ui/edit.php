<!DOCTYPE html>
<html lang="en">
<?php
include_once "../classes/user.php";
include_once "../classes/contact.php";
include_once "../bl/get_contact.php";
// Kiểm tra xem có thông tin người dùng không
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    $displayName = $user->getFirstName();
}

if (isset($_SESSION["contact_info"])) {
    $contact = $_SESSION["contact_info"];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
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
                <a class="nav-link" href="#">View blocked list</a>
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
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8">
            <h2>Modify contact</h2>
        </div>
    </div>
    <form action="../bl/edit_contact.php" method="post">
        <div class="form-group">
            <label for="contact_name">Name:</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" maxlength="100" value="<?php echo $contact->getName() ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $contact->getPhone() ?>" required>
        </div>
        <div class="form-group">
            <label for="mail">Email (Optional):</label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $contact->getEmail() ?>">
        </div>
        <div class="form-group">
            <label for="mail">Company (Optional):</label>
            <input type="text" class="form-control" id="company" name="company" value="<?php echo $contact->getCompany() ?>">
        </div>
        <div class="form-group">
            <label for="mail">Notes (Optional):</label>
            <input type="text" class="form-control" id="notes" name="notes" value="<?php echo $contact->getNotes() ?>">
        </div>
        <button name="save" type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
</body>

</html>