<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Imports\AttendanceImport;
use Illuminate\Http\Request;
use Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Attendance::orderBy('created_at', 'asc')->get();
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
        $this->validate($request, [ //inputs are not empty or null
            'emp_id' => 'required',
        ]);

        $attendance = new Attendance;
        $attendance->emp_id = $request->emp_id;
        $attendance->checkin = $request->checkin;
        $attendance->checkout = $request->checkout;
        $attendance->total_working_hours = $request->total_working_hours;
        $attendance->save();
        return $attendance;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Attendance::findorFail($id);
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
        $this->validate($request, [ //inputs are not empty or null
            'emp_id' => 'required',
        ]);

        $attendance = Attendance::findorFail($id);
        $attendance->emp_id = $request->emp_id;
        $attendance->checkin = $request->checkin;
        $attendance->checkout = $request->checkout;
        $attendance->total_working_hours = $request->total_working_hours;
        $attendance->save();
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::findorFail($id);
        if($attendance->delete()){
            return 'deleted successfully';
        }
    }

    public function uploadContent(Request $request)
    {
        Excel::import(new AttendanceImport, $request->uploaded_file);
        return "Records imported successfully !";
    }
}
