<?php
include 'db.php';
$result = $conn->query("
    SELECT u.username, COUNT(m.id) AS message_count
    FROM users u
    LEFT JOIN messages m ON u.id = m.user_id
    GROUP BY u.id
    ORDER BY message_count DESC
");
echo "<h2>عدد الرسائل لكل مستخدم</h2>";
echo "<table border='1'><tr><th>اسم المستخدم</th><th>عدد الرسائل</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td><a href='profile.php?user=" . $row['username'] . "'>" . $row['username'] . "</a></td><td>" . $row['message_count'] . "</td></tr>";
}
echo "</table>";
?>