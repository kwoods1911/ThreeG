<?php

namespace App\Http\Controllers;

use App\Models\ShipmentReport;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class ShipmentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //KW - pull information from database.
        $reports = ShipmentReport::all();
        return view('shipmentreport.index')->with('reports',$reports);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shipmentreport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //KW - adding logic to store report information
        $this->validate($request,[
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        // $package->dateofarrival = $request->input('dateofarrival');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        //KW store report parameters in database.
        $shipmentReport = new ShipmentReport;
        $shipmentReport->date_of_report = Carbon::now();/**get current date */
        $shipmentReport->start_date = $startDate;
        $shipmentReport->end_date = $endDate;
        $shipmentReport->save();    


        
        //KW instead store search parameters for report.    



         //KW - run query to get newly created report # and redirect user to that page.   
         
         
         return redirect('/shipmentreport')->with('success','Report Created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShipmentReport  $shipmentReport
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //KW based on shipment report id pull data from database and run a query that will join tables.
        //KW display results of joined tables on the page.
        //KW give user the option to schedule.

        $reportParameters = ShipmentReport::find($id);
    // return view('shipmentreport.show')->('report_data',/**return results from DB query */);
        $startDate = $reportParameters->start_date;
        $endDate = $reportParameters->end_date;
        
        
        //KW - run DB query to join table date.
        //KW pass fetched data to the redirected page.
        $reportData = DB::table('received_packages')
                    ->join('threeg_invoice','threeg_invoice.packageid', '=', 'received_packages.id')
                    ->select('received_packages.*')
                    ->get();

return view('shipmentreport.show')->with('report_parameters',$reportParameters)
                                ->with('report_data',$reportData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentReport  $shipmentReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentReport $shipmentReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentReport  $shipmentReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentReport $shipmentReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShipmentReport  $shipmentReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentReport $shipmentReport)
    {
        //
    }
}
