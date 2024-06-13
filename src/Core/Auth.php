<?php
// app/Auth.php
namespace Core;

use Core\Database;
use Core\User;

class Auth
{
    protected static $user = null;

    public static function check()
    {
        return isset($_SESSION['user']);
    }

    public static function username()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function id()
    {
        return isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    }

    public static function attempt($credentials)
    {
        $email = $credentials['email'];
        $password = $credentials['password'];

        // Query database untuk mencari pengguna dengan kredensial yang diberikan
        $pdo = Database::getPdo();
        $stmt = $pdo->prepare("SELECT id, email, password FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Jika kredensial benar, simpan pengguna di sesi
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email']
            ];
            return true;
        }
        return false;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function user()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if ($userId) {
            return User::find($userId);
        }
        return null;
    }

}
