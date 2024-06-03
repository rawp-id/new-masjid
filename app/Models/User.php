<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class User extends Model
{
    public static function migrate()
    {
        Migration::table('users');
        Migration::id()->primaryKey();
        Migration::string('nama',100);
        Migration::string('email',50)->unique();
        Migration::string('password');
        Migration::string('kode_verif');
        Migration::datetime('verifikasi');
        Migration::timestamps();
        Migration::execute();
    }
}
