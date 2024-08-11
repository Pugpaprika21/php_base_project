<?php

namespace App\Foundation;

class RequestHandler implements Requestable
{
    public function body(string $method = "post"): array
    {
        $data = [
            'get' => $this->sanitizeInput($_GET),
            'post' => $this->sanitizeInput($_POST),
            'files' => $this->sanitizeFiles($_FILES),
            'cookie' => $this->sanitizeInput($_COOKIE),
            'server' => $this->sanitizeServer($_SERVER),
            'request' => $this->sanitizeInput($_REQUEST),
        ];

        if ($method && isset($data[strtolower($method)])) {
            return $data[strtolower($method)];
        }

        return $data;
    }

    private function sanitizeInput(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->sanitizeInput($value);
            } else {
                $data[$key] = htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
            }
        }
        return $data;
    }

    private function sanitizeFiles(array $files): array
    {
        foreach ($files as $key => $file) {
            if (is_array($file['name'])) {
                foreach ($file['name'] as $index => $name) {
                    $files[$key]['name'][$index] = basename($name);
                }
            } else {
                $files[$key]['name'] = basename($file['name']);
            }
        }
        return $files;
    }

    private function sanitizeServer(array $data): array
    {
        $allowed_keys = [
            'REMOTE_ADDR',
            'REQUEST_METHOD',
            'HTTP_USER_AGENT',
            'HTTP_HOST',
            'REQUEST_URI',
            'QUERY_STRING',
            'SERVER_PROTOCOL'
        ];

        $sanitized = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $allowed_keys)) {
                $sanitized[$key] = htmlspecialchars(strip_tags(trim($value)), ENT_QUOTES, 'UTF-8');
            }
        }

        return $sanitized;
    }
}
