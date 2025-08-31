<?php
    
    include __DIR__ . '/../header.php';
    include __DIR__ . '/../includes/auth.php'; 


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


 <section class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-11 col-sm-8 col-md-6 col-lg-4">
      <div class="card shadow p-4">
        <h4 class="mb-4 text-center">Create new user:</h4>
        <form method="post">
          <div class="mb-3">
            <label for="registerName" class="form-label">Email address:</label>
            <input type="email" class="form-control" id="emailAddress" required>
          </div>
          <div class="mb-3">
            <label for="user_name" class="form-label">Username:</label>
            <input type="text" class="form-control" name="user_name" required>
          </div>
          <div class="mb-3">
            <label for="user_password" class="form-label">Password:</label>
            <input type="password" class="form-control" name="user_password" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
      </div>
    </div>
  </section>
