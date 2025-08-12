<?php 

    
include __DIR__ . '/../header.php'; 

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
<form method="post">
  <div class="mb-3">
    <label for="user_email" class="form-label">Email address:</label>
    <input type="email" class="form-control" name="user_email" value="<?= $user->user_email?>">
  </div>
  <div class="mb-3">
    <label for="user_name" class="form-label">Username:</label>
    <input type="text" class="form-control" name="user_name" value="<?= $user->user_name?>">
  </div>
  <div class="mb-3">
    <label for="user_password" class="form-label">Password:</label>
    <input type="password" class="form-control" name="user_password" value="<?= $user-> user_password?>">
  </div>

  <input type="submit" class="btn btn-primary" name="submit">Submit</input>
</form>

</body>
