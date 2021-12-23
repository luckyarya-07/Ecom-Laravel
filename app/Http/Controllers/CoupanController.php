<?php

namespace App\Http\Controllers;

use App\Models\Coupan;
use Illuminate\Http\Request;
use Auth;

class CoupanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        
        $all__data = Coupan::where('user_id', $user_id)->get(); 

        return view('admin/coupan/coupan', compact('all__data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/coupan/create_coupan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_Data = $this->validate($request, [
            'user_id'       => 'required|integer',
            'coupan_name'   => 'required|min:2|max:255|string',
            'coupan_code'   => 'required|unique:coupan,coupan_code',
            'coupan_amount' => 'required|integer',
            'start_date'    => 'required|date',
            'coupan_validity'    => 'required|date|after_or_equal:start_date'
        ]);
        Coupan::create($validated_Data);
        return redirect()->route('coupan.index')->withSuccess('You have successfully created a Coupan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupan  $coupan
     * @return \Illuminate\Http\Response
     */
    public function show(Coupan $coupan)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupan  $coupan
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupan $coupan)
    {
        
        return view('admin/coupan/update_coupan', compact('coupan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupan  $coupan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupan $coupan)
    {
        $id = $coupan->id;
        $update__data = Coupan::find($id);
        $request->validate([
            'user_id'       => 'required|integer',
            'coupan_name'   => 'required|min:2|max:255|string',
            'coupan_code'   => 'required|unique:coupan,coupan_code,'.$coupan->id,
            'coupan_amount' => 'required|integer',
            'start_date'    => 'required|date',
            'coupan_validity'    => 'required|date|after_or_equal:start_date'
        ]);
        $update__data->coupan_name = $request->coupan_name;
        $update__data->coupan_code = $request->coupan_code;
        $update__data->coupan_amount = $request->coupan_amount;
        $update__data->start_date = $request->start_date;
        $update__data->coupan_validity = $request->coupan_validity;
        $update__data->save();
         return redirect()->route('coupan.index')->withSuccess('You have successfully updated a Coupan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupan  $coupan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupan $coupan)
    {
        
        $delete = Coupan::findOrFail($coupan->id);
        $delete->delete();
        return redirect()->route('coupan.index')->withSuccess('You have successfully delete a Category!');
    }
}
