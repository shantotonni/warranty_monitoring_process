<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('region','role')->get();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $regions = Region::all();
        return view('admin.user.create', compact('roles', 'regions'));
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
            'UserId' => 'required | unique:UserManager',
            'Password' => 'required',
            'RoleId' => 'required',
            'Designation' => 'required',
            'Mobile' => 'required',
            'Email' => 'required'
        ]);

        $user = new User;
        $user->Name = $request->Name;
        $user->UserId = $request->UserId;
        $user->Password = Hash::make($request->Password);
        $user->RoleId = $request->RoleId;
        $user->Designation = $request->Designation;
        $user->Mobile = $request->Mobile;
        $user->Email = $request->Email;
        $user->RegionId = $request->RegionId;
        $user->Status = 'Y';
        $user->CreatedAt = Carbon::now();

        if ($request->hasFile('SignatureImage')) {
            $image       = $request->file('SignatureImage');
            $filename    = time().rand(1,100).".". $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path('/images/signature_images/' .$filename));
            $user->SignatureImage = $filename;
        }

        $user->save();

        return redirect(route('users.index'))->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $regions = Region::all();

        return view('admin.user.edit', compact('user', 'roles', 'regions'));
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
            'UserId' => "required | unique:UserManager,UserId,$id",
            'RoleId' => 'required',
            'Designation' => 'required',
            'Mobile' => 'required',
            'Email' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->Name = $request->Name;
        $user->UserId = $request->UserId;
        if ($request->Password != null) {
            $user->Password = Hash::make($request->Password);
        }
        $user->RoleId = $request->RoleId;
        $user->Designation = $request->Designation;
        $user->Mobile = $request->Mobile;
        $user->Email = $request->Email;
        $user->RegionId = $request->RegionId;
        $user->Status = 'Y';
        $user->UpdatedAt = Carbon::now();

        if ($request->hasFile('SignatureImage')) {
            $image       = $request->file('SignatureImage');
            $filename    = time().rand(1,100).".". $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path('/images/signature_images/' .$filename));
            $user->SignatureImage = $filename;
        }

        $user->save();

        return redirect(route('users.index'))->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('users.index'))->with('success', 'User deleted successfully');
    }

    public function changePasswordForm()
    {
        Session::forget('success', 'error');
        return view('admin.user.change_password');
    }

    public function changePassword(Request $request)
    {
        // dd($request->all());
        // Hash::make($request->Password)
        $this->validate($request, [
            'Password' => 'required',
            'NewPassword' => 'required',
            'ConfirmPassword' => 'required',
        ]);

        $currentPassword = Auth::user()->Password;
        if (Hash::check($request->Password, $currentPassword)) {
            if ($request->NewPassword == $request->ConfirmPassword) {
                $user = User::findOrFail(Auth::user()->Id);
                $user->Password = Hash::make($request->NewPassword);
                $user->save();

                Session::forget(['success', 'error']);
                Session::flash('success', 'Password Changed Successfully');
                return view('admin.user.change_password');
            }
            Session::forget(['success', 'error']);
            Session::flash('error', 'New Password & Confirm Password does not match!');
            return view('admin.user.change_password');
        }
        Session::forget(['success', 'error']);
        Session::flash('error', 'Wrong Password entry!');
        return view('admin.user.change_password');
    }
}
