<?php

//mysql query for get markers

$places = [
    ['lat' => 58.247537, 'lng' => 22.479283],
    ['lat' => 58.247537, 'lng' => 22.48],
    ['lat' => 58.25, 'lng' => 22.48],
];

echo json_encode($places);

//json_last_error