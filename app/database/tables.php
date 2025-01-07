<?php
include "./connect.php";
global $conn;
$createTables = [
    "affiliates" => "CREATE TABLE IF NOT EXISTS affiliates (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        gender VARCHAR(64),
        phone VARCHAR(64),
        email VARCHAR(150),
        is_admin TEXT(12),
        wallet_balance DECIMAL(10, 2) DEFAULT 0,
        password VARCHAR(255),
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=MyISAM",

    "admins" => "CREATE TABLE IF NOT EXISTS admins (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        email VARCHAR(150),
        is_admin TEXT(12),
        password VARCHAR(255),
        created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=MyISAM",

    "tokens" => "CREATE TABLE IF NOT EXISTS tokens (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        token VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES affiliates(id)
    ) ENGINE=MyISAM",

    "earnings" => "CREATE TABLE IF NOT EXISTS earnings (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        product_quantity INT NOT NULL,
        earning DECIMAL(10, 2) NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES affiliates(id)
    ) ENGINE=MyISAM",

    "orders" => "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        state VARCHAR(255) NOT NULL,
        address VARCHAR(255) NOT NULL,
        quantity INT NOT NULL,
        total_amount_paid DECIMAL(10, 2) NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        email_address VARCHAR(255) NOT NULL,
        phone_number VARCHAR(20) NOT NULL,
        affiliate_id INT UNSIGNED,
        status TINYINT(10) DEFAULT 0,
        FOREIGN KEY (affiliate_id) REFERENCES affiliates(id)
    ) ENGINE=MyISAM",

    "product_variations" => "CREATE TABLE IF NOT EXISTS product_variations (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        price DECIMAL(10, 2) NOT NULL,
        minimum_order INT NOT NULL,
        max_order INT NOT NULL,
        affiliate_commission VARCHAR(50)
    ) ENGINE=MyISAM",

    "withdrawals" => "CREATE TABLE IF NOT EXISTS withdrawals (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        affiliate_id INT UNSIGNED,
        amount DECIMAL(10, 2) NOT NULL,
        status TINYINT(10) DEFAULT 0,
        decline_status TINYINT(10) DEFAULT 0,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        withdrawal_account TEXT,
        FOREIGN KEY (affiliate_id) REFERENCES affiliates(id)
    ) ENGINE=MyISAM",
    "withdrawal_accounts" => "CREATE TABLE IF NOT EXISTS withdrawal_accounts (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        affiliate_id INT UNSIGNED,
        verify_bank VARCHAR(255) NOT NULL,
        account_number VARCHAR(255) NOT NULL,
        account_name VARCHAR(255) NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (affiliate_id) REFERENCES affiliates(id)
    ) ENGINE=MyISAM"
];

foreach ($createTables as $tableName => $createQuery) {
    if (mysqli_query($conn, $createQuery)) {
        echo "Table '$tableName' created successfully.<br>";
    } else {
        echo "Error creating table '$tableName': " . mysqli_error($conn) . "<br>";
    }
}
