<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::paginate(10);
        return view('admin.region.list', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.region.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'NameBn' => 'required'
        ]);

        $region = new Region;
        $region->Name = $request->Name;
        $region->NameBn = $request->NameBn;
        $region->CreatedAt = Carbon::now();
        $region->save();

        return redirect(route('regions.index'))->with('success', 'Region created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::findOrFail($id);

        return view('admin.region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::findOrFail($id);

        return view('admin.region.edit', compact('region'));
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
        $request->validate([
            'Name' => 'required',
            'NameBn' => 'required',
        ]);

        $region = Region::findOrFail($id);
        $region->Name = $request->Name;
        $region->NameBn = $request->NameBn;
        $region->UpdatedAt = Carbon::now();
        $region->save();

        return redirect(route('regions.index'))->with('success', 'Region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect(route('regions.index'))->with('success', 'Region deleted successfully');
    }
}
