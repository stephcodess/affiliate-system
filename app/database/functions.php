<?php
include ('connect.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dd($values)
{
    echo "<pre>" . print_r($values, true) . "</pre>";
    die();
}

function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error in preparing statement: ' . htmlspecialchars($conn->error));
    }
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    if ($stmt->error) {
        die('Error in executing statement: ' . htmlspecialchars($stmt->error));
    }
    return $stmt;
}

function selectAll($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql .= " WHERE $key=?";
            } else {
                $sql .= " AND $key=?";
            }
            $i++;
        }
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table";
    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql .= " WHERE $key=?";
        } else {
            $sql .= " AND $key=?";
        }
        $i++;
    }
    $sql .= " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $record = $stmt->get_result()->fetch_assoc();
    return $record;
}

function create($table, $data)
{
    global $conn;
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql .= " $key=?";
        } else {
            $sql .= ", $key=?";
        }
        $i++;
    }
    $stmt = executeQuery($sql, $data);
    if ($stmt->error) {
        die('Error in inserting record: ' . htmlspecialchars($stmt->error));
    }
    $id = $stmt->insert_id;
    return $id;
}

function delete_data($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error in preparing statement: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();

    if ($stmt->error) {
        die('Error in executing statement: ' . htmlspecialchars($stmt->error));
    }

    return $stmt->affected_rows;
}

function update($table, $id, $data)
{
    global $conn;
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql .= " $key=?";
        } else {
            $sql .= ", $key=?";
        }
        $i++;
    }
    $sql .= " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function count_table($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM " . $table;

    if (!empty($conditions)) {
        $sql .= " WHERE ";
        $conditionStrings = [];
        foreach ($conditions as $column => $value) {
            $conditionStrings[] = $column . " = '" . $conn->real_escape_string($value) . "'";
        }
        $sql .= implode(" AND ", $conditionStrings);
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}
