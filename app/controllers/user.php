<?php
include "../../path.php";
include_once (ROOT_PATH . "/app/helpers/validateuser.php");

// Define your Flodesk API key and email template ID
define('FLODESK_API_KEY', 'your-flodesk-api-key');
define('FLODESK_TEMPLATE_ID', 'your-flodesk-template-id');

function sendSignupEmail($recipientEmail, $recipientName)
{
    $url = 'https://api.flodesk.com/emails/send';
    $data = [
        'templateId' => FLODESK_TEMPLATE_ID,
        'to' => [
            'email' => $recipientEmail,
            'name' => $recipientName,
        ],
        'variables' => [
            'name' => $recipientName,
        ],
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n" .
                        "Authorization: Bearer " . FLODESK_API_KEY . "\r\n",
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        return false;
    }

    return true;
}

// Other functions remain unchanged

function createOrUpdateToken($userId, $token)
{
    global $conn;

    // Check if token already exists for the user
    $existingToken = selectOne('tokens', ['user_id' => $userId]);

    if ($existingToken) {
        // Update the existing token
        return update('tokens', $existingToken['id'], ['token' => $token]);
    } else {
        // Create a new token
        return create('tokens', ['user_id' => $userId, 'token' => $token]);
    }
}

function logoutUser()
{
    $response = array();
    if (isset($_COOKIE['auth_token'])) {

        $token = $_COOKIE['auth_token'];
        delete_data('tokens', ['token' => $token]);
        setcookie("auth_token", "", time() - 3600, "/");
        $response['message'] = "logged out successfully";
        $response['status'] = 'success';
        return json_encode($response);
    } else {
        $response['message'] = "User not logged in.";
        $response['status'] = 'error';
        return json_encode($response);
    }
}

if (isset($_POST['register_user'])) {
    $errors = array();
    $response = array();
    unset($_POST['register_user']);
    unset($_POST['terms_&_conditions']);
    // Validate user data
    $errors = validateUser($_POST);

    unset($_POST['password_2']);

    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $_POST['is_admin'] = isset($_POST['is_admin']) ? $_POST['is_admin'] : 0;

    $existingUser = selectOne('affiliates', ['email' => $_POST['email']]);

    if (!$existingUser) {
        $user_id = create('affiliates', $_POST);
        if ($user_id) {
            if (sendSignupEmail($_POST['email'], $_POST['first_name'])) {
                echo json_encode(['status' => 'success', 'message' => 'User created and email sent successfully.']);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'User created but email sending failed.']);
            }
            exit();
        } else {
            $response['message'] = "An error occurred while creating the user.";
            $response['status'] = 'error';
            echo json_encode($response);
        }
    } else {
        $response['message'] = "A user already exist with this details.";
        $response['status'] = 'error';
        echo json_encode($response);
    }

}

if (isset($_POST['login_user'])) {
    $errors = array();
    $response = array();
    unset($_POST['login_user']);
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors[] = 'Email is required';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }

    $user = selectOne('affiliates', ['email' => $email]);

    if ($user && password_verify($password, $user['password'])) {
        $token = bin2hex(random_bytes(16));
        if (!createOrUpdateToken($user['id'], $token)) {
            $errors[] = 'An error occurred while updating the user token.';
        }

        setcookie('auth_token', $token, time() + (86400 * 30), "/");

        $response['status'] = 'success';
        $response['message'] = 'Login successful';
        echo json_encode($response);
        exit();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid email or password';
        echo json_encode($response);
    }
}

if (isset($_GET['logout_user'])) {
    $response = logoutUser();
    echo json_encode($response);
}

?>
