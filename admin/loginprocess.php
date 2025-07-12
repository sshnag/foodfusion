<?php
session_start();
include '../db/connection.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: login.php?loginError=Please fill in all fields&email=" . urlencode($email));
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.php?loginError=Invalid email format&email=" . urlencode($email));
    exit;
}

$stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: login.php?loginError=No account found&email=" . urlencode($email));
    exit;
}

if ($user['failed_attempts'] >= 3 && strtotime($user['lock_time']) + 180 > time()) {
    header("Location: login.php?loginError=Account locked. Try again in 3 minutes&email=" . urlencode($email));
    exit;
}

if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $connection->query("UPDATE users SET failed_attempts = 0, lock_time = NULL WHERE id = {$user['id']}");
    header("Location: index.php");
    exit;
} else {
    $new_attempts = $user['failed_attempts'] + 1;
    $lock_sql = ($new_attempts >= 3) ? ", lock_time = NOW()" : "";
    $connection->query("UPDATE users SET failed_attempts = $new_attempts $lock_sql WHERE id = {$user['id']}");
    header("Location: login.php?loginError=Incorrect password ($new_attempts/3)&email=" . urlencode($email));
    exit;
}
?>
