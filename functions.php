<?php

// Funkce pro formátování délky trvání v sekundách na formát HH:MM:SS
function formatDuration($duration)
{
    $hours = floor($duration / 3600);
    $minutes = floor(($duration % 3600) / 60);
    $seconds = $duration % 60;

    return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
}


function convertToDecimal($datetime) {
    $timestamp = strtotime($datetime);
    $decimal = date('Y', $timestamp) + (date('z', $timestamp) / 365) + (date('G', $timestamp) / 24) + (date('i', $timestamp) / (24 * 60));
    return $decimal;
}
