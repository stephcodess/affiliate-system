<?php

include '../database/functions.php'; // Include the database connection if not already included

function validateUser($user) {
    $errors = array();
    
    if (empty($user['first_name'])) { 
        array_push($errors, 'Firstname is required'); 
    }
    
    if (empty($user['last_name'])) { 
        array_push($errors, 'Lastname is required'); 
    }

    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Email is invalid');
    }
    
    if (empty($user['gender'])) { 
        array_push($errors, 'Gender is required'); 
    }
    
    if (empty($user['phone'])) { 
        array_push($errors, 'Phone is required'); 
    }
    
    if (empty($user['password'])) { 
        array_push($errors, 'Password is required'); 
    } elseif (strlen($user['password']) < 6) {
        array_push($errors, 'Password is too short, it should be at least 6 characters');
    }
    
    if ($user['password'] !== $user['password_2']) {
        array_push($errors, 'The two passwords do not match');
    }
    
    $existingUser = selectOne('affiliates', ['email' => $user['email']]);
    if ($existingUser) {
        array_push($errors, 'Email already exists');
    }

    return $errors;
}

// // Example of usage:
// $userData = [
//     'first_name' => 'John',
//     'last_name' => 'Doe',
//     'email' => 'john.doe@example.com',
//     'gender' => 'male',
//     'phone' => '1234567890',
//     'password' => 'password123',
//     'password_2' => 'password123'
// ];

// $errors = validateUser($userData);
// if (!empty($errors)) {
//     print_r($errors); // Output errors for debugging
// } else {
//     echo "User data is valid";
// }

?>
