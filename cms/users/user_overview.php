<?php 
include __DIR__ . '/../header.php'; 
include __DIR__ . '/../includes/auth.php'; 


$user_id = $_GET['user_id'];
$selectUser = "SELECT * FROM users WHERE user_id = :user_id";
$statement = $pdo->prepare($selectUser);
$statement->execute([':user_id' => $user_id]);
$user = $statement->fetch(PDO::FETCH_OBJ);

?>

<body class="bg-dark text-white">
<div class="container my-5 d-flex flex-column align-items-center">

  <div class="card text-center w-100 mb-4" style="max-width: 600px; background-color: #001d3d;">

  <div class="card shadow-lg w-100" style="max-width: 500px; background-color: #001d3d;">
    <div class="card-body text-center">
      <?php if($user): ?> 
        <h2 class="mb-2"><?= htmlspecialchars($user->user_name) ?></h2>
        <h5 class="mb-4"><?= htmlspecialchars($user->user_email) ?></h5>

        <div class="d-flex justify-content-center gap-2 flex-wrap">
          <a href="user_edit.php?user_id=<?= $user->user_id ?>" class="btn btn-warning">
            <i class="bi bi-pencil-fill"></i> Edit
          </a>
          <a href="user_delete.php?user_id=<?= $user->user_id ?>" class="btn btn-danger">
            <i class="bi bi-bin-fill"></i> Delete
          </a>
        </div>
      <?php endif ?>
    </div>
  </div>  
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
  color: #001d3d;
}

.btn-warning:hover {
  background-color: #e0a800;
  border-color: #d39e00;
}

.



