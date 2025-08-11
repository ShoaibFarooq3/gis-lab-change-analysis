<?php
// Set response headers
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Include database connection
require 'dbConn.php';

// Read the raw POST body and decode JSON
$input = json_decode(file_get_contents('php://input'), true);

// Extract and sanitize input fields (can be null or strings)
$zone = isset($input['zone']) && trim($input['zone']) !== '' ? pg_escape_literal($dbconn, trim($input['zone'])) : 'NULL';
$circle = isset($input['circle']) && trim($input['circle']) !== '' ? pg_escape_literal($dbconn, trim($input['circle'])) : 'NULL';
$division = isset($input['division']) && trim($input['division']) !== '' ? pg_escape_literal($dbconn, trim($input['division'])) : 'NULL';

// Build the query (call the new function with optional parameters)
$query = "SELECT * FROM public.get_lulc_class_stats_by_zcd($zone, $circle, $division) AS stats";

// Execute the query
$result = pg_query($dbconn, $query);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . pg_last_error($dbconn)
    ]);
    exit;
}

// Fetch result
$row = pg_fetch_assoc($result);
$data = json_decode($row['stats'], true);

// Return JSON response
echo json_encode([
    "status" => "success",
    "data" => $data
]);

// Close DB connection
pg_close($dbconn);
?>
