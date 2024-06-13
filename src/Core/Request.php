<?php
// src/Core/Request.php
namespace Core;

class Request {
    public $method;
    public $path;
    public $params;

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_SERVER['REQUEST_URI'];
        $this->params = $_REQUEST;
    }

    public function query($key) {
        return isset($this->params[$key]) ? $this->params[$key] : null;
    }

    public function input($key) {
        if(isset($this->params[$key])) {
            return $this->params[$key];
        }
    
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
    
        if($data !== null && isset($data[$key])) {
            return $data[$key];
        }
    
        return null;
    }    

    public function form($key) {
        return isset($_POST[$key]) ? $_POST[$key] : null;
    }

    public function json() {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function isMethod($method) {
        return strtoupper($method) === $this->method;
    }

    public function validate($rules) {
        $errors = [];

        foreach ($rules as $field => $rule) {
            $value = $this->input($field);
            $rulesArray = explode('|', $rule);

            foreach ($rulesArray as $singleRule) {
                $singleRuleArray = explode(':', $singleRule);
                $ruleName = $singleRuleArray[0];

                switch ($ruleName) {
                    case 'required':
                        if (!$value) {
                            $errors[$field] = "$field is required.";
                        }
                        break;
                    case 'max':
                        $maxLength = $singleRuleArray[1];
                        if (strlen($value) > $maxLength) {
                            $errors[$field] = "$field must be at most $maxLength characters.";
                        }
                        break;
                    // Tambahkan lebih banyak aturan validasi sesuai kebutuhan
                }
            }
        }

        if (!empty($errors)) {
            throw new \Exception(json_encode($errors));
        }

        return $this->params;
    }

    public function file($key) {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }

    public function hasFile($key) {
        return isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK;
    }
}
