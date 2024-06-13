<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class KeuanganMasjid extends Model
{
    public static function migrate()
    {
        Migration::table('keuangan_masjid');
        Migration::id()->primaryKey();
        Migration::integer('masjid_id');
        Migration::bigInt('jumlah');
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }

    protected $table = 'keuangan_masjid';
    protected $guaded = ['id'];
}
