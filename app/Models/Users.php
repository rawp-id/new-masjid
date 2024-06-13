<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Users extends Model
{
    public static function migrate()
    {
        Migration::table('users');
        Migration::id()->primaryKey();
        Migration::string('nama', 100);
        Migration::string('email', 50)->unique();
        Migration::string('password');
        Migration::string('kode_verif')->nullable();
        Migration::datetime('verifikasi')->nullable();
        Migration::timestamps();
        Migration::execute();
    }
    protected $table = "users";
    protected $guaded = ['id'];
}
