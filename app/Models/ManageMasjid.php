<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class ManageMasjid extends Model
{
    public static function migrate()
    {
        Migration::table('manage_masjid');
        Migration::id()->primaryKey();
        Migration::integer('user_id');
        Migration::integer('masjid_id');
        Migration::integer('role_id');
        Migration::timestamps();
        Migration::foreign('user_id','users');
        Migration::foreign('masjid_id','masjid');
        Migration::foreign('role_id','roles');
        Migration::execute();
    }

    protected $table = 'manage_masjid';
    protected $guaded = ['id'];
}
