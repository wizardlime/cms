<?php 

    include __DIR__ . '/../header.php';
    include __DIR__ . '/../includes/auth.php'; 
 
    $selectAllUsers = "SELECT * FROM users";
    $statement = $pdo->query($selectAllUsers);
    $users = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

?>

<section class="d-flex flex-column align-items-center justify-content-center min-vh-100 p-3">

  
  <div class="d-flex justify-content-end w-100 mb-3" style="max-width: 800px;">
    <a href='./register.php' class="btn btn-sm btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Create new user
    </a>
  </div>


  <?php if(!empty($message)): ?>
    <div class="alert alert-info alert-dismissible fade show w-100" style="max-width: 800px;" role="alert">
      <?= $message ?>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  
  <div class="table-responsive w-100" style="max-width: 800px;">
    <table class="table table-dark table-hover text-center mb-0">
      <thead class="table-secondary text-dark">
        <tr>
          <th scope="col">User ID</th>
          <th scope="col">Email</th>
          <th scope="col">Name</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user): ?>
          <tr>
            <th scope="row"><?= $user->user_id ?></th>
            <td><?= $user->user_email ?></td>
            <td><?= $user->user_name ?></td>
            <td>
              <a href="./user_overview.php?user_id=<?= $user->user_id ?>" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i> See more
              </a>
            </td>
          </tr>
        <?php endforeach ?> 
      </tbody>
    </table>
  </div>

</section>

<style>
.table th, .table td {
  vertical-align: middle;
}

.table-hover tbody tr:hover {
  background-color: #00334d;
  transition: background-color 0.2s;
}

.btn-info {
  background-color: #00bfa6;
  border-color: #00bfa6;
  font-size: 0.85rem;
  padding: 0.35rem 0.5rem;
}

.btn-info:hover {
  background-color: #00a28f;
  border-color: #00a28f;
}

@media (max-width: 576px) {
  .table thead th:nth-child(3) { display: none; } /* schowanie kolumny Name na malych ekranach */
}
</style>


