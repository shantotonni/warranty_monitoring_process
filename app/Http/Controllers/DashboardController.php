<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use App\Models\PartsDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\WarrantyClaimInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->RoleId;

        if($role == 1){
            $user = Auth::user()->Id;
            $data = WarrantyClaimInfo::where('SPOId', $user)->get();
        }
        if($role == 2){
            $data = WarrantyClaimInfo::get();
        }
        if($role == 3){
            $user = Auth::user()->Id;
            $data = WarrantyClaimInfo::where('EngineerId', $user)->get();
        }
        return view('admin.dashboard', compact('data'));
    }

    public function create()
    {  
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
        
    }

}
