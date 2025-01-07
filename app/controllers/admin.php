<?php
include "../../path.php";
include (ROOT_PATH . "/app/database/functions.php");

$errors = array();
$earning_table = 'earnings';
$profile_table = 'admins';
$affiliates_table = 'affiliates';
$orders_table = 'orders';
$withdrawals_table = 'withdrawals';
$withdrawal_accounts_table = 'withdrawal_accounts';

function createOrUpdateToken($userId, $token)
{
    global $conn;
    $existingToken = selectOne('tokens', ['user_id' => $userId]);

    if ($existingToken) {
        return update('tokens', $existingToken['id'], ['token' => $token]);
    } else {
        return create('tokens', ['user_id' => $userId, 'token' => $token]);
    }
}


function check_if_user_logged_in()
{
    if (isset($_COOKIE['auth_token'])) {
        $user = $_COOKIE['auth_token'];
        $user_id = selectOne('tokens', ['token' => $user]);
        if ($user_id) {
            return $user_id['user_id'];
        } else {
            setcookie("auth_token", "", time() - 3600, "/", "", true, true);
            return null;
        }
    } else {
        return null;
    }
}

$id = check_if_user_logged_in();
if ($id) {
    $user = selectOne($profile_table, ['id' => $id]);
    if ($user) {
        if (isset($_GET['fetch_all_admins'])) {
            $admins = selectAll($profile_table, []);

            $response['status'] = 'success';
            $response['status_code'] = 200;
            $response['data'] = $admins;
            echo json_encode($response);
        } else if (isset($_POST['add_new_admin'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $is_admin = $_POST['is_admin'];
            $email = $_POST['email'];
            $password = "12345";

            // Validate user input
            if (empty($first_name)) {
                $errors[] = 'Name is required';
            }
            // Validate user input
            if (empty($last_name)) {
                $errors[] = 'last name is required';
            }
            // Validate user input
            if (empty($is_admin)) {
                $errors[] = 'Admin priviledge is required';
            }
            if (empty($email)) {
                $errors[] = 'Email is required';
            }


            $existingAdmin = selectOne($profile_table, ['email' => $email]);
            if ($existingAdmin) {
                $errors[] = 'Email already exists';
            }

            if (count($errors) === 0) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $adminData = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'is_admin' => $is_admin,
                    'email' => $email,
                    'password' => $hashedPassword
                ];
                $newAdminId = create($profile_table, $adminData);

                if ($newAdminId) {
                    $response['status'] = 'success';
                    $response['message'] = 'New admin added successfully';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'An error occurred while adding the new admin';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = implode(', ', $errors);
            }

            echo json_encode($response);
            exit();
        } else if (isset($_POST['update_password'])) {
            if (!empty($_POST['password'] && !empty($_POST['confirm_password']))) {
                if ($_POST['password'] === $_POST['confirm_password']) {
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $updatePassword = update($profile_table, $id, ['password' => $hashedPassword]);
                    if ($updatePassword) {
                        $response['status'] = 'success';
                        $response['status_code'] = 200;
                        $response['message'] = 'New admin added successfully';
                    } else {
                        $response['status'] = 'error';
                        $response['status_code'] = 400;
                        $response['message'] = 'Error Adding user';
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'the two passwords must match';
                }
            }
            echo json_encode($response);
            exit();
        } else if (isset($_GET['fetch_all_users'])) {
            $affiliates = selectAll($affiliates_table, []);

            $response['status'] = 'success';
            $response['status_code'] = 200;
            $response['data'] = $affiliates;
            echo json_encode($response);
        } else if (isset($_GET['site_overview'])) {
            $total_users = count_table($affiliates_table);
            $total_orders = count_table($orders_table, ['status' => 0]);
            $total_withdrawals = count_table($withdrawals_table, ['status' => 0]);
            $total_sold = count_table($orders_table, ['status' => 1]);

            $data = [
                'users' => $total_users,
                'orders' => $total_orders,
                'withdrawals' => $total_withdrawals,
                'sold' => $total_sold,
            ];
            $response['status'] = 'success';
            $response['status_code'] = 200;
            $response['data'] = $data;
            echo json_encode($response);
        } else if (isset($_GET['fetch_all_orders'])) {
            $orders = selectAll($orders_table, ['status' => $_GET['fetch_all_orders']]);

            $response['status'] = 'success';
            $response['status_code'] = 200;
            $response['data'] = $orders;
            echo json_encode($response);
        } else if (isset($_GET['fetch_all_withdrawals'])) {
            $withdrawal = selectAll($withdrawals_table, ['status' => 0]);

            $response['status'] = 'success';
            $response['status_code'] = 200;
            $response['data'] = $withdrawal;
            echo json_encode($response);
        } else if (isset($_GET['approve_withdrawal'])) {
            $withdrawalId = $_GET['approve_withdrawal'];
            $withdrawal = selectOne($withdrawals_table, ['id' => $withdrawalId]);

            if ($withdrawal) {
                $updateData = [
                    'status' => 1
                ];
                $result = update($withdrawals_table, $withdrawalId, $updateData);

                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'Withdrawal approved successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'An error occurred while approving the withdrawal.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Withdrawal not found.';
            }
            echo json_encode($response);
            exit();
        } else if (isset($_GET['approve_order'])) {
            $orderId = $_GET['approve_order'];
            $order = selectOne($orders_table, ['id' => $orderId]);

            if ($order) {

                $result = update($orders_table, $orderId, ['status' => 1]);

                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'order approved successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'An error occurred while approving the order.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'order not found.';
            }
            echo json_encode($response);
            exit();
        } else if (isset($_POST['editOrder'])) {
            $orderId = $_POST['editOrder'];
            $order = selectOne($orders_table, ['id' => $orderId]);
            if ($order) {
                unset($_POST['editOrder']);
                $result = update($orders_table, $orderId, $_POST);

                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'successfully changed field.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'An error occurred while editing.';
                }
            }
            echo json_encode($response);
            exit();
        } else if (isset($_POST['editUser'])) {
            $userId = $_POST['editUser'];
            $user = selectOne($affiliates_table, ['id' => $userId]);
            if ($user) {
                unset($_POST['editUser']);
                $result = update($affiliates_table, $userId, $_POST);

                if ($result) {
                    $response['status'] = 'success';
                    $response['message'] = 'successfully changed field.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'An error occurred while editing.';
                }
            }
            echo json_encode($response);
            exit();
        } else if (isset($_POST['product_settings'])) {
            $settings = selectAll('product_variations');
            unset($_POST['product_settings']);
            if (count($settings) > 0) {
                $update_product = update('product_variations', $settings[0]['id'], $_POST);
                if ($update_product) {
                    $response['status'] = 'success';
                    $response['message'] = 'product setting updated successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'error setting product details.';
                }
            } else {
                $update_product = create('product_variations', $_POST);
                if ($update_product) {
                    $response['status'] = 'success';
                    $response['message'] = 'product setting created successfully.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'error updating settings.';
                }
            }

            echo json_encode($response);
        } else if (isset($_GET['product_settings'])) {
            $product_settings = selectAll('product_variations');
            if (count($product_settings) > 0) {
                $response['status'] = 'success';
                $response['data'] = $product_settings[0];
                $response['status_code'] = 200;
            } else {
                $response['status'] = 'success';
                $response['status_code'] = 200;
                $response['data'] = [];
            }
            echo json_encode($response);
        }
    }
} else {
    if (isset($_POST['login_as_admin'])) {
        $errors = array();
        $response = array();
        unset($_POST['login_as_admin']);
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate user input
        if (empty($email)) {
            $errors[] = 'Email is required';
        }
        if (empty($password)) {
            $errors[] = 'Password is required';
        }

        $user = selectOne('admins', ['email' => $email]);

        if ($user && password_verify($password, $user['password'])) {
            $token = bin2hex(random_bytes(16));
            if (!createOrUpdateToken($user['id'], $token)) {
                $errors[] = 'An error occurred while updating the user token.';
            }
            setcookie('auth_token', $token, time() + (86400 * 30), "/");
            if ($password === '12345') {
                $response['status'] = 'success';
                $response['status_code'] = 201;
                $response['message'] = 'A new user login.';
                echo json_encode($response);
                exit();
            } else {

                $response['status'] = 'success';
                $response['status_code'] = 200;
                $response['message'] = 'Login successful';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid email or password';
            echo json_encode($response);
        }
    } else {
        echo json_encode(['message' => 'User not logged in or invalid token.', 'status' => "error", 'status_code' => 401]);
    }
}

