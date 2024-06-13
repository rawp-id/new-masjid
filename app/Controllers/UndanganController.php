<?php
namespace App\Controllers;

use App\Models\Kegiatan;
use App\Models\Masjid;
use Core\Controller;
use Core\Database\DB;
use Core\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class UndanganController extends Controller
{
    public function generateUndangan(Request $request)
    {
        $id = $request->input('id');
        // $masjid_id = $request->input('masjid_id');
        $kegiatan = Kegiatan::find($id);
        $masjid = Masjid::find($kegiatan->masjid_id);

        return view('pdf.undangan', [
            'kegiatan' => $kegiatan,
            'masjid' => $masjid,
        ]);

        // $dompdf = new Dompdf();
        // $options = new Options();
        // $options->set('isHtml5ParserEnabled', true);
        // $options->set('isPhpEnabled', true);
        // $dompdf->setOptions($options);

        // $dompdf->loadHtml($pdfView);

        // $dompdf->setPaper('A4', 'portrait');

        // $dompdf->render();

        // return $dompdf->stream('undangan.pdf');
        // return $dompdf->download('undangan.pdf'); // Mengunduh PDF
    }

    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $kegiatan = Kegiatan::find($id);

        $masjid_id = $kegiatan->masjid_id;

        $kegiatanDeleted = Kegiatan::delete($id);

        return redirect('/masjid?id=' . $masjid_id);
    }
}
