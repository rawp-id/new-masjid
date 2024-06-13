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
        Migration::text('rincian')->nullable();
        Migration::text('keterangan')->nullable();
        Migration::integer('masjid_id');
        Migration::datetime('waktu');
        Migration::enum('status', ['sah', 'tidak sah'])->nullable()->default('tidak sah');
        Migration::string('bukti')->nullable();
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }

    protected $table = 'zakat';
    protected $guaded = ['id'];
}
