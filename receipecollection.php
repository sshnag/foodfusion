<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Recipe Collection | FoodFusion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/design.css">
    <link rel="icon" type="image/png" href="images/food.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'elements/navigation.php'; ?>

<section class="py-5 text-center bg-light">
  <div class="container">
    <h1 class="fw-bold mb-3">Explore Recipes</h1>
    <p class="lead">Find your next meal inspiration from our global kitchen.</p>
  </div>
</section>

<section class="container py-5">
  <div class="row g-4">
    <?php for ($i = 1; $i <= 6; $i++): ?>
      <div class="col-md-4">
        <div class="recipe-card animate-fade-up">
          <img src="images/recipe<?= $i ?>.jpg" class="img-fluid rounded-top" alt="Recipe <?= $i ?>">
          <div class="p-3">
            <h5 class="fw-bold">Delicious Recipe <?= $i ?></h5>
            <p class="small text-muted">Cuisine: <span class="badge bg-warning text-dark">Asian</span> | Difficulty: <span class="badge bg-info text-dark">Easy</span></p>
            <p class="text-muted">A quick and tasty dish perfect for weeknights. Loaded with flavor and family-approved.</p>
            <a href="#" class="btn btn-outline-dark btn-sm">View Recipe</a>
          </div>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</section>

<?php include 'elements/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
