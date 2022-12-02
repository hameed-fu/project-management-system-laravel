<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User; 
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class UserController extends Controller
{

    public function dashboard()
    {
        return  view('backend.dashboard');
    }

    public function users()
    {
        // $users = User::orderBy('id','desc')->where('id','!=',auth()->user()->id)->get();
        $users = []; // User::orderBy('id','desc')->get();         
        return view('backend.users.index',compact('users'));
    }
     
    public function store(Request $request)
    {
        if(User::where('email',$request->email)->doesntExist()){

            $data = [
                'name' => $request->name,
                'state_id' => $request->state_id,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
                'role' => $request->role,
            ];
           
            $state = User::insert($data);
            return $state ? redirect()->back()->with("success","Record added successfully") : redirect()->back()->with("error","Somthing went wrong");
        }else{
            return redirect()->back()->with("error","User email has already taken");
        }
 
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with("success","Record deleted successfully");

    }
    public function edit($id)
    {
        $user = User::find($id);
        $packages = Package::get();

        return view('backend.admin.update_user', compact('user','packages'));
    }
    public function update(Request $request)
    {
        $data = [
            'name' => $request->name,
            'state_id' => $request->state_id,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'role' => $request->role,
        ];
        $state = User::where('id',$request->id)->update($data);
        return $state ? redirect()->back()->with("success","Record update successfully") : redirect()->back()->with("error","Somthing went wrong");
    }

    public function updateProfile(Request $request){
        $present = User::where('id',auth()->user()->id)->value('photo');
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = $request->image->move(public_path().'/uploads/profile' , $filename ) ;
            $file = $filename;
        }else{
            $file = $present;
        }
        
        User::where("id",auth()->user()->id)->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'photo'=> $file,
            ]);
        return back()->with('success' , 'Profile updated successfully');
    }
    public function passwordChanage(Request $request){
        
        $validator = \Validator::make($request->all(),[
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
            
        ]);
        
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
    
        return redirect()->back()->with('success' , 'Password changed successfully.');
    }

    public function change_status($id, $status)
    {
        $data = [
            'id'  => $id,
            'status'  => $status,
        ];
        User::where('id', $id)->update($data);
        return redirect()->back()->with("success","Status changed Successfully");
    }

    function logout(){
        Auth::logout();
        session()->flash('success', 'You are logged out');
        return redirect('/');
    }
}
