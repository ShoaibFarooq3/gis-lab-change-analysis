<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Include DB connection
require 'db.php';

// Get raw JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Validate and sanitize input
$forest_zone = isset($input['forest_zone']) ? pg_escape_string($input['forest_zone']) : '';

if (empty($forest_zone)) {
    echo json_encode(["status" => "error", "message" => "Missing 'forest_zone' in JSON body"]);
    exit;
}

// Query the geometry
$query = "SELECT forest_zone, ST_AsGeoJSON(geom) AS geojson FROM forest_zones WHERE forest_zone = '$forest_zone'";
$result = pg_query($dbconn, $query);

if (!$result) {
    echo json_encode(["status" => "error", "message" => "Query failed: " . pg_last_error()]);
    exit;
}

// Format result
$zones = [];
while ($row = pg_fetch_assoc($result)) {
    $zones[] = [
        "forest_zone" => $row['forest_zone'],
        "geometry" => json_decode($row['geojson'])
    ];
}

pg_close($dbconn);

// Output
echo json_encode(["status" => "success", "data" => $zones]);
