<?php
$host = "mysql";
$db   = getenv("MYSQL_DATABASE");
$user = getenv("MYSQL_USER");
$pass = getenv("MYSQL_PASSWORD");

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>User Liste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>User aus der Datenbank</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row["id"]) ?></td>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
