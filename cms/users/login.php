<?php 

    session_start();
    include __DIR__ . '/../header.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['user_name'];
        $password = $_POST['user_password'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name");
        $statement->execute(['user_name' => $username]);
        $user = $statement->fetch();

        if($username && password_verify($password, $user['user_password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user'] = $user['user_name'];
            header('Location: ../dashboard.php');
            exit();
        } else {
            $error = "Username and/or password are incorrect.";
        }
        if ($user && password_verify($password, $user['user_password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user'] = $user['user_name'];

            header("Location: ../dashboard.php");
            exit();
}


    }

?>


<section class="d-flex align-items-center justify-content-center min-vh-100">
  <div class="col-11 col-sm-8 col-md-6 col-lg-4">
    <div class="card shadow p-4">

      <h4 class="mb-4 text-center">Login</h4>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $success ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

     
      <form method="post">
        <div class="mb-3">
          <label for="userName" class="form-label">Username</label>
          <input type="text" class="form-control" id="userName" placeholder="Username" name="user_name" required>
        </div>
        <div class="mb-3">
          <label for="loginPassword" class="form-label">Password</label>
          <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="user_password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>

    </div>
  </div>
</section>




