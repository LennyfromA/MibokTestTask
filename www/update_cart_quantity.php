<?php
    require_once "database.php";

    $session_id = $_POST['session_id'];

    $quantity = $_POST['quantity'] ?? 0;
    $product = $_POST['product_id'] ?? 0;

    $sql = match($_POST['action']) {
        'buy' => "DELETE FROM cart WHERE session_id = '$session_id';",
        'update' => "UPDATE `miboktest`.`cart` SET `quantity` = '$quantity' WHERE (`product_id` = '$product' AND session_id = '$session_id');",
        'delete' => "DELETE FROM `miboktest`.`cart` WHERE (`product_id` = '$product' AND session_id = '$session_id')",
    };

    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);
