<?php
session_start();

header('Content-Type: application/json');

// Clear all session data
session_destroy();

echo json_encode(['success' => true]); 