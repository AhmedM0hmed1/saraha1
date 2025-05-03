<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "تم التسجيل بنجاح.";
    } else {
        echo "فشل في التسجيل.";
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="اسم المستخدم" required><br>
    <input type="password" name="password" placeholder="كلمة المرور" required><br>
    <button type="submit">تسجيل</button>
</form>