<?php 

    include __DIR__ . '/../header.php'; 
    include __DIR__ . '/../includes/auth.php'; 

    $room_id = $_GET['room_id'];
    $selectRoom = "SELECT * FROM rooms WHERE room_id = :room_id";
    $statement = $pdo->prepare($selectRoom);
    $statement->execute([':room_id' => $room_id]);
    $room = $statement->fetch(PDO::FETCH_OBJ);

?>


<?php if($room) : ?>
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg w-100" style="max-width: 480px; background-color: #001d3d; color: white;">
        <div class="card-body p-4">
            <h3 class="mb-3 text-center"><?= $room->room_name ?></h3>

            <div class="room-info mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Status:</span>
                    <span><?= $room->room_status ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Door Nr.:</span>
                    <span><?= $room->room_doornumber ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Beds:</span>
                    <span><?= $room->room_beds ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2 flex-wrap">
                    <span class="fw-bold">Description:</span>
                    <span><?= $room->room_description ?></span>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <a href="room_edit.php?room_id=<?= $room->room_id ?>" class="btn btn-info flex-fill">
                    <i class="bi bi-pencil-fill me-1"></i> Edit Info
                </a>
                <a href="room_delete.php?room_id=<?= $room->room_id ?>" class="btn btn-danger flex-fill">
                    <i class="bi bi-trash-fill me-1"></i> Delete Room
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3 d-flex justify-content-center">
    <a href="./rooms_overview.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-1"></i> Go Back
    </a>
</div>
<?php endif ?>

<style>
.card p, .room-info div span {
    color: white;
}

.btn-info {
    background-color: #00bfa6;
    border-color: #00bfa6;
}

.btn-info:hover {
    background-color: #00a28f;
    border-color: #00a28f;
}

.btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background-color: #b02a37;
    border-color: #b02a37;
}

@media (max-width: 576px) {
    .card-body {
        padding: 1.5rem 1rem;
    }
}
</style>
