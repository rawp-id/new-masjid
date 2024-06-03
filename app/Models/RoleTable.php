<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class RoleTable extends Model
{
    public static function migrate()
    {
        Migration::table('role_tables');
        Migration::id()->primaryKey();
        Migration::integer('user_id');
        Migration::integer('role_id');
        Migration::timestamps();
        Migration::foreign('user_id','users');
        Migration::foreign('role_id','roles');
        Migration::execute();
    }
}
