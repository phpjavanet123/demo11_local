<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;
use League\Csv\XMLConverter;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*
        $transactions = Auth::user()->wallet()->firstOrFail()->transactionsFromTo();
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($transactions, ['id', 'default_currency_amount', 'updated_at']);
        $csvExporter->download();
        exit;
        //https://packagist.org/packages/usmanhalalit/laracsv
        //https://csv.thephpleague.com/
        $users = User::get(); // All users
        $csvExporter = new \Laracsv\Export();
        //$csvExporter->build($users, ['email', 'name'])->download();
        $csvExporter->build($users, ['email', 'name']);
        $csvWriter = $csvExporter->getWriter();
        $csvRow = [
            'title' => ['Total', 'Total Default'],
            'data' => ['300', '200'],
        ];
        $csvWriter->insertOne($csvRow['title']);
        $csvWriter->insertOne($csvRow['data']);
        //$csvExporter->download();

        $converter = (new XMLConverter())
            ->rootElement('csv')
            ->recordElement('record', 'offset')
            ->fieldElement('field', 'name');

        $dom = $converter->convert($csvExporter->getReader()->getIterator());
        $dom->formatOutput = true;
        $dom->encoding = 'iso-8859-15';

        $filename = date('Y-m-d_His') . '.xml';
        //$this->writer->output($filename);
        //$csvExporter->getWriter()->output($filename);

        $csv = Writer::createFromString($dom->saveXML());
        $csv->output($filename);
        //echo '<pre>', PHP_EOL;
        //echo htmlentities($dom->saveXML());

        exit;
        */
        $parameters = $request->all();
        $parameters['export'] = 'csv';
        $exportFileUrl = new \StdClass();
        $exportFileUrl->csvUrl = route('transactions.index', $parameters);

        $parameters['export'] = 'xml';
        $exportFileUrl->xmlUrl = route('transactions.index', $parameters);

        //echo '<pre>';
        //$id = Auth::user()->id;
        $fromDate = $request->get('date_from', null);
        $toDate = $request->get('to_from', null);
        $fromDate = $fromDate ? new Carbon($fromDate) : null;
        $toDate = $toDate ? new Carbon($toDate) : null;

        $userID = $request->get('user_id', null);
        $user = $userID ? User::findOrFail($userID) : Auth::user();
        //$transactions = Auth::user()->wallet()->firstOrFail()->transactionsFromTo(new Carbon('2019-11-24'));
        $transactions = $user->wallet()->firstOrFail()->transactionsFromTo($fromDate, $toDate);
        $transactionsSum = $transactions->sum('from_wallet_currency_amount');
        $transactionsDefaultSum = $transactions->sum('default_currency_amount');

        //SOT BY ID, and restrict by filter
        //print_r($transactions->toArray());
        $users = User::all();
        return view('transactions.index', compact(
            'users',
            'transactions',
            'transactionsSum',
            'transactionsDefaultSum',
            'exportFileUrl'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
