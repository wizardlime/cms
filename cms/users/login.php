<?php 

    include __DIR__ . '/../header.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['user_name'];
        $password = $_POST['user_password'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $statement->execute(['user_name' => $username]);
        $user = $statement->fetch();

        if($username && password_verify($password, $user['user_password'])) {
            $_SESSION['user'] = $user['user_name'];
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Username and/or email are incorrect.";
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