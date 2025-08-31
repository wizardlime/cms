<?php 

    
include __DIR__ . '/../header.php'; 
include __DIR__ . '/../includes/auth.php'; 


$user_id = $_POST['user_id'] ?? $_GET['user_id'] ?? null;



$selectUser = "SELECT * FROM users WHERE user_id = :user_id";
$statement = $pdo->prepare($selectUser);
$statement->execute([':user_id' => $user_id]);
$user = $statement->fetch(PDO::FETCH_OBJ);


if(!$user) {
    die("Reservation has not been found.");
}



if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users SET user_name = :user_name, user_email = :user_email, user_password = :user_password WHERE user_id = :user_id";
    $statement = $pdo->prepare($query);

    if($statement->execute([

      'user_id' => $user_id,
      ':user_name' => $user_name,
      ':user_email' => $user_email,
      ':user_password' => $user_password

      ])) {
        header('Location: ./users_overview.php');
        $message = "User has been updated.";
    } else {
        echo "Error: User doesn't exist.";
    }

}

?>

<div class="container my-5 d-flex justify-content-center">
  <div class="card shadow-lg w-100" style="max-width: 500px; background-color: #001d3d; color: white;">
    <div class="card-body">
      <h2 class="mb-4 text-center">Edit User #<?= $user->user_id ?></h2>

      <form method="post" class="d-flex flex-column gap-3">
        <div class="mb-3">
          <label for="user_email" class="form-label">Email address:</label>
          <input type="email" class="form-control" name="user_email" value="<?= htmlspecialchars($user->user_email) ?>" required>
        </div>

        <div class="mb-3">
          <label for="user_name" class="form-label">Username:</label>
          <input type="text" class="form-control" name="user_name" value="<?= htmlspecialchars($user->user_name) ?>" required>
        </div>

        <div class="mb-3">
          <label for="user_password" class="form-label">Password:</label>
          <input type="password" class="form-control" name="user_password" value="<?= htmlspecialchars($user->user_password) ?>" required>
        </div>

        <input type="submit" class="btn btn-primary w-100" name="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

<style>
.card {
  border-radius: 0.75rem;
}

.form-control {
  background-color: #002244;
  color: white;
  border: 1px solid #003366;
}

.form-control:focus {
  border-color: #00bfa6;
  box-shadow: none;
  background-color: #002244;
  color: white;
}

.btn-primary {
  background-color: #00bfa6;
  border-color: #00bfa6;
}

.btn-primary:hover {
  background-color: #00a28f;
  border-color: #00a28f;
}

@media (max-width: 576px) {
  .card-body {
    padding: 1.5rem 1rem;
  }
}
</style>



