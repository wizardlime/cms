<?php 
include("config/db.php");

$basename = basename($_SERVER['PHP_SELF']);
if ($basename !== 'login.php' && $basename !== 'register.php') {
    include __DIR__ . '/navbar.php';
}
?>


<html>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</html>
<body class="">
    



<style>
body {
  background-color: #d9d9d9; 
  color: #000;           
  font-family: "Segoe UI", sans-serif;
}

nav {
    background-color: #001d3d;
}

.nav-link,
.navbar-brand{
    color:#fff;
}
.card {
  background-color: #0b3a5d; 
  color: #e0e0e0;
  border-radius: 0.5rem;
}


.card-header {
  background-color: #064663;
  color: #e0e0e0;
  font-weight: 600;
  text-align: center;
}


.shadow-sm {
  box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

.table-dark {
  color: #e0e0e0;
}

.table-dark thead {
  background-color: #04395e;
}

.table-dark tbody tr:hover {
  background-color: #064663; 
}

.table-sm th, .table-sm td {
  padding: 0.5rem; 
}
.badge-success { background-color: #198754; }   
.badge-warning { background-color: #ffc107; color: #212529; } 
.badge-primary { background-color: #0d6efd; }    
.badge-danger { background-color: #dc3545; }    
.badge-secondary { background-color: #6c757d; }  

.btn-primary {
  background-color: #0d6efd;
  border-color: #0d6efd;
  color: #fff;
}

.btn-success {
  background-color: #198754;
  border-color: #198754;
  color: #fff;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
  color: #fff;
}

.btn-outline-info {
  color: #0dcaf0;
  border-color: #0dcaf0;
}

.btn-outline-info:hover {
  background-color: #0dcaf0;
  color: #032B43;
}

.alert-info {
  background-color: #0dcaf0;
  color: #032B43;
  border: none;
}

.alert-dismissible .btn-close {
  filter: brightness(0) invert(1);
}
a {
  color: #0dcaf0;
  text-decoration: none;
}

a:hover {
  color: #00bfa6;
  text-decoration: underline;
}


.container {
  margin-top: 80px; 
}

</style>

