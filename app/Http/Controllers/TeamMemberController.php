<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = TeamMember::orderBy('id','desc')->get();
        return view('backend.members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $photo_file = $photo->getClientOriginalName();
            $photo = $request->photo->move(public_path().'/uploads/members' , $photo_file ) ;
        }else{
            $photo_file = null;
        }
        $state = TeamMember::insert([
            'name'  => $request->name,
            'designation'  => $request->designation,
            'photo'  => $photo_file,
        ]);
        return $state ?  redirect()->route('team_member')->with('success','Record added successfully') : redirect()->route('team_member')->with('error','Something went wrong'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamMember $teamMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $present = TeamMember::where('id',$request->id)->first();
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $photo_file = $photo->getClientOriginalName();
            $photo = $request->photo->move(public_path().'/uploads/members' , $photo_file ) ;
        }else{
            $photo_file = $present->photo;
        }
        $state = TeamMember::where('id',$request->id)->update([
            'name'  => $request->name,
            'designation'  => $request->designation,
            'photo'  => $photo_file,
        ]);
        return $state ?  redirect()->route('team_member')->with('success','Record updated successfully') : redirect()->route('team_member')->with('error','Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = TeamMember::find($id)->delete();
        return $state ?  redirect()->route('team_member')->with('success','Record deleted successfully') : redirect()->route('team_member')->with('error','Something went wrong');
    }
}
