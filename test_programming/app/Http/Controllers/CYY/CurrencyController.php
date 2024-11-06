<?php

namespace App\Http\Controllers\CYY;

use App\Http\Controllers\Controller;
use App\Models\COA\coa;
use App\Models\CYY\cyy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function generateID($prefix, $tableName, $columnName, $aditionalWhere = null)
    {
        $prefixLength = strlen($prefix);

        $numberBefore = DB::table($tableName)
            ->selectRaw('SUBSTR(' . $columnName . ', ' . ($prefixLength + 1) . ') as code')
            ->orderByRaw('CAST(SUBSTR(' . $columnName . ', ' . ($prefixLength + 1) . ') AS SIGNED) desc')
            ->whereRaw('SUBSTR(' . $columnName . ',1, ' . ($prefixLength) . ') = \'' . $prefix . '\'');

        if ($aditionalWhere != null) {
            $numberBefore = $numberBefore->whereRaw($aditionalWhere);
        }

        $numberBefore = $numberBefore->first();

        if ($numberBefore == null) {
            return $prefix . '00001';
        }

        $currentNumber = (int)$numberBefore->code + 1;

        switch ($currentNumber) {
            case $currentNumber < 10:
                $currentCode = $prefix . '0000' . $currentNumber;
                break;
            case $currentNumber < 100:
                $currentCode = $prefix . '000' . $currentNumber;
                break;
            case $currentNumber < 1000:
                $currentCode = $prefix . '00' . $currentNumber;
                break;
            case $currentNumber < 10000:
                $currentCode = $prefix . '0' . $currentNumber;
                break;
            default:
                $currentCode = $prefix . $currentNumber;
                break;
        }

        return $currentCode;
    }

    public function index()
    {
        return view('master_currency');
    }

    public function data()
    {
        $data = cyy::orderBy('created_at', 'desc')->get();

        return datatables()->of($data)->make(true);
    }

    public function store(Request $request)
    {
        $mis_ccy = $this->generateID('CYY', 'currency', 'mis_ccy');

        $currency = new cyy();
        $currency->mis_ccy = $mis_ccy;
        $currency->ccy = $request->ccy;
        $currency->name = $request->name;

        $data = $currency->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Currency berhasil disimpan',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Currency gagal disimpan',
            ]);
        }
    }

    public function ambilcurrency($mis_ccy)
    {
        $ccy = cyy::findOrFail($mis_ccy);
        if ($ccy) {
            return response()->json([
                'status' => 'success',
                'ccy' => $ccy
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Currency tidak ditemukan'
            ]);
        }
    }

    public function ubahcurrency(Request $request)
    {
        $misccy = $request->misccy;

        $currencyExists = coa::where('mis_ccy', $misccy)->exists();

        if ($currencyExists) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data currency ini tidak bisa diubah karena sudah digunakan'
            ]);
        }

        $currency = cyy::find($misccy);

        if (!$currency) {
            return response()->json([
                'status' => 'error',
                'message' => 'Currency tidak ditemukan',
            ]);
        }

        $currency->ccy = $request->ccy;
        $currency->name = $request->name;

        if ($currency->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Currency berhasil diubah',
                'currency' => $currency,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Currency gagal diubah',
            ]);
        }
    }

    public function delete(Request $request, $mis_ccy)
    {
        if ($request->ajax()) {
            $currencyExists = coa::where('mis_ccy', $mis_ccy)->exists();

            if ($currencyExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data currency ini tidak bisa dihapus karena sudah digunakan'
                ]);
            } else {
                $ccy = cyy::findOrFail($mis_ccy);

                if ($ccy) {

                    $ccy->delete();

                    return response()->json(array('success' => true));
                }
            }
        }
    }
}
