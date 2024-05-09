<?php
include('header.php');
include('../../login/database/databaseconfig.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];

    // Check if the email exists in the database
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    if ($result_check->num_rows > 0) {
        // Email exists, update the password
        $sql_update = "UPDATE users SET password = ? WHERE email = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", password_hash($new_password, PASSWORD_DEFAULT), $email);
        if ($stmt_update->execute()) {
            echo "Password updated successfully";
            header("Location: ../index.php");
        } else {
            echo "Error updating password: " . $conn->error;
        }
        $stmt_update->close();
    } else {
        echo "Email not found";
    }
    $stmt_check->close();
} else {

    echo '<section class="content pass">
    <div class="fp_password">
        <div><h1><b>Forget Password </b></h1></div>
        <div>
        <table>
            <form method="post" action="?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ">
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="text" name="email" required><br></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="password" required><br></td>
                </tr>
                <tr>
                    <td><label>Confirm New Password</label></td>
                    <td><input type="password" name="new_password" required><br></td>
                </tr>
                <tr><td colspan="2"><input type="submit" value="Update Password" style="background-color:lightblue;"></td></tr>
            </form>
        </table>
        </div>
    </div>
    </section>';
}
include('footer.php');