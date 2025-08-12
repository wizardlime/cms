<?php
session_start();    // Start sesji (jeśli jeszcze nie jest)
session_unset();    // Usuwa wszystkie zmienne sesyjne
session_destroy();  // Kończy sesję (usuwa plik sesji)

header("Location: login.php");  // Przekieruj na stronę logowania lub inną
exit();