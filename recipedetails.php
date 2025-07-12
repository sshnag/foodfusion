<?php
include 'db/connection.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header('Location: recipecollection.php');
    exit;
}

// for main recipe
$stmt = $connection->prepare(
    "SELECT * FROM recipe_collection
     WHERE id = ? AND is_deleted = 0
     LIMIT 1"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$recipe = $stmt->get_result()->fetch_assoc();

if (!$recipe) {
    header('Location: recipecollection.php');
    exit;
}

// related recipe separate with the same cuisine type
$rel = $connection->prepare(
    "SELECT id, title, description, image_path
       FROM recipe_collection
      WHERE cuisine_type = ?
        AND id <> ?  AND is_deleted = 0
      ORDER BY RAND()
      LIMIT 3"
);
$rel->bind_param("si", $recipe['cuisine_type'], $id);
$rel->execute();
$related = $rel->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($recipe['title']) ?> | FoodFusion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/design.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Noto+Serif:wght@600&display=swap" rel="stylesheet">

</head>
<body>

<?php include 'elements/navigation.php'; ?>

<div class="container my-5">

<!-- for main recipe -->
  <div class="row g-5">
    <div class="col-md-6">
      <img src="<?= htmlspecialchars($recipe['image_path']) ?>"
           alt="<?= htmlspecialchars($recipe['title']) ?>"
           class="img-fluid rounded shadow">
    </div>

    <div class="col-md-6">
      <h2><?= htmlspecialchars($recipe['title']) ?></h2>
      <p><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>

      <div class="mt-3">
        <span class="badge bg-warning text-dark"><?= $recipe['cuisine_type'] ?></span>
        <span class="badge bg-success"><?= $recipe['dietary_pref'] ?></span>
        <span class="badge bg-secondary"><?= $recipe['difficulty_level'] ?></span>
      </div>

      <a href="recipecollection.php" class="btn btn-outline-dark mt-4">← Back to Recipes</a>
    </div>
  </div>

  <!-- related recipes -->
  <?php if ($related->num_rows): ?>
    <h4 class="mt-5 mb-4">Related Recipes</h4>
    <div class="row g-4">
      <?php while ($r = $related->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card recipe-card h-100">
            <img src="<?= htmlspecialchars($r['image_path']) ?>"
                 class="card-img-top"
                 alt="<?= htmlspecialchars($r['title']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($r['title']) ?></h5>
              <p class="card-text">
                <?= htmlspecialchars(mb_strimwidth($r['description'], 0, 80, '…')) ?>
              </p>
              <a href="recipe_details.php?id=<?= $r['id'] ?>" class="btn btn-warning w-100">
                View Recipe
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

</div>

<?php include 'elements/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
