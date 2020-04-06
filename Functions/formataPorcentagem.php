<?php

function clean($string) {
    $string = str_replace('%', '', $string); // Replaces all spaces with %.
    return trim($string);

    //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}