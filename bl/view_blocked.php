<?php
include_once "../dal/contact_dal.php";

$contactDAL = new contact_dal();

// Dựa trên thông tin người dùng của session hiện tại
if (isset($_SESSION["user_info"])) {
    $user = $_SESSION["user_info"];
    // Lấy danh sách dựa trên ID người dùng làm khóa ngoại
    $list = $contactDAL->getContacts($user->getUserID(), 1);
    // Nếu có dữ liệu thì hiển thị bảng ra
    // echo $user;
    if (count($list) > 0) {
        // Tiêu đề cột
        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
        // Số thứ tự
        $i = 1;
        foreach ($list as $contact) {
            // Nguyên đống này là lấy dữ liệu
            echo
            "<tr>
                    <td>" . $i . "</td>
                    <td>" . $contact->getName() . "</td>
                    <td>" . $contact->getPhone() . "</td>
                    <td>" . $contact->getEmail() . "</td>
                    <td>" . $contact->getCompany() . "</td>
                    <td>" . $contact->getNotes() . "</td>
                    <td>
                        <button type='button' class='btn btn-primary' onclick=\"window.location.href='../ui/edit.php?contact_id=" . $contact->getContactID() . "'\">
                            <i class=\"fa-solid fa-pen-to-square fa-lg\"></i>
                        </button>
                        <button type='button' class='btn btn-danger' data-confirm='Are you sure you want to delete this contact?' 
                            onclick=\"
                            if (confirm(this.getAttribute('data-confirm'))) { 
                                window.location.href='../bl/delete_contact.php?contact_id=" . $contact->getContactID() . "'; 
                            }
                            \">
                            <i class=\"fa-solid fa-trash fa-lg\"></i>
                        </button>
                        <button type='button' class='btn btn-secondary' data-confirm='Are you sure you want to unblock this contact?' 
                            onclick=\"
                            if (confirm(this.getAttribute('data-confirm'))) { 
                                window.location.href='../bl/unblock_contact.php?contact_id=" . $contact->getContactID() . "'; 
                            }
                            \">
                            <i class=\"fa-solid fa-turn-up fa-lg\" style=\"color: #ffffff;\"></i>
                        </button>
                    </td>
                </tr>";
            $i++;
        }
        echo '</tbody>
        </table>';
    } else {
        echo "No contacts yet";
    }
}
