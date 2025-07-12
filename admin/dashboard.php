<?php
session_start();
include('check_admin.php');
include('../db/connection.php');


// Getting download count per category
$users = [];
$sql = "SELECT users.name AS category_name, SUM(b.download_count) AS total_downloads 
        FROM booktb b
        JOIN categorytb c ON b.category_id = c.id
        GROUP BY c.name";
$result = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $categoryDownloads[] = $row;
}

// counting the number of requets
$query = mysqli_query($connection, "SELECT COUNT(*) as count FROM request");
$row = mysqli_fetch_array($query);
$request_count = $row['count'];

// counting the number of books
$bquery = mysqli_query($connection, "SELECT COUNT(*) AS bcount FROM booktb WHERE is_deleted=0");
$brow = mysqli_fetch_array($bquery);
$book_count = $brow['bcount'];

//counting the number of downloads
$dquery = mysqli_query($connection, "SELECT SUM(download_count) as dcount FROM booktb");
$drow = mysqli_fetch_array($dquery);
$download_count = $drow['dcount'];

//setting up for pagination
$recordperpage = 5;
$currentpage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startfrom = ($currentpage - 1) * $recordperpage;

$sql = "SELECT booktb.*, authortb.firstname,authortb.middlename,authortb.lastname, categorytb.name FROM ((booktb INNER JOIN authortb ON booktb.authorid= authortb.id) INNER JOIN categorytb ON booktb.category_id= categorytb.id)
        WHERE booktb.is_deleted = 0
        ORDER BY download_count DESC
        LIMIT $startfrom, $recordperpage";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../images/book.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
         <link rel="stylesheet" href="../style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
<div class="container-fluid">
  <div class="row">
<div class="col-md-2 col-12 sidebar d-flex flex-column flex-md-column">
      <div class="text-center mb-4">
      
      </div>
      <nav>
       <ul class="list-unstyled">
  <li class="active"><a href="admindashboard.php"><i class="fa-solid fa-home me-2"></i>Dashboard</a></li>
  <li><a href="adminbook.php"><i class="fa-solid fa-book me-2"></i>Books</a></li>
      <li><a href="adminauthor.php"><i class="fa-solid fa-pen-fancy me-2"></i></i>Author</a></li>
  <li><a href="adminrequest.php"><i class="fa-solid fa-file-lines me-2"></i>Request</a></li>
  <li><a href="admincategory.php"><i class="fa-solid fa-star me-2"></i>Category</a></li>
  <li><a href="../index.php"><i class="fa-solid fa-sign-out-alt me-2"></i>Sign out</a></li>
</ul>

      </nav>
      
    </div>

    <div class="col-md-10 p-4">
      <h1 class="mb-4">Dashboard</h1>

      <!--displaying the charts--->
      <div class="row justify-content-center mb-5">
        <div class="col-md-6">
          <canvas id="dashboardChart"></canvas>
        </div>
        <div class="col-md-6">
          <canvas id="barChart"></canvas>
        </div>
      </div>
   <!--- Book table--->
      <div class="recent-books">
        <h2>Most Downloaded Books List</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['title']}</td>
                          <td>{$row['firstname']} {$row['middlename']} {$row['lastname']}</td>
                          <td>
                        <a href='adminbook_detail.php?id={$row['id']}' class='btn view-btn'>View</a>
                            <a href='editbooks.php?id={$row['id']}' class='btn btn-primary edit-btn'>Edit</a>
<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='delete.php?id=".$row['id']."'   class='btn btn-danger delete-btn' name='btndelete'>Delete</a>                          
                          </td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='7' class='text-center'>No books found.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>


      <!--pagination-->
      <?php
      $count_result = $connection->query("SELECT COUNT(*) AS total FROM booktb WHERE is_deleted = 0");
      $row = $count_result->fetch_assoc();
      $totalRecords = $row['total'];
      $totalPages = ceil($totalRecords / $recordperpage);

      echo "<div class='pagination d-flex justify-content-center mt-4 flex-wrap'>";
      if ($currentpage > 1) {
        $prevPage = $currentpage - 1;
        echo "<a class='btn btn-outline-dark mx-1' href='?page=$prevPage'>Previous</a>";
      }
      for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentpage) {
          echo "<span class='btn btn-dark mx-1'>$i</span>";
        } else {
          echo "<a class='btn btn-outline-dark mx-1' href='?page=$i'>$i</a>";
        }
      }
      if ($currentpage < $totalPages) {
        $nextPage = $currentpage + 1;
        echo "<a class='btn btn-outline-dark mx-1' href='?page=$nextPage'>Next</a>";
      }
      echo "</div>";
      ?>
    </div>
  </div>
</div>

<!--- Doughnut chart and bar chart--->

<!--doughnut chart-->
<script>
const bookCount = <?php echo $book_count; ?>;
const requestCount = <?php echo $request_count; ?>;
const downloadCount = <?php echo $download_count; ?>;

const doughnut = document.getElementById('dashboardChart').getContext('2d');
const dashboardChart = new Chart(doughnut, {
  type: 'doughnut',
  data: {
    labels: ['Books', 'Requests', 'Downloads'],
    datasets: [{
      data: [bookCount, requestCount, downloadCount],
      backgroundColor: ['#4bc0c0', '#ffcd56', '#ff6384'],
      borderColor: ['#43acac', '#ffe6aa', '#ffb1c1'],
      borderWidth: 5
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'bottom'
      },
      title: {
        display: true,
        text: 'Overview of Bookie Activity'
      }
    }
  }
});
</script>

<script>
const categoryLabels = <?php echo json_encode(array_column($categoryDownloads, 'category_name')); ?>;
const downloadCounts = <?php echo json_encode(array_column($categoryDownloads, 'total_downloads')); ?>;



// Bar Chart
const bar = document.getElementById('barChart').getContext('2d');
new Chart(bar, {
  type: 'bar',
  data: {
    labels: categoryLabels,
    datasets: [{
      label: 'Downloads per Category',
      data: downloadCounts,
      backgroundColor: 'rgb(255, 205, 148)',
      borderColor: 'rgb(255, 111, 0)',
      borderWidth: 3
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          precision: 0 // No decimal points
        }
      }
    }
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
