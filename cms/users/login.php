<?php 

    include __DIR__ . '/../header.php';
    include __DIR__ . '/../includes/messages.php';


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      $username = trim($_POST['user_name'] ?? '');
      $password = $_POST['user_password'];

      if(empty($username) || empty($password)) {
          $_SESSION['error'] = "Invalid username and/or password.";
          header('Location: login.php');
          exit();

      } else {
        $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name LIMIT 1");
        $statement->execute(['user_name' => $username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['user_password'])) {
          $_SESSION['user'] = $user['user_name'];
          $_SESSION['user_id'] = $user['user_id'];
          header('Location: ../dashboard.php');
          exit(); 
        } else {
          echo "<div class='alert alert-danger'>Invalid username and/or password.</div>";
        }

      }


    }

?>


<form method="post">
    <h2>Login </h2>
  <div class="mb-3">
    <label for="user_name" class="form-label">Username:</label>
    <input type="text" class="form-control" name="user_name">
  </div>
  <div class="mb-3">
    <label for="user_password" class="form-label">Password:</label>
    <input type="password" class="form-control" name="user_password">
  </div>
  <input type="submit" class="btn btn-primary" name="submit">Submit</input>
</form>