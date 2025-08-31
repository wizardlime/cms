<nav class="navbar navbar-expand-lg">
  <div class="container-fluid px-4">
    <a class="navbar-brand" href="index.php?page=dashboard">Hotel CMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>reservations/reservations_overview.php">Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>rooms/rooms_overview.php">Rooms</a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="<?= BASE_URL ?>users/users_overview.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL ?>users/logout.php">Logout</a>
        </li>
      </ul>



    </div>
  </div>
</nav>