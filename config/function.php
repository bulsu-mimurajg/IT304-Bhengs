<?php
session_start();

require 'dbcon.php';

// Input field validation
function validate($inputData)
{
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    return trim($validatedData);
}

// Redirect from 1 page to another page with the message (status)
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}

// Display messages or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['status'] . '</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        unset($_SESSION['status']);
    }
}

// Insert record
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update record
function update($tableName, $columnName, $id, $data)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    // Start building the update data string
    $updateDataString = "";

    // Loop through each field in the provided data
    foreach ($data as $column => $value) {
        // Skip empty or null values
        if (!empty($value)) {
            $updateDataString .= $column . "='" . mysqli_real_escape_string($conn, $value) . "',";
        }
    }

    // Remove trailing comma
    $finalUpdateData = rtrim($updateDataString, ',');

    // Proceed with the update only if there are any fields to update
    if (!empty($finalUpdateData)) {
        $query = "UPDATE $table SET $finalUpdateData WHERE $columnName='$id'";
        $result = mysqli_query($conn, $query);
        return $result;
    } else {
        return false; // No fields were updated
    }
}

function getAll($tableName, $status = NULL)
{
    global $conn;

    $table = validate($tableName);
    $status = validate($status);

    if ($status == 'status') {
        $query = "SELECT * FROM $table WHERE $status='0'";
    } else {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

function getById($tableName, $columnName, $id)
{
    global $conn;

    $table = validate($tableName);
    $status = validate($id);

    $query = "SELECT * FROM $table WHERE $columnName='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $response = [
                'status' => 200,
                'data' => $row,
                'message' => 'Record exists.'
            ];
            return $response;
        } else {
            $response = [
                'status' => 404,
                'message' => 'No data found.'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'Something went wrong. (FUNCTION)'
        ];
        return $response;
    }
}

// Delete record

function delete($tableName, $columnName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE $columnName='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

function logoutSession()
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['loggedInUser']);
}

function jResponse($status, $status_type, $message)
{
    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}

function getCount($tableName)
{
    global $conn;

    $table = validate($tableName);

    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    if ($query) {
        $totalCount = mysqli_num_rows($result);
        return $totalCount;
    } else {
        return 'Something went wrong.';
    }
}
