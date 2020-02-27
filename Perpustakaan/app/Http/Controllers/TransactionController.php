<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction', ['active' => 'transasction']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->tgl_peminjaman = $request->borrowedDate;
        $transaction->tgl_peminjaman = $request->borrowedDate;
        $transaction->tgl_kembali = $request->returnedDate;
        $transaction->tbl_siswa_NIS = $request->customerID;
        $transaction->tbl_operator_id_operator = $request->operatorID;
        $transaction->save();

        $id_transaction = DB::table('tbl_transaksi')->select('id_transaksi')->orderByDesc('id_transaksi')->first();
        foreach ($request->bookid as $i => $idBuku) {
            DB::table('tbl_detail_transaksi')->insert(
                [
                    'tbl_transaksi_id_transaksi' => $id_transaction->id_transaksi,
                    'tbl_buku_id_buku' => $idBuku,
                    'jumlah_buku' => $request->amountOfBooks[$i],
                    'status' => 'Belum Kembali'

                ]
            );
        }
        return redirect('/transaction')->with('status', 'Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
