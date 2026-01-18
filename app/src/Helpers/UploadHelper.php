<?php
namespace App\Helpers;

class UploadHelper
{
    public static function uploadImage($file, $targetDir = 'uploads/teams', $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'], $maxSize = 5242880)
    {
        // Basic error checks
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        if (!isset($file['size']) || $file['size'] <= 0 || $file['size'] > $maxSize) {
            return false;
        }

        // Trust server-side MIME detection, not client headers
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($file['tmp_name']) ?: '';
        if (!in_array($detectedMime, $allowedTypes, true)) {
            return false;
        }

        // Validate extension matches allowed MIME type
        $mimeExtensions = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/gif' => ['gif'],
        ];
        $ext = strtolower(pathinfo($file['name'] ?? '', PATHINFO_EXTENSION));
        $validExts = $mimeExtensions[$detectedMime] ?? [];
        if ($ext === '' || !in_array($ext, $validExts, true)) {
            return false;
        }

        // Prevent directory traversal in targetDir
        $targetDir = trim($targetDir, "/\\");
        if ($targetDir === '' || str_contains($targetDir, '..')) {
            return false;
        }

        // Generate random filename
        $filename = 'team_' . bin2hex(random_bytes(16)) . '.' . $ext;

        // Ensure upload directory exists
        $uploadPath = rtrim(ROOT . 'public/' . $targetDir, '/\\');
        if (!is_dir($uploadPath) && !mkdir($uploadPath, 0755, true)) {
            return false;
        }

        // Move file
        $destination = $uploadPath . '/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return false;
        }

        // Return relative path for storage in DB
        return $filename;
    }
}
