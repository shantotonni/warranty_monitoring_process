<?php

namespace App\Http\Controllers;

use App\Imports\PartsImport;
use App\Models\Parts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class PartsController extends Controller
{
    public function index()
    {
        $inputs = ['searchInput'=>''];
        // $parts = Parts::all();
        $parts = DB::select("SELECT ProductCode,ProductName,UnitPrice from
                        [192.168.100.25].MotorSparePartsMirror.dbo.Product as P
                        WHERE P.Business IN('Q','W')");
        // dd($parts);

        return view('admin.parts.list', compact('parts','inputs'));
    }

    public function import(Request $request) 
    {
        $file = $request->file('filename');

        Excel::import(new PartsImport, $file);
        
        return redirect(route('parts.index'))->with('success', 'Parts Uploaded Successfully');
    }

    public function search(Request $request)
    {
        $inputs = $request->all();
        // dd($request->all());
        $parts = Parts::where('PartsName', 'LIKE', '%'.$request->searchInput.'%')->orWhere('PartsCode', 'LIKE', '%'.$request->searchInput.'%')->get();

        return view('admin.parts.list', compact('parts', 'inputs'));
    }

    public function create()
    {
        return view('admin.parts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'PartsCode' => 'required',
            'PartsName' => 'required',
            'Price' => 'required'
        ]);

        $parts = new Parts;
        $parts->PartsCode = $request->PartsCode;
        $parts->PartsName = $request->PartsName;
        $parts->Price = $request->Price;
        $parts->CreatedAt = Carbon::now();
        $parts->save();

        return redirect(route('parts.index'))->with('success', 'Parts Created Successfully');
    }

    public function edit($id)
    {
        $parts = Parts::findOrFail($id);

        return view('admin.parts.edit', compact('parts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'PartsCode' => 'required',
            'PartsName' => 'required',
            'Price' => 'required'
        ]);

        $parts = Parts::findOrFail($id);
        $parts->PartsCode = $request->PartsCode;
        $parts->PartsName = $request->PartsName;
        $parts->Price = $request->Price;
        $parts->UpdatedAt = Carbon::now();
        $parts->save();

        return redirect(route('parts.index'))->with('success', 'Parts Updated Successfully');
    }

    // public function destroy($id)
    // {
    //     $parts = Parts::findOrFail($id);
    //     $parts->delete();
    //     return redirect(route('parts.index'))->with('success', 'Parts deleted successfully');
    // }

}
