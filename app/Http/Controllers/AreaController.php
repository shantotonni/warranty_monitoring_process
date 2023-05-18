<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::paginate(10);
        return view('admin.area.list', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.area.create', compact('regions'));
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
            'NameBn' => 'required',
            'RegionId' => 'required',
        ]);

        $area = new Area;
        $area->Name = $request->Name;
        $area->NameBn = $request->NameBn;
        $area->RegionId = $request->RegionId;
        $area->CreatedAt = Carbon::now();
        $area->save();

        return redirect(route('areas.index'))->with('success', 'Area created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);

        return view('admin.area.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $regions = Region::all();

        return view('admin.area.edit', compact('area','regions'));
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
            'RegionId' => 'required',
        ]);

        $area = Area::findOrFail($id);
        $area->Name = $request->Name;
        $area->NameBn = $request->NameBn;
        $area->RegionId = $request->RegionId;
        $area->UpdatedAt = Carbon::now();
        $area->save();

        return redirect(route('areas.index'))->with('success', 'Area updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect(route('areas.index'))->with('success', 'Area deleted successfully');
    }
}
