<?php
    require_once "database.php";

    $session_id = $_POST['user_id'];
    $product_id = $_POST['id'];

    $check_sql = "SELECT * FROM cart WHERE product_id = $product_id AND session_id = '$session_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if ($check_result) {
        $count = mysqli_num_rows($check_result);

        if ($count == 0) {
            $sql = "INSERT INTO cart (product_id, quantity, session_id) VALUES ($product_id, 1, '$session_id')";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = $product_id AND session_id = '$session_id'";
            $result = mysqli_query($conn, $sql);
        }
    }


    mysqli_close($conn);

    header('Content-Type: application/json');

    echo json_encode($result);
