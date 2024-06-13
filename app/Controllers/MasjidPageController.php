<?php
namespace App\Controllers;

use App\Models\DetailKeuangan;
use App\Models\Jamaah;
use App\Models\Kegiatan;
use App\Models\KeuanganMasjid;
use App\Models\ManageMasjid;
use App\Models\Masjid;
use App\Models\Role;
use App\Models\Tabungan;
use App\Models\Users;
use App\Models\Zakat;
use Core\Auth;
use Core\Controller;
use Core\Database\DB;
use Core\Request;

class MasjidPageController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->params['id'];
        if (!$id) {
            return redirect('/home');
        }

        $masjid = Masjid::find($id);
        if (!$masjid) {
            return redirect('/home');
        }

        // Mendapatkan data terkait masjid berdasarkan ID masjid
        $detailKeuangan = DetailKeuangan::where('masjid_id', '=', $id);
        $keuangan = KeuanganMasjid::first('masjid_id', '=', $id);
        $countJamaah = count(Jamaah::where('masjid_id', '=', $id));
        $countZakat = count(Zakat::where('masjid_id', '=', $id));
        $manageMasjid = ManageMasjid::where('masjid_id', '=', $id);
        $zakat = Zakat::where('masjid_id', '=', $id);
        $dataJamaah = Jamaah::where('masjid_id', '=', $id);
        $kegiatan = Kegiatan::where('masjid_id', '=', $id);
        $totalTabungan = 0;
        $manages = [];
        $jamaah_data = [];

        $role_id = ManageMasjid::first('user_id', '=', Auth::id());
        // $role = $role->role_id;

        // Mengumpulkan data manajemen masjid
        foreach ($manageMasjid as $manage) {
            $user = Users::find($manage->user_id);
            $role = Role::find($manage->role_id);
            $manages[] = [
                'manage' => $manage,
                'user' => $user,
                'role' => $role
            ];
        }

        foreach ($dataJamaah as $jamaah) {
            $tabunganData = Tabungan::where('jamaah_id', '=', $jamaah->id);
            $tabungan = 0;
            foreach ($tabunganData as $t) {
                $tabungan += $t->jumlah;
                $totalTabungan += $t->jumlah;
            }
            $jamaah_data[] = [
                'jamaah' => $jamaah,
                'dataTabungan' => $tabunganData,
                'tabungan' => $tabungan
            ];
        }

        // Menampilkan view dengan data yang telah dikumpulkan
        return view('dashboard.index', [
            'id' => $id,
            'masjid' => $masjid,
            'detailKeuangan' => $detailKeuangan,
            'keuangan' => $keuangan,
            'kegiatan' => $kegiatan,
            'countJamaah' => $countJamaah,
            'manages' => $manages,
            'dataJamaah' => $jamaah_data,
            'totalTabungan' => $totalTabungan,
            'dataZakat' => $zakat,
            'totalZakat' => $countZakat,
            'role' => $role_id,
        ]);
    }

    public function hapusJamaah(Request $request)
    {
        $id = $request->input('id');
        $Jamaah = Jamaah::find($id);

        $masjid_id = $Jamaah->masjid_id;

        $tabungan = Tabungan::where('jamaah_id', '=', $id);

        foreach ($tabungan as $t) {
            Tabungan::delete($t->id);
        }

        $JamaahDeleted = Jamaah::delete($id);

        return redirect('/masjid?id=' . $masjid_id);
    }

    public function hakAkses(Request $request)
    {
        $id = $request->input('id');
        $role = $request->input('role');

        $manage = ManageMasjid::find($id);
        $manage->role_id = $role ?? $manage->role_id;

        ManageMasjid::update($id, $manage);

        return redirect('/masjid?id=' . $manage->masjid_id);
    }

    public function hapusTabungan(Request $request)
    {
        $id = $request->input('id');
        $masjid_id = $request->input('masjid_id');
        $Tabungan = Tabungan::find($id);

        // $jamaah = $Tabungan->jamaah_id;

        // $masjid_id=Jamaah::first('jamaah_id','=',$jamaah)->masjid_id;

        $TabunganDeleted = Tabungan::delete($id);

        return redirect('/masjid?id=' . $masjid_id);
    }

    public function updateJamaah(Request $request)
    {
        $id = $request->params['id'];
        $nama_jamaah = $request->input('nama_jamaah');
        $alamat_jamaah = $request->input('alamat_jamaah');
        $jenis_kelamin_jamaah = $request->input('alamat_jamaah');

        $jamaah = Jamaah::find($id);

        // $jamaah = $Tabungan->jamaah_id;

        // $masjid_id=Jamaah::first('jamaah_id','=',$jamaah)->masjid_id;

        $jamaahData = [
            'nama' => $nama_jamaah ?? $jamaah->nama,
            'alamat' => $alamat_jamaah ?? $jamaah->alamat,
            'jenis_kelamin' => $jenis_kelamin_jamaah ?? $jamaah->jenis_kelamin,
            'masjid_id' => $jamaah->masjid_id,
        ];

        $TabunganDeleted = Jamaah::update($id, $jamaahData);

        return redirect('/masjid?id=' . $jamaah->masjid_id);
    }

}
