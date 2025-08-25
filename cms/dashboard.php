<?php
include __DIR__ . '/header.php';
include __DIR__ . '/includes/messages.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "You must be logged in!";
    header("Location: users/login.php");
    exit();
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
          <a class="nav-link" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./reservations/reservations_overview.php">Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./rooms/rooms_overview.php">Rooms</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./users/users_overview.php">Users</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-warning fw-semibold" href="./users/logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>





<div class="container mt-4">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>

    <div class="row mt-4 g-4">
        <!-- Users Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fs-5">Users (Last 5)</h5>
                    <p class="display-6 fs-6">
                        <?php
                        $userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
                        echo $userCount;
                        ?>
                    </p>
                    <ul class="list-group list-group-flush mb-3">
                        <?php
                        $stmt = $pdo->query("SELECT user_name FROM users ORDER BY user_id DESC LIMIT 5");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<li class="list-group-item">' . htmlspecialchars($row['user_name']) . '</li>';
                        }
                        ?>
                    </ul>
                    <a href="users/register.php" class="btn btn-primary w-100">Add New User</a>
                </div>
            </div>
        </div>

        <!-- Rooms Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Rooms (Last 5)</h5>
                    <p class="display-6">
                        <?php
                        $roomCount = $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn();
                        echo $roomCount;
                        ?>
                    </p>
                    <ul class="list-group list-group-flush mb-3">
                        <?php
                        $stmt = $pdo->query("SELECT room_name FROM rooms ORDER BY room_id DESC LIMIT 5");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<li class="list-group-item">' . htmlspecialchars($row['room_name']) . '</li>';
                        }
                        ?>
                    </ul>
                    <a href="rooms/add_room.php" class="btn btn-primary w-100">Add New Room</a>
                </div>
            </div>
        </div>

       <!-- Reservations Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Reservations (Last 5)</h5>
                    <p class="display-6">
                        <?php
                        $reservationCount = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();
                        echo $reservationCount;
                        ?>
                    </p>
                    <ul class="list-group list-group-flush mb-3">
                        <?php
                        // Pobieramy ostatnie 5 rezerwacji wraz z nazwą użytkownika i pokoju
                        $stmt = $pdo->query("
                            SELECT r.reservation_id, u.user_name, rm.room_name 
                            FROM reservations r
                            LEFT JOIN users u ON r.user_id = u.user_id
                            LEFT JOIN rooms rm ON r.room_id = rm.room_id
                            ORDER BY r.reservation_id DESC
                            LIMIT 5
                        ");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<li class="list-group-item">'
                                . $row['reservation_id'] 
                                . ' | User: ' . htmlspecialchars($row['user_name']) 
                                . ' | Room: ' . htmlspecialchars($row['room_name']) 
                                . '</li>';
                        }
                        ?>
                    </ul>
                    <a href="reservations/new_reservation.php" class="btn btn-primary w-100">Add New Reservation</a>
                </div>
            </div>
        </div>
    </div>
</div>








<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: './reservations_events.php'
  });
  calendar.render();
});
</script>