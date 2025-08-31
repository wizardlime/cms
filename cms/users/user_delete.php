<?php 

    include __DIR__ . '/../header.php';
    include __DIR__ . '/../includes/auth.php'; 
 

    $user_id = $_POST['user_id'] ?? $_GET['user_id'] ?? null;

    $delete_user = "DELETE FROM users WHERE user_id = :user_id";
    $statement = $pdo->prepare($delete_user);
    if($statement->execute([':user_id' => $user_id])) {
        header("Location: users_overview.php");
    }