<?php 
include __DIR__ . '/../header.php'; 

$user_id = $_GET['user_id'];
$selectUser = "SELECT * FROM users WHERE user_id = :user_id";
$statement = $pdo->prepare($selectUser);
$statement->execute([':user_id' => $user_id]);
$user = $statement->fetch(PDO::FETCH_OBJ);

?>

<body class="container">
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" href="../dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reservations_overview.php">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../rooms/rooms_overview.php">Rooms</a>
      </li>
    </ul>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <?php if($user): ?> 
        <h2><?php echo $user -> user_name ?></h2>
        <h2><?php echo $user -> user_email ?></h2>
        <a href="user_edit.php?user_id=<?= $user -> user_id ?>"class="btn btn-warning" role="button"><i class="bi bi-pencil-fill"></i>Edit</a>
        <a href="user_delete.php?user_id=<?= $user -> user_id ?>"class="btn btn-danger" role="button"><i class="bi bi-bin-fill"></i>Delete</a>

        <?php endif ?>
  </div>
</div>  
</body>


