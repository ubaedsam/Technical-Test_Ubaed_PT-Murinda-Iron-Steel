<?php

namespace App\Http\Controllers\COA;

use App\Http\Controllers\Controller;
use App\Models\COA\coa;
use App\Models\CYY\cyy;
use App\Models\Transaksi\transaksi;
use Illuminate\Http\Request;

class COAController extends Controller
{
    public function index()
    {
        $ccy = cyy::orderBy('created_at', 'desc')->get();

        return view('master_coa', compact('ccy'));
    }

    public function data(Request $request)
    {
        $query = Coa::orderBy('created_at', 'desc')->with('currency');

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('mis_kodeacc', 'like', "%$search%")
                    ->orWhere('namaacc', 'like', "%$search%")
                    ->orWhere('tipeacc', 'like', "%$search%")
                    ->orWhere('levelacc', 'like', "%$search%")
                    ->orWhere('parentacc', 'like', "%$search%")
                    ->orWhere('groupacc', 'like', "%$search%")
                    ->orWhere('controlacc', 'like', "%$search%")
                    ->orWhereHas('currency', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%");
                    });
            });
        }

        $data = $query->get();

        return datatables()->of($data)->make(true);
    }

    public function store(Request $request)
    {
        $coa = new Coa();
        $coa->mis_kodeacc = $request->mis_kodeacc;
        $coa->namaacc = $request->namaacc;
        $coa->tipeacc = $request->tipeacc;
        $coa->levelacc = $request->levelacc;
        $coa->parentacc = $request->parentacc;
        $coa->groupacc = $request->groupacc;
        $coa->controlacc = $request->controlacc;
        $coa->mis_ccy = $request->mis_ccy;

        // Cek apakah checkbox dicentang, jika ya maka simpan 'Y', jika tidak simpan null atau nilai default
        $coa->depart = $request->has('depart') ? 'Y' : null;
        $coa->gainloss = $request->has('gainloss') ? 'Y' : null;

        // Menyimpan data
        $data = $coa->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data COA berhasil disimpan',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data COA gagal disimpan',
            ]);
        }
    }

    public function ambilcoa($mis_kodeacc)
    {
        $coa = Coa::findOrFail($mis_kodeacc);
        if ($coa) {
            return response()->json([
                'status' => 'success',
                'coa' => $coa
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Coa tidak ditemukan'
            ]);
        }
    }

    public function ubahcoa(Request $request)
    {
        $mis_kodeacclama = $request->mis_kodeacclama;

        $coaExists = transaksi::where('mis_kodeacc', $mis_kodeacclama)->exists();

        if ($coaExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data COA ini tidak bisa diubah karena sudah digunakan'
            ]);
        }

        $coa = Coa::find($mis_kodeacclama);

        if (!$coa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Coa tidak ditemukan',
            ]);
        }

        $coa->mis_kodeacc = $request->mis_kodeacc;
        $coa->namaacc = $request->namaacc;
        $coa->tipeacc = $request->tipeacc;
        $coa->levelacc = $request->levelacc;
        $coa->parentacc = $request->parentacc;
        $coa->groupacc = $request->groupacc;
        $coa->controlacc = $request->controlacc;
        $coa->mis_ccy = $request->mis_ccy;

        // Cek apakah checkbox dicentang, jika ya maka simpan 'Y', jika tidak simpan null atau nilai default
        $coa->depart = $request->has('depart') ? 'Y' : null;
        $coa->gainloss = $request->has('gainloss') ? 'Y' : null;

        if ($coa->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Coa berhasil diubah',
                'coa' => $coa,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Coa gagal diubah',
            ]);
        }
    }

    public function delete(Request $request, $mis_kodeacc)
    {
        if ($request->ajax()) {
            $coaExists = transaksi::where('mis_kodeacc', $mis_kodeacc)->exists();

            if ($coaExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data COA ini tidak bisa dihapus karena sudah digunakan'
                ]);
            } else {
                $coa = Coa::findOrFail($mis_kodeacc);

                if ($coa) {

                    $coa->delete();

                    return response()->json(array('success' => true));
                }
            }
        }
    }

    public function load_coa()
    {
        $coa = coa::orderBy('created_at', 'desc')->first();

        return response()->json($coa);
    }
}
