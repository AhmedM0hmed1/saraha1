<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT message, created_at FROM messages WHERE user_id = $user_id ORDER BY created_at DESC");
echo "<h2>الرسائل الخاصة بك:</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div style='border:1px solid #ccc;margin:10px;padding:10px;'>";
    echo "<p>" . htmlspecialchars($row['message']) . "</p>";
    echo "<small>" . $row['created_at'] . "</small>";
    echo "</div>";
}
?>
<a href="logout.php">تسجيل الخروج</a>