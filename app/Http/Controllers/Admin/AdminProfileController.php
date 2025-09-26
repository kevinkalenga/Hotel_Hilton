<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Hash;
use Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function profile_submit(Request $request)
    {
          
        // $admin_data = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $admin_data = Admin::find(Auth::guard('admin')->id());
        // dd($admin_data);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($request->hasFile('photo')) {
           $request->validate([
            'photo' => ['image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
           ]);

            // Supprime l'ancienne photo seulement si ce n'est pas une photo par défaut
            $defaultPhotos = ['user.jpg', 'admin.jpeg', 'default.png'];
            if ($admin_data->photo && !in_array($admin_data->photo, $defaultPhotos) && file_exists(public_path('uploads/' . $admin_data->photo))) {
                unlink(public_path('uploads/' . $admin_data->photo));
            }

             // Sauvegarde la nouvelle photo
             $final_name = 'admin_' . time() . '.' . $request->photo->extension();
             $request->photo->move(public_path('uploads'), $final_name);
             $admin_data->photo = $final_name;
        }
        
        
        if($request->password != ''){
             $request->validate([
              'password' => 'required',
              'retype_password' => 'required|same:password',
           ]);

           $admin_data->password = Hash::make($request->password);
        }

      

        $admin_data->name  = $request->name;
        $admin_data->email = $request->email;
        $admin_data->save();

        Auth::guard('admin')->setUser($admin_data->fresh());

        return redirect()->back()->with('success', 'Profile updated successfully.');

    }
}
