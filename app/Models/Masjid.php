<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Masjid extends Model
{
    public static function migrate()
    {
        Migration::table('masjid');
        Migration::id()->primaryKey();
        Migration::string('nama');
        Migration::text('alamat');
        Migration::text('keterangan');
        Migration::string('kode_ms')->unique();
        Migration::timestamps();
        Migration::execute();
    }
}
