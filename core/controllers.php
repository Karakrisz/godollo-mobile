<?php

function homeController()
{

    $connection = getConnection();
    $phones = retrieveMobilePhones($connection);

    return [
        "home",
        [
            "title" => "Kezdőlap",
            "phones" => $phones
        ]
    ];
}

function adminController()
{

    $mobileAdded = array_key_exists("mobileAdded", $_SESSION);
    unset($_SESSION["mobileAdded"]);

    $connection = getConnection();
    $allPhones = retrieveAllMobilePhones($connection);

    return [
        "administ",
        [
            "title" => "Adminisztrációs oldal",
            "mobileAdded" => $mobileAdded,
            "allPhones" => $allPhones
        ]
    ];
}

function mobilePhonesSubmitController()
{
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $comment = $_POST['comment'];
    $price = $_POST['price'];
    $filename = $_FILES["image"]["name"];
    $image_file = $_FILES["image"]["tmp_name"];
    $folder = __DIR__ . "/../imagesuploaded/";
    move_uploaded_file($image_file, $folder . $filename);
    $connection = getConnection();
    mobilePhonesAppend($connection, $brand, $type, $comment, $price, $folder . $filename);
    $_SESSION["mobileAdded"] = 1;
    return [
        "redirect:/administ", []
    ];
}

function phoneDeleteController($params)
{
    $connection = getConnection();
    phoneDelete($connection, $params["id"]);
    return [
        "redirect:/administ",
        []
    ];
}

function priceListController()
{
    return [
        "price-list", [
            "title" => "Szerviz árlista"
        ]
    ];
}

function notFoundController()
{
    return [
        "404", [
            "title" => "A keresett oldal nem található."
        ]
    ];
}
