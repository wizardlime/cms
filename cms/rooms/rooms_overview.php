<?php 

    include __DIR__ . '/../header.php'; 
    include __DIR__ . '/../includes/auth.php'; 
    
    $selectAllRooms = "SELECT * FROM rooms";
    $statement = $pdo->query($selectAllRooms);
    $rooms = $statement->fetchAll(PDO::FETCH_OBJ);

    $message = '';

?>



<section class="d-flex flex-column align-items-center justify-content-center min-vh-100 p-3">

  <div class="d-flex justify-content-end w-100 mb-3" style="max-width: 800px;">
    <a href='./add_room.php' class="btn btn-sm btn-primary">
      <i class="bi bi-plus-circle me-1"></i> Add new room
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
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Door Nr.</th>
          <th scope="col">Beds</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rooms as $room): ?>
          <tr>
            <th scope="row"><?= $room->room_id ?></th>
            <td><?= $room->room_name ?></td>
            <td><?= $room->room_doornumber ?></td>
            <td><?= $room->room_beds ?></td>
            <td><?= $room->room_status ?></td>
            <td>
              <a href="./room_overview.php?room_id=<?= $room->room_id ?>" class="btn btn-sm btn-info">
                <i class="bi bi-eye"></i> See more
              </a>
            </td>
          </tr>
        <?php endforeach ?> 
      </tbody>
    </table>
  </div>

</section>
