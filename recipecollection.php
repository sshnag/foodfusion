<?php session_start();
include 'db/connection.php';

$per=6;
$pageno= isset($_GET['pageno']) ? max(1,intval($_GET['pageno'])): 1;
$offset= ($pageno-1)*$per;
$totalresult=$connection->query("SELECT COUNT(*) as total FROM recipe_collection WHERE is_deleted=0");
$totalrow=$totalresult->fetch_assoc()['total'];
$totlapg= ceil($totalrow/$per);
$sql= "SELECT * FROM recipe_collection WHERE is_deleted= 0 ORDER BY created_at DESC LIMIT $per OFFSET $offset";
$result= $connection->query($sql);
?>

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
    <?php while ($row= $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card recipe-card animate-fade-up h-100 ">
          <img src="<?= $row['image_path'] ?>" class="img-fluid rounded-top" alt="<?= htmlspecialchars($row['title'])?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
            <p class="card-text"><?=htmlspecialchars(substr($row['description'],0,90)) ?>...</p>
            <p>
            <span class="badge bg-primary"><?= $row['cuisine_type'] ?></span>
            <span class="badge bg-success bg-gradient"><?= $row['dietary_pref'] ?></span>
            <span class="badge bg-warning bg-gradient text-dark"><?= $row['difficulty_level'] ?></span>
            </p>
            <a href="recipedetails.php?id=<?= $row['id'] ?>" class="btn btn-outline-dark w-100 mt-2">View Recipe</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <nav>
    <ul class="pagination justify-content-center">
      <?php for($i =1; $i <=$totlapg; $i++): ?>
     <li class="page-item <?= $i == $pageno ? 'active' : '' ?>">
      <a href="?pageno=<?= $i ?>" class="page-link" <?= $i ?>></a>
     </li>
     <?php endfor;?>  
    </ul>
  </nav>
</section>

<?php include 'elements/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
