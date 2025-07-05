<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FoodFusion | Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/design.css"> 
  <link rel="icon" type="image/png" href="images/food.png">

  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'elements/navigation.php'; ?>

<!-- header section -->
<section class="hero d-flex align-items-center justify-content-center text-center text-white">
  <div class="overlay"></div>
  <div class="container position-relative">
    <h1 class="display-4 fw-bold">Welcome to FoodFusion</h1>
    <p class="lead">Discover world recipes, share your passion, and connect with food lovers.</p>
    <a href="#" class="btn btn-warning btn-lg mt-3 me-2" data-bs-toggle="modal" data-bs-target="#joinModal">Join Us Now</a>
    <a href="recipecollection.php" class="btn btn-outline-light btn-lg mt-3">Explore Recipes</a>
  </div>
</section>

<!-- intro section -->
<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h2 class="fw-bold">Why FoodFusion?</h2>
      <p>We celebrate home chefs and culinary creativity. Whether you're into quick meals or traditional dishes, join our mission to make cooking joyful and accessible.</p>
      <a href="about.php" class="btn btn-outline-dark">Learn More</a>
    </div>
    <div class="col-md-6">
      <img src="images/about-preview.jpg" class="img-fluid rounded shadow" alt="About Preview">
    </div>
  </div>
</section>

<!--  join us modal -->
<div class="modal fade" id="joinModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title">Join FoodFusion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="registerprocess.php" method="POST">
        <div class="modal-body">
          <input type="text" name="first_name" class="form-control mb-2" placeholder="First Name" required>
          <input type="text" name="last_name" class="form-control mb-2" placeholder="Last Name" required>
          <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
          <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        </div>
        <div class="modal-footer">
          <button type="submit" name="btnregister" class="btn btn-warning w-100">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'elements/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
