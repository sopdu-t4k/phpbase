<?php
/*функция подключения к базе данных*/
function getDb() {
    static $db = null;
    if (is_null($db)) {
        $db = @mysqli_connect(HOST, USER, PASS, DB) or die('Error: ' . mysqli_connect_error());
    }
    return $db;
}
/*функция закрытия подключения к БД*/
function closeDb() {
    mysqli_close(getDb());
}
/*функция для получения данных*/
function getAssocResult($sql) { 
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    $array_result = [];
    while ($row = mysqli_fetch_assoc($result))
        $array_result[] = $row;
    return $array_result;
}
/*функция для отправки\изменения данных*/
function executeQuery($sql) { 
    $db = getDb();
    $result = @mysqli_query($db, $sql) or die(mysqli_error($db));
    return $result;
}