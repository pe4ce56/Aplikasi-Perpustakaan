<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\model\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function borrowingBook()
    {
        return view('transaction.borrowing_book');
    }

    public function process(Request $request)
    {
        $transaction = new Transaction;
        // get id operator from login
        $transaction->operator_id = Auth::user()->operator->id;
        $transaction->student_id = $request->student_id;
        $transaction->borrowing_date = $this->getBorrowingDate();
        $transaction->date_of_return = $this->getDateOfReturn();
        // $transaction->status = 'borrowed';

        if ($transaction->save()); {
            $pivotData = array_fill(0, count($request->book_id), ['status' => 'borrowed']);
            $syncData  = array_combine($request->book_id, $pivotData);
            $transaction->book()->sync($syncData);
        }
        alert()->success('Transaction Successfully', 'Thank You!')->persistent('Ok');
        return redirect('/transaction');
    }

    public function report()
    {
        $transactions = Transaction::with('student')->with('operator')->get();
        foreach ($transactions as $i => $transaction) {
            $transactions[$i]['status'] = Transaction::find($transaction->id)->book()->where('status', 'borrowed')->count() . " Book Borrowed";
        }
        return view('transaction.report', ['transactions' => $transactions]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        $transaction->book()->detach();
        $transaction->delete();
        alert()->success('Transaction Deleted Successfully', 'Thank You!')->persistent('Ok');
        return redirect('/report');
    }
    public static function getBorrowingDate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return date('Y-m-d');
    }

    public static function getDateOfReturn()
    {
        date_default_timezone_set('Asia/Jakarta');
        return date('Y-m-d', strtotime(' + 3 days'));
    }
}
