<?php
namespace App\Models;

use Core\Migration;
use Core\Model;

class Jamaah extends Model
{
    public static function migrate()
    {
        Migration::table('jamaah');
        Migration::id()->primaryKey();
        Migration::string('nama');
        Migration::text('alamat');
        Migration::enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
        Migration::integer('masjid_id');
        Migration::timestamps();
        Migration::foreign('masjid_id', 'masjid');
        Migration::execute();
    }

    protected $table = 'jamaah';
    protected $guaded = ['id'];
}
