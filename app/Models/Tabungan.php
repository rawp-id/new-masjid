<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Tabungan extends Model
{
    public static function migrate()
    {
        Migration::table('tabungan');
        Migration::id()->primaryKey();
        Migration::integer('jamaah_id');
        Migration::integer('jumlah');
        Migration::datetime('tanggal');
        Migration::text('keterangan');
        Migration::timestamps();
        Migration::foreign('jamaah_id', 'jamaah');
        Migration::execute();
    }

    protected $table = 'tabungan';
    protected $guaded = ['id'];
}
