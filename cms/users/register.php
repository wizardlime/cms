<?php
    session_start();
    include __DIR__ . '/../header.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_email = trim($_POST['user_email']);
        $user_name = trim($_POST['user_name']);
        $user_password = trim($_POST['user_password']);
    
        if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $error ="Email already exists!";
        } else if(strlen($user_password) < 6 ) {
            $error = "Password should atleast be 6 characters long.";
        } else {
            $statement = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_email = :user_email OR user_name = :user_name");
            $statement->execute(['user_email' => $user_email, 'user_name' => $user_name]);
            $count = $statement->fetchColumn();

            if($count > 0) {
                $error = "Email or username already exists";
            } else {
                $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
                $statement = $pdo->prepare("INSERT INTO users(user_email, user_name, user_password) VALUES(:user_email, :user_name, :user_password)");
                $statement->execute([
                    'user_email' => $user_email,
                    'user_name' => $user_name,
                    'user_password' => $hashedPassword
                ]);

                $_SESSION['user_name'] = $user_name;
                header('Location: ../dashboard.php');
                exit();

            }
        }
        
    }

?>

<form method="post">
    <h2>Create new user </h2>
  <div class="mb-3">
    <label for="user_email" class="form-label">Email address:</label>
    <input type="email" class="form-control" name="user_email">
  </div>
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