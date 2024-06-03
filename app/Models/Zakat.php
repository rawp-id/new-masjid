<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Zakat extends Model
{
    public static function migrate()
    {
        Migration::table('zakat');
        Migration::id()->primaryKey();
        Migration::string('nama');
        Migration::integer('jumlah');
        Migration::text('alamat');
        Migration::text('rincian');
        Migration::text('keterangan');
        Migration::integer('masjid_id');
        Migration::datetime('waktu');
        Migration::enum('status', ['sah', 'tidak sah']);
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }
}
