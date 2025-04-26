<?php
session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$nickname = $data['nickname'] ?? '';
$country = $data['country'] ?? '';
$bio = $data['bio'] ?? '';
$oldPassword = $data['oldPassword'] ?? null;
$newPassword = $data['newPassword'] ?? null;

try {
    $updates = [];
    $params = [];

    // Update profile information
    if (!empty($nickname)) {
        $updates[] = 'nickname = ?';
        $params[] = $nickname;
    }
    if (!empty($country)) {
        $updates[] = 'country = ?';
        $params[] = $country;
    }
    if (!empty($bio)) {
        $updates[] = 'bio = ?';
        $params[] = $bio;
    }

    // Handle password change if requested
    if ($oldPassword && $newPassword) {
        // Verify old password
        $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $user = $stmt->fetch();

        if (!password_verify($oldPassword, $user['password_hash'])) {
            echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
            exit;
        }

        $updates[] = 'password_hash = ?';
        $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    if (!empty($updates)) {
        $params[] = $_SESSION['user_id'];
        $sql = 'UPDATE users SET ' . implode(', ', $updates) . ' WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
} 