<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class DetailKeuangan extends Model
{
    public static function migrate()
    {
        Migration::table('detail_keuangan');
        Migration::id()->primaryKey();
        Migration::integer('masjid_id');
        Migration::enum('jenis', ['pemasukan', 'pengeluaran']);
        Migration::integer('jumlah');
        Migration::datetime('tanggal');
        Migration::text('keterangan');
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }
}
