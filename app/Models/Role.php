<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Role extends Model
{
    public static function migrate()
    {
        Migration::table('roles');
        Migration::id()->primaryKey();
        Migration::string('nama');
        Migration::text('keterangan');
        Migration::timestamps();
        Migration::execute();
    }

    protected $table = 'roles';
    protected $guaded = ['id'];
}
