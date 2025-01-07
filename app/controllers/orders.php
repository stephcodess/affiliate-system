<?php
include "../../path.php"; // Adjust the path as necessary
include (ROOT_PATH . "/app/database/functions.php");

if (isset($_POST['order_product'])) {
    $quantity = $_POST["quantity"];
    $total_amount_paid = (float) $_POST["total_amount_paid"] * (float) $quantity;
    $product_settings = selectAll('product_variations');

    unset($_POST['order_product']);

    $result = create('orders', $_POST);

    if ($result) {
        $earning = ($product_settings[0]['affiliate_commission'] / 100) * $_POST["total_amount_paid"];
        $user = selectOne('affiliates', ['id' => $_POST['affiliate_id']]);
        if ($user) {
            $new_balance = (float) $user['wallet_balance'] + $earning;

            $add_to_affiliate_earnings = create('earnings', ['user_id' => $_POST['affiliate_id'], 'product_quantity' => $_POST["quantity"], 'earning' => $earning]);
            $update_user_balance = update('affiliates', $_POST['affiliate_id'], ['wallet_balance' => $new_balance]);
            echo json_encode(["success" => true, "message" => "Order added successfully"]);
        }
    } else {
        // Failed to add order
        echo json_encode(["success" => false, "message" => "Failed to add order"]);
    }
}
?>