<?php 


    include __DIR__ . '/../header.php'; 

    if(isset($_POST['submit'])){

        $room_name = $_POST['room_name'];
        $room_description = $_POST['room_description'];
        $room_doornumber = $_POST['room_doornumber'];
        $room_beds = $_POST['room_beds'];
        $room_status = $_POST['room_status'];

        $addRoom = "INSERT INTO rooms (room_name, room_description, room_doornumber,room_beds,room_status) 
        VALUES(:room_name, :room_description, :room_doornumber, :room_beds, :room_status)";
        $statement = $pdo->prepare($addRoom);

        $data = [
            ':room_name' => $room_name,
            ':room_description' => $room_description,
            ':room_doornumber' => $room_doornumber,
            ':room_beds' => $room_beds,
            ':room_status' => $room_status
        ];

        if($statement->execute($data)) {
            header('Location: rooms_overview.php');
            $message = "Room has been created.";
        }

        $id = $pdo->lastInsertId();


    };


?>

<form method="post">
    <input type="text" name="room_name" placeholder ="Room Name">
    <input type="text" name="room_beds" placeholder ="Beds number">
    <input type="text" name="room_doornumber" placeholder ="Room Doornumber">
    <select name="room_status">
            <option value="Available" name="room_status" selected>Available</option>
            <option value="Booked" name="room_status">Booked</option>
            <option value="Not Available" name="room_status">Not Available</option>
    </select>
    <textarea name="room_description"></textarea>
    <input type="submit" value="Add" name="submit">
</form>


