<?php

require_once "database.php";

if (!isset($_COOKIE['donut'])) {
    setcookie('donut', time(), time() + 60*60*24*11, '/', 'localhost');
}

$donut = $_COOKIE['donut'];

$sql = "SELECT p.name AS product_name, p.price AS product_price, c.product_id AS product_id, c.session_id AS user_id, c.quantity AS quantity
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.session_id = $donut";

$result = mysqli_query($conn, $sql);
$categoriesArray = [];
while ($row = $result->fetch_assoc()) {
    $categoriesArray[$row['product_id']] = [
        'user_id' => $row['user_id'],
        'product_name' => $row['product_name'],
        'product_price' => $row['product_price'],
        'quantity' => $row['quantity'],
    ];

}


mysqli_close($conn);

header('Content-Type: application/json');

echo json_encode($categoriesArray);