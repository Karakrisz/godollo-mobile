<?php

function homeController()
{


    return [
        "home",
        [
            "title" => "Kezdőlap"
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


