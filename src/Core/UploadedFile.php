<?php
// src/Core/UploadedFile.php

namespace Core;

class UploadedFile
{
    protected $file;
    protected $hashedFileName;
    protected $targetPath;

    public function __construct($file)
    {
        $this->file = $file;
        $this->hashedFileName = $this->generateHashName();
    }

    public function getOriginalName()
    {
        if ($this->file) {
            return $this->file['name']; // Menggunakan $this->file['name'] karena kita menggunakan PHP native $_FILES
        }
        return null;
    }

    public function getClientOriginalName()
    {
        return $this->getOriginalName();
    }

    public function getSize()
    {
        return $this->file['size']; // Menggunakan $this->file['size'] karena kita menggunakan PHP native $_FILES
    }

    public function getMimeType()
    {
        return $this->file['type']; // Menggunakan $this->file['type'] karena kita menggunakan PHP native $_FILES
    }

    public function move($destination)
    {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $this->targetPath = $destination . DIRECTORY_SEPARATOR . $this->hashedFileName;
        move_uploaded_file($this->file['tmp_name'], $this->targetPath); // Menggunakan move_uploaded_file karena kita menggunakan PHP native $_FILES

        return $this->targetPath;
    }

    protected function generateHashName()
    {
        return md5(uniqid() . $this->getOriginalName() . time()) . '.' . pathinfo($this->getOriginalName(), PATHINFO_EXTENSION);
    }

    public function isValid()
    {
        return $this->file['error'] === UPLOAD_ERR_OK;
    }

    public function getFileHash()
    {
        return $this->targetPath ? hash_file('sha256', $this->targetPath) : null;
    }

    public function getHashedFileName()
    {
        return $this->hashedFileName;
    }
    public function isValidFileSize($maxSize)
    {
        // Mengonversi ukuran maksimum file ke dalam bytes jika diberikan dalam format lain (misal: '5MB')
        $maxFileSize = $this->parseFileSize($maxSize);

        // Check if file size is within the allowed limit
        return $this->file['size'] <= $maxFileSize;
    }

    protected function parseFileSize($size)
    {
        $unit = strtoupper(substr($size, -2));
        $value = (int) substr($size, 0, -2);

        switch ($unit) {
            case 'KB':
                return $value * 1024;
            case 'MB':
                return $value * 1024 * 1024;
            case 'GB':
                return $value * 1024 * 1024 * 1024;
            default:
                return $value;
        }
    }
}