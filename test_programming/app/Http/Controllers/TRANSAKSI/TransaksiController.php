<?php

namespace App\Http\Controllers\TRANSAKSI;

use App\Http\Controllers\Controller;
use App\Models\COA\coa;
use App\Models\Transaksi\transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class TransaksiController extends Controller
{
    public function load_coa()
    {
        $coa = coa::orderBy('created_at', 'desc')->get();
        return response()->json($coa);
    }

    public function data(Request $request)
    {
        // $query = transaksi::orderBy('created_at', 'desc')->with('coa');

        // if ($request->has('search') && $request->search['value']) {
        //     $search = $request->search['value'];
        //     $query->where(function ($query) use ($search) {
        //         $query->where('debet', 'like', "%$search%")
        //             ->orWhere('kredit', 'like', "%$search%")
        //             ->orWhere('depart', 'like', "%$search%")
        //             ->orWhere('description', 'like', "%$search%")
        //             ->orWhereHas('coa', function ($query) use ($search) {
        //                 $query->where('mis_kodeacc', 'like', "%$search%");
        //             });
        //     });
        // }

        // $data = $query->get();

        $data = transaksi::orderBy('created_at', 'desc')->get();

        return datatables()->of($data)->make(true);
    }

    public function store(Request $request)
    {
        $transaksi = new transaksi();
        $transaksi->jrcode = $request->jrcode;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->nomor_ref = $request->nomor_ref;
        $transaksi->remark = $request->remark;
        $transaksi->mis_kodeacc = $request->mis_kodeacc;
        $transaksi->description = $request->description;
        $transaksi->departemen = $request->departemen;
        $transaksi->debet = $request->debet;
        $transaksi->kredit = $request->kredit;

        // Menyimpan data
        $data = $transaksi->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Transaksi Jurnal berhasil disimpan',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Transaksi Jurnal gagal disimpan',
            ]);
        }
    }

    public function ambiltransaksi($id)
    {
        $transaksi = transaksi::findOrFail($id);
        if ($transaksi) {
            return response()->json([
                'status' => 'success',
                'transaksi' => $transaksi
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi tidak ditemukan'
            ]);
        }
    }

    public function ubahtransaksi(Request $request)
    {
        $id = $request->id;
        $transaksi = transaksi::find($id);

        if (!$transaksi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaksi Jurnal tidak ditemukan',
            ]);
        }

        $transaksi->jrcode = $request->jrcode;
        $transaksi->tanggal_transaksi = $request->tanggal_transaksi;
        $transaksi->nomor_ref = $request->nomor_ref;
        $transaksi->remark = $request->remark;
        $transaksi->mis_kodeacc = $request->mis_kodeacc;
        $transaksi->description = $request->description;
        $transaksi->departemen = $request->departemen;
        $transaksi->debet = $request->debet;
        $transaksi->kredit = $request->kredit;

        if ($transaksi->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Transaksi Jurnal berhasil diubah',
                'transaksi' => $transaksi,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Transaksi Jurnal gagal diubah',
            ]);
        }
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax()) {

            $transaksi = transaksi::findOrFail($id);

            if ($transaksi) {

                $transaksi->delete();

                return response()->json(array('success' => true));
            }
        }
    }

    public function downloadPDFTransaksi($id)
    {
        $item = transaksi::find($id);

        $getRef = $item->nomor_ref;
        $getCreatedAt = $item->created_at;
        $tanggalDiformat = Carbon::parse($getCreatedAt)->format('d F Y H:i:s');

        $pdf = PDF::loadView('reportTransaksiJurnal', compact('item'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Transaksi Jurnal _ ' . $getRef . ' _ ' . $tanggalDiformat . '.pdf');
    }
}
