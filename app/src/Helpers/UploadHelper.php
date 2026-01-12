<?php
namespace App\Helpers;

class UploadHelper
{
    public static function uploadImage($file, $targetDir = 'uploads/teams', $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'], $maxSize = 5242880)
    {
        // Basic error check
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Check file type and size
        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }
        if ($file['size'] > $maxSize) {
            return false;
        }

        // Generate unique filename
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('team_', true) . '.' . $ext;
        // Ensure upload directory exists
        $uploadPath = __DIR__ . '/../../public/' . $targetDir;
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        // Move file
        $destination = $uploadPath . '/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return false;
        }
        // Return relative path for storage in DB
        return $targetDir . '/' . $filename;
    }
}
