<?php


function logMessage($level, $message)
{
    $file = fopen('app.log', "a");
    fwrite($file, "[$level] $message" . PHP_EOL);
    fclose($file);
}

function errorPage()
{
    include "templates/error.php";
    die();
}

$routes = [];

function route($action, $callable, $method = 'GET')
{
    global $routes;
    $pattern = "%^$action$%";
    $routes[strtoupper($method)][$pattern] = $callable;
}

function dispatch($action, $notFound)
{
    global $routes;
    $method = $_SERVER["REQUEST_METHOD"];
    if (array_key_exists($method, $routes)) {
        foreach ($routes[$method] as $pattern => $callable) {
            if (preg_match($pattern, $action, $matches)) {
                return $callable($matches);
            }
        }
    }
    return $notFound();
}


function esc($string)
{
    echo htmlspecialchars($string);
}

function getConnection()
{
    global $config;
    $connection = mysqli_connect($config['DB_HOST'], $config['DB_USER'], $config['DB_PASS'], $config['DB_NAME']);
    if (!$connection) {
        logMessage('ERROR', 'Connection error:' . mysqli_connect_error());
        errorPage();
    }
    return $connection;
}

/******************** mobile add function content start **********************/

function mobilePhonesAppend($connection, $brand, $type, $comment, $price, $image)
{
    if ($statement = mysqli_prepare($connection, 'INSERT INTO mobile_phones (brand, type, comment, price, image) VALUES (?,?,?,?,?)')) {
        $null = NULL;
        mysqli_stmt_bind_param($statement, 'ssssb', $brand, $type, $comment, $price, $null);
        mysqli_stmt_send_long_data($statement, 4, file_get_contents($image));
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}

function retrieveAllMobilePhones($connection)
{
    if ($statement = mysqli_prepare($connection, 'SELECT id, brand, type, comment, price, image FROM mobile_phones')) {
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $id, $brand, $type, $comment, $price, $image);
        $images = [];
        while (mysqli_stmt_fetch($statement)) {
            $images[] = ["id" => $id, "brand" => $brand, "type" => $type, "comment" => $comment, "price" => $price, "image" => $image];
        }
        mysqli_stmt_close($statement);
        return $images;
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}

function retrieveMobilePhones($connection)
{
    if ($statement = mysqli_prepare($connection, 'SELECT id, brand, type, comment, price, image FROM mobile_phones')) {
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $id, $brand, $type, $comment, $price, $image);
        $images = [];
        while (mysqli_stmt_fetch($statement)) {
            $images[] = ["id" => $id, "brand" => $brand, "type" => $type, "comment" => $comment, "price" => $price, "image" => $image];
        }
        mysqli_stmt_close($statement);
        return $images;
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}

function phoneDelete($connection, $id)
{
    if ($statement = mysqli_prepare($connection, 'DELETE FROM mobile_phones WHERE id = ?')) {
        mysqli_stmt_bind_param($statement, 'i', $id);
        mysqli_stmt_execute($statement);
    } else {
        logMessage('ERROR', 'Query error:' . mysqli_error($connection));
        errorPage();
    }
}
