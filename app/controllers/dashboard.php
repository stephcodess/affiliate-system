<?php
include "../../path.php";
include (ROOT_PATH . "/app/database/functions.php");

$errors = array();
$earning_table = 'earnings';
$profile_table = 'affiliates';
$withdrawal_accounts_table = 'withdrawal_accounts';

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
    if (isset($_GET['earnings'])) {
        $earnings = selectAll($earning_table, ['user_id' => $id]);
        echo json_encode($earnings);
    } else if (isset($_GET['profile'])) {
        echo json_encode(['data' => $user, 'status' => "success", 'status_code' => 200]);
    } else if (isset($_GET['withdrawals'])) {
        $withdrawals = selectAll('withdrawals', ['affiliate_id' => $id]);
        if ($withdrawals) {
            echo json_encode(['data' => $withdrawals, 'status' => 'success', 'status_code' => 200]);
        } else {
            echo json_encode(['message' => 'No withdrawal history found.', 'status' => 'error', 'status_code' => 400]);
        }
    } else if (isset($_GET['withdrawal_accounts'])) {
        $withdrawal_accounts = selectAll($withdrawal_accounts_table, ['affiliate_id' => $id]);
        if ($withdrawal_accounts) {
            echo json_encode(['data' => $withdrawal_accounts, 'status' => 'success', 'status_code' => 200]);
        } else {
            echo json_encode(['message' => 'No withdrawal accounts found.', 'status' => 'error', 'status_code' => 400]);
        }
    } else if (isset($_POST['withdrawal_amount'])) {
        $amount = (float) $_POST['withdrawal_amount'];
        $existingRequest = selectOne('withdrawals', ['affiliate_id' => $id, 'status' => 0]);
        $withdrawal_account = selectOne('withdrawal_accounts', ['id' => $_POST['withdrawal_account']]);
        if (!$existingRequest) {
            if ($amount > $user['wallet_balance']) {
                echo json_encode(['message' => "Insufficient balance. Amount cannot be greater than #" . $user['wallet_balance'], 'status' => 'error', 'status_code' => 400]);
            } else {
                $create_withdrawal = create('withdrawals', ['affiliate_id' => $id, 'amount' => $amount, 'withdrawal_account' => json_encode($withdrawal_account)]);
                if ($create_withdrawal) {
                    echo json_encode(['message' => "Your withdrawal request has been submitted.", 'status' => 'success', 'status_code' => 200]);
                } else {
                    echo json_encode(['message' => "Could not submit your withdrawal request.", 'status' => 'error', 'status_code' => 400]);
                }
            }
        } else {
            echo json_encode(['message' => "You already have a pending withdrawal request.", 'status' => 'error', 'status_code' => 400]);
        }
    } else if (isset($_POST['verify_bank'])) {
        $verify_bank = $_POST['verify_bank'];
        $account_number = $_POST['account_number'];
        $account_name = $_POST['account_name'];

        $create_account = create($withdrawal_accounts_table, [
            'affiliate_id' => $id,
            'verify_bank' => explode("&name", $verify_bank)[1],
            'account_number' => $account_number,
            'account_name' => $account_name
        ]);

        if ($create_account) {
            echo json_encode(['message' => "Withdrawal account added successfully.", 'status' => 'success', 'status_code' => 200]);
        } else {
            echo json_encode(['message' => "Could not add withdrawal account.", 'status' => 'error', 'status_code' => 400]);
        }
    } else if (isset($_POST['delete_acc'])) {
        // Sanitize and validate the accountId
        $accountId = $_POST['delete_acc'];

        $deleted = delete_data($withdrawal_accounts_table, $accountId);
        if ($deleted) {
            echo json_encode(['status' => 'success', 'message' => 'Withdrawal account deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete withdrawal account.']);
        }
    }
} else {
    echo json_encode(['message' => 'User not logged in or invalid token.', 'status' => "error", 'status_code' => 401]);
}
