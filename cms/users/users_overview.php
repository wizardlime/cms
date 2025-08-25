<?php 

    include __DIR__ . '/../header.php'; 
    $selectAllUsers = "SELECT * FROM users";
    $statement = $pdo->query($selectAllUsers);
    $users = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

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
          <a class="nav-link" href="users/users_overview.php">Users</a>
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


<div class="add_link"><a href='./users/register.php'>Create new user</a></div>
  <?php if(!empty($message)): ?>
  <?php echo $message; ?>
<?php endif ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="text-center bold">User ID</th>
            <th scope="col" class="text-center bold">User email</th>
            <th scope="col" class="text-center bold">User name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <th scope="row"><?php echo $user->user_id; ?></th>
                <td class="text-center"><?php echo $user->user_email; ?> </td>
                <td class="text-center"><?php echo $user->user_name; ?> </td>
                <td class="text-center"><a href="./user_overview.php?user_id=<?= $user -> user_id ?>">See more</a></td>
            </tr>
        <?php endforeach ?> 
    </tbody>
</table>    
</body>

