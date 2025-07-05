<?php
include('db/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = trim($_POST['first_name'] ?? '');
    $lname = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $captchaResponse = $_POST['g-recaptcha-response'] ?? '';

    // Basic validation
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        header("Location: register.php?error=All fields are required");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=Invalid email format");
        exit;
    }

    if (strlen($password) < 6) {
        header("Location: register.php?error=Password must be at least 6 characters");
        exit;
    }

    // recaptcha Validation
    if (!$captchaResponse) {
        header("Location: register.php?error=Please complete the CAPTCHA");
        exit;
    }

    $secretKey = '6LcOF3grAAAAAP6_Vs9qQ1yDeDPyLr5S4bfX2Tmj'; 
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        header("Location: register.php?error=CAPTCHA verification failed");
        exit;
    }

    // Check if email already exists
    $check = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header("Location: register.php?error=Email already exists");
        exit;
    }

    // Register
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $hashed);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        header("Location: register.php?error=Something went wrong");
    }
}
?>
