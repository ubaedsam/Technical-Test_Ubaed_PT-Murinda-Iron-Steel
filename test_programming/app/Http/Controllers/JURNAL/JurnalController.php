<?php

namespace App\Http\Controllers\JURNAL;

use App\Http\Controllers\Controller;
use App\Models\JURNAL\jurnal;
use App\Models\Transaksi\transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        return view('master_jurnal');
    }

    public function data()
    {
        $data = jurnal::orderBy('created_at', 'desc')->get();

        return datatables()->of($data)->make(true);
    }

    public function store(Request $request)
    {
        $jurnal = new jurnal();
        $jurnal->jrcode = $request->jrcode;
        $jurnal->nama = $request->nama;
        $jurnal->nomor_terakhir = $request->nomor_terakhir;
        $jurnal->keterangan = $request->keterangan;

        $data = $jurnal->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Jurnal berhasil disimpan',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Jurnal gagal disimpan',
            ]);
        }
    }

    public function ambiljurnal($jrcode)
    {
        $jurnal = jurnal::findOrFail($jrcode);
        if ($jurnal) {
            return response()->json([
                'status' => 'success',
                'jurnal' => $jurnal
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Jurnal tidak ditemukan'
            ]);
        }
    }

    public function ubahjurnal(Request $request)
    {
        $jrcodelama = $request->jrcodelama;

        $jurnalExists = transaksi::where('jrcode', $jrcodelama)->exists();

        if ($jurnalExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data jurnal ini tidak bisa diubah karena sudah digunakan'
            ]);
        }

        $jurnal = jurnal::find($jrcodelama);

        if (!$jurnal) {
            return response()->json([
                'status' => 'error',
                'message' => 'Jurnal tidak ditemukan',
            ]);
        }

        $jurnal->jrcode = $request->jrcode;
        $jurnal->nama = $request->nama;
        $jurnal->nomor_terakhir = $request->nomor_terakhir;
        $jurnal->keterangan = $request->keterangan;

        if ($jurnal->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Jurnal berhasil diubah',
                'jurnal' => $jurnal,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Jurnal gagal diubah',
            ]);
        }
    }

    public function delete(Request $request, $jrcode)
    {
        if ($request->ajax()) {
            $jurnalExists = transaksi::where('jrcode', $jrcode)->exists();

            if ($jurnalExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data jurnal ini tidak bisa dihapus karena sudah digunakan'
                ]);
            } else {
                $jurnal = jurnal::findOrFail($jrcode);

                if ($jurnal) {

                    $jurnal->delete();

                    return response()->json(array('success' => true));
                }
            }
        }
    }

    public function load_jurnal()
    {
        $jurnal = jurnal::orderBy('created_at', 'desc')->get();
        return response()->json($jurnal);
    }
}
