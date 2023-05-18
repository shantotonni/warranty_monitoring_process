<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Region;
use App\Models\User;
use App\Models\UserArea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAreas = UserArea::paginate(10);
        return view('admin.user_area.list', compact('userAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $engineers = User::where('RoleId', '3')->get();
        $areas = Area::all();
        $regions = Region::all();

        return view('admin.user_area.create', compact('engineers', 'areas', 'regions'));
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
            'UserId' => 'required',
            'AreaId' => 'required',
            'RegionId' => 'required',
        ]);

        $userArea = new UserArea;
        $userArea->UserId = $request->UserId;
        $userArea->AreaId = $request->AreaId;
        $userArea->RegionId = $request->RegionId;
        $userArea->CreatedAt = Carbon::now();
        $userArea->save();

        return redirect(route('user-areas.index'))->with('success', 'Engineer-Area Mapped successfully');
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
        $areas = Area::all();
        $engineers = User::where('RoleId', '3')->get();
        $regions = Region::all();
        $userArea = UserArea::findOrFail($id);

        return view('admin.user_area.edit', compact('areas','engineers', 'userArea', 'regions'));
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
            'UserId' => 'required',
            'AreaId' => 'required',
            'RegionId' => 'required',
        ]);

        $userArea = UserArea::findOrFail($id);
        $userArea->UserId = $request->UserId;
        $userArea->AreaId = $request->AreaId;
        $userArea->RegionId = $request->RegionId;
        $userArea->UpdatedAt = Carbon::now();
        $userArea->save();

        return redirect(route('user-areas.index'))->with('success', 'User-Area updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userArea = UserArea::findOrFail($id);
        $userArea->delete();
        return redirect(route('user-areas.index'))->with('success', 'Engineer-Area deleted successfully');
    }

    public function getAreasByRegion(Request $request)
    {
    //    return $request->region_id;
        $areas = Area::where('RegionId', $request->region_id)->pluck('Name', 'Id');
        return  json_encode($areas);

    }
}
