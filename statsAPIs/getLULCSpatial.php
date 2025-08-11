<?php
// Include the database connection
require_once 'dbConn.php';

// Read raw POST data
$rawInput = file_get_contents('php://input');

// Decode JSON input
$input = json_decode($rawInput, true);

// Sanitize inputs or set to NULL
$zone = isset($input['zone']) && trim($input['zone']) !== '' ? pg_escape_literal($dbconn, trim($input['zone'])) : 'NULL';
$circle = isset($input['circle']) && trim($input['circle']) !== '' ? pg_escape_literal($dbconn, trim($input['circle'])) : 'NULL';
$division = isset($input['division']) && trim($input['division']) !== '' ? pg_escape_literal($dbconn, trim($input['division'])) : 'NULL';

// Construct the SQL query
$query = "SELECT * FROM get_lulc_class_geom($zone, $circle, $division);";

// Execute the query
$result = pg_query($dbconn, $query);

// Handle query error
if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed: " . pg_last_error($dbconn)
    ]);
    exit;
}

// Fetch result data
$data = [];
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

// Return JSON response
echo json_encode([
    "status" => "success",
    "data" => $data
]);

// Close database connection
pg_close($dbconn);
?>
