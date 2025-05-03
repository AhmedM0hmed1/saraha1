<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashed);
        $stmt->fetch();
        if (password_verify($password, $hashed)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }
    echo "بيانات غير صحيحة.";
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="اسم المستخدم" required><br>
    <input type="password" name="password" placeholder="كلمة المرور" required><br>
    <button type="submit">دخول</button>
</form>