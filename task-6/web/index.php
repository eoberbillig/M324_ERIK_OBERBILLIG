<?php
$host = "mysql";
$db   = getenv("MYSQL_DATABASE");
$user = getenv("MYSQL_USER");
$pass = getenv("MYSQL_PASSWORD");

/* Retry DB Connection */
for ($i = 0; $i < 10; $i++) {
    try {
        $conn = new mysqli($host, $user, $pass, $db);
        break;
    } catch (mysqli_sql_exception $e) {
        sleep(2);
    }
}
if (!isset($conn)) die("DB nicht erreichbar");

/* ADD user */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add"])) {
    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST["name"], $_POST["email"]);
    $stmt->execute();
}

/* UPDATE user */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST["name"], $_POST["email"], $_POST["id"]);
    $stmt->execute();
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>User Verwaltung</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<header>
  <h1>👤 User Verwaltung</h1>
  <button id="themeToggle" class="toggle">🌙 Dark</button>
</header>

<!-- ADD FORM -->
<form class="glass form" method="post">
  <h2>➕ Neuer User</h2>
  <input name="name" placeholder="Name" required>
  <input name="email" placeholder="Email" required>
  <button name="add">Hinzufügen</button>
</form>

<!-- SEARCH -->
<input id="search" class="search" placeholder="🔍 Suche nach Name oder Email">

<!-- TABLE -->
<table>
<thead>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Aktion</th></tr>
</thead>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row["id"] ?></td>
<td><?= htmlspecialchars($row["name"]) ?></td>
<td><?= htmlspecialchars($row["email"]) ?></td>
<td>
<button onclick="editUser(<?= $row['id'] ?>,'<?= $row['name'] ?>','<?= $row['email'] ?>')">✏</button>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<!-- UPDATE MODAL -->
<div id="modal" class="modal">
<form class="glass form" method="post">
  <h2>✏ User bearbeiten</h2>
  <input type="hidden" name="id" id="edit-id">
  <input name="name" id="edit-name" required>
  <input name="email" id="edit-email" required>
  <button name="update">Speichern</button>
  <button type="button" onclick="closeModal()">Abbrechen</button>
</form>
</div>
</div>

<script src="script.js"></script>
</body>
</html>
