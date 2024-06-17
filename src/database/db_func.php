<?php
session_start();
require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
function tte($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function db_checkError($querry)
{
    $errInfo = $querry->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}

function selectAll($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $querry = $pdo->prepare($sql);
    $querry->execute();

    db_checkError($querry);

    return $querry->fetchAll();
}

function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key=$value";
            } else {
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }
    $sql = $sql . " LIMIT 1";
    $querry = $pdo->prepare($sql);
    $querry->execute();

    db_checkError($querry);

    return $querry->fetch();
}

function insert($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    db_CheckError($query);
    return $pdo->lastInsertId();
}

// Обновление строки в таблице
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    db_CheckError($query);
}

function delete($table, $id)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE id =" . $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    db_CheckError($query);
}

function countRow($table)
{
    global $pdo;
    $sql = "SELECT Count(*) FROM $table";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_CheckError($query);
    return $query->fetchColumn();
}


function selectAllOrdersWithStatuses($table1, $table2, $table3)
{
    global $pdo;
    $sql = "SELECT 
        o.id,
        u.username,
        u.email,
        o.file,
        o.service_name,
        o.order_material,
        o.order_size,
        o.order_quantity,
        o.price,
        o.id_status,
        os.status,
        o.created
        FROM $table1 AS o 
        JOIN $table2 AS os 
        ON o.id_status = os.id
        JOIN $table3 AS u
        ON o.id_user = u.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_CheckError($query);
    return $query->fetchAll();
}

function selectUsersOrdersWithStatuses($table1, $table2, $id_user)
{
    global $pdo;
    $sql = "SELECT 
        o.id,
        o.id_user,
        o.file,
        o.service_name,
        o.order_material,
        o.order_size,
        o.order_quantity,
        o.price,
        os.status,
        o.created
        FROM $table1 AS o 
        JOIN $table2 AS os 
        ON o.id_status = os.id
        WHERE o.id_user = $id_user";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_CheckError($query);
    return $query->fetchAll();
}
