<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us | FoodFusion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/design.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'elements/navigation.php'; ?>

<!--  Page Header -->
<section class="bg-light py-5 text-center">
  <div class="container">
    <h1 class="fw-bold">About FoodFusion</h1>
    <p class="lead">Our journey, philosophy, and the people behind the flavor.</p>
  </div>
</section>

<!--  Our Mission -->
<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-6 mb-4 mb-md-0">
      <img src="images/mission-cooking.jpg" class="img-fluid rounded shadow" alt="Our Mission">
    </div>
    <div class="col-md-6">
      <h2 class="fw-bold mb-3">Our Mission</h2>
      <p>FoodFusion was born from the love of home cooking. We believe in empowering everyday cooks to create, share, and connect through food. Our platform is a place where passion meets tradition, creativity meets culture, and flavors unite people across the world.</p>
      <p>Whether you're new to cooking or a seasoned foodie, FoodFusion is your space to learn, inspire and be inspired.</p>
    </div>
  </div>
</section>

<!-- Our Team -->
<section class="bg-light py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Meet the Team</h2>
    <div class="row g-4 justify-content-center">
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <img src="images/team1.jpg" class="card-img-top" alt="Founder">
          <div class="card-body">
            <h5 class="card-title">Suha</h5>
            <p class="card-text">Founder & Recipe Curator</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <img src="images/team2.jpg" class="card-img-top" alt="Developer">
          <div class="card-body">
            <h5 class="card-title">Ryan Daniel</h5>
            <p class="card-text">Web Developer</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm border-0">
          <img src="images/team3.jpg" class="card-img-top" alt="Community Lead">
          <div class="card-body">
            <h5 class="card-title">Rachel Coover</h5>
            <p class="card-text">Community Manager</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'elements/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
