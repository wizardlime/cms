<?php
    include __DIR__ . '/../header.php';
    include __DIR__ . '/../includes/messages.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_email = trim($_POST['user_email']);
        $user_name = trim($_POST['user_name']);
        $user_password = trim($_POST['user_password']);
    
        if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Fill in correct email.";
            header('Location: ../dashboard.php');
            exit();
        } else if(strlen($user_password) < 6 ) {
            $_SESSION['error'] = "Password should be atleast 6 characters long.";
        } else {
            $statement = $pdo->prepare("SELECT COUNT(*) FROM users WHERE user_email = :user_email OR user_name = :user_name");
            $statement->execute(['user_email' => $user_email, 'user_name' => $user_name]);
            $count = $statement->fetchColumn();

            if($count > 0) {
                $_SESSION['error'] = "Email and/or username already exists.";
                header('Location: ../dashboard.php');
                exit();    
            } else {
                $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
                $statement = $pdo->prepare("INSERT INTO users(user_email, user_name, user_password) VALUES(:user_email, :user_name, :user_password)");
                $statement->execute([
                    'user_email' => $user_email,
                    'user_name' => $user_name,
                    'user_password' => $hashedPassword
                ]);

                $_SESSION['user'] = $user_name;
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['message'] = "User registered correctly.";
                header("Location: ../dashboard.php");
                exit();

            }
        }
        
    }

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php">Hotel CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="../dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../reservations/reservations_overview.php">Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../rooms/rooms_overview.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../users/users_overview.php">Users</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-warning fw-semibold" href="../users/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" class="p-4 bg-light rounded shadow-sm" style="max-width: 500px; margin: auto;">
    <h2 class="mb-4 text-center">Register</h2>

    <div class="mb-3">
        <label for="user_email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter your email" required>
    </div>

    <div class="mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Choose a username" required>
    </div>

    <div class="mb-3">
        <label for="user_password" class="form-label">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Enter password" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>
