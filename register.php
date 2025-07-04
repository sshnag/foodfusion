<?php
session_start();

$error = $_GET['error'] ?? '';
$firstName = $_GET['first_name'] ?? '';
$lastName = $_GET['last_name'] ?? '';
$emailValue = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - FoodFusion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="/css/style.css" />
</head>
<body>
  <?php include 'elements/navigation.php'; ?>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4 shadow rounded bg-white" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4">Join FoodFusion</h2>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="registerprocess.php" method="POST" novalidate>
        <div class="mb-3">
          <input
            type="text"
            name="first_name"
            class="form-control"
            placeholder="First Name"
            value="<?= htmlspecialchars($firstName) ?>"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="text"
            name="last_name"
            class="form-control"
            placeholder="Last Name"
            value="<?= htmlspecialchars($lastName) ?>"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Email"
            value="<?= htmlspecialchars($emailValue) ?>"
            required
          />
        </div>
        <div class="mb-3">
          <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required
          />
        </div>
        <button type="submit" class="btn btn-warning w-100">Register</button>
        <button type="reset" class="btn btn-secondary w-100 mt-2">Clear</button>
      </form>
    </div>
  </div>

  <?php include 'elements/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
