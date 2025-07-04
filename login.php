<?php
session_start();

// Retrieve errors from URL
$loginError = $_GET['loginError'] ?? '';
$emailValue = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css"> <!-- Adjust this path -->
</head>
<body>

<?php include 'elements/navigation.php'; ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="login-form-box p-4 shadow rounded bg-white" style="max-width: 400px; width: 100%;">
    <h2 class="text-center mb-4">Login</h2>

    <?php if ($loginError): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
    <?php endif; ?>

    <form method="POST" action="loginprocess.php">
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($emailValue) ?>">
      </div>

      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>

      <button type="submit" class="btn btn-warning w-100">Log In</button>
      <button type="reset" class="btn btn-secondary w-100 mt-2">Clear</button>
    </form>
  </div>
</div>

<?php include 'elements/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
