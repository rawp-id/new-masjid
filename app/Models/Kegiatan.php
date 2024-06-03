<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Kegiatan extends Model
{
    public static function migrate()
    {
        Migration::table('kegiatan');
        Migration::id()->primaryKey();
        Migration::integer('masjid_id');
        Migration::string('acara');
        Migration::datetime('waktu');
        Migration::text('keterangan');
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }
}
