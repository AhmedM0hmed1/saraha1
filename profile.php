<?php
include 'db.php';
if (!isset($_GET['user'])) die("المستخدم غير موجود.");
$username = $_GET['user'];
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) die("المستخدم غير موجود.");
$stmt->bind_result($user_id);
$stmt->fetch();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg = trim($_POST['message']);
    if (!empty($msg)) {
        $insert = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $insert->bind_param("is", $user_id, $msg);
        $insert->execute();
    }
}
?>
<h2>أرسل رسالة إلى <?php echo htmlspecialchars($username); ?></h2>
<form method="POST">
    <textarea name="message" required></textarea><br>
    <button type="submit">إرسال</button>
</form>