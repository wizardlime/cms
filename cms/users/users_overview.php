<?php 

    include __DIR__ . '/../header.php'; 
    $selectAllUsers = "SELECT * FROM users";
    $statement = $pdo->query($selectAllUsers);
    $users = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

?>

<body class="container">
<div class="card text-center w-full">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" href="../dashboard.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reservations_overview.php">Reservations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./rooms/rooms_overview.php">Rooms</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./users/users_overview.php">Users</a>
      </li>
    </ul>
  </div>
</div>
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

