<?php
    session_start();

    $error      = $_GET['error'] ?? '';
    $firstName  = $_GET['first_name'] ?? '';
    $lastName   = $_GET['last_name'] ?? '';
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="icon" type="image/png" href="images/food.png">
  <link rel="stylesheet" href="css/design.css" />
</head>
<body>
  <?php include 'elements/navigation.php'; ?>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="p-4 shadow rounded bg-white" style="max-width: 400px; width: 100%;">
      <h2 class="text-center mb-4">Join FoodFusion</h2>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="registerprocess.php" method="POST" novalidate>
        <div class="mb-3">
          <input
            type="text"
            name="first_name"
            class="form-control"
            placeholder="First Name"
            value="<?php echo htmlspecialchars($firstName) ?>"

          />
        </div>
        <div class="mb-3">
          <input
            type="text"
            name="last_name"
            class="form-control"
            placeholder="Last Name"
            value="<?php echo htmlspecialchars($lastName) ?>"

          />
        </div>
        <div class="mb-3">
          <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Email"
            value="<?php echo htmlspecialchars($emailValue) ?>"

          />
        </div>
        <div class="mb-3">
          <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"

          />
        </div>
        <div class="g-recaptcha mb-3" data-sitekey="6LcOF3grAAAAAP6_Vs9qQ1yDeDPyLr5S4bfX2Tmj"></div>
        <button type="submit" class="btn btn-warning w-100">Register</button>
        <button type="reset" class="btn btn-secondary w-100 mt-2">Clear</button>
      </form>
    </div>
  </div>

  <?php include 'elements/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
