<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\Project;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::orderBy('id','desc')->get();
        $members = TeamMember::orderBy('id','desc')->get();
        return view('backend.projects.index', compact('projects','members'));
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
    
         
        $state = Project::insert([
            'name'   => $request->name,
            'owner_name'  => $request->owner_name,
            'description'  => $request->description,
            'functional_requirements'  => $request->functional_requirements,
            'non_functional_requirements'  => $request->non_functional_requirements,
            'member_id'  => implode(",",$request->member_id),
        ]);
        $project_id = DB::getPdo()->lastInsertId();
        if($project_id){
            foreach($request->risk as $key => $risk){
                Risk::insert([
                    'name'          => $risk,
                    'project_id'    => $project_id,
                ]);
            }
        }
        return $state ?  redirect()->route('projects')->with('success','Record added successfully') : redirect()->route('projects')->with('error','Something went wrong'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $state = Project::where('id',$request->id)->update([
            'name'   => $request->name,
            'owner_name'  => $request->owner_name,
            'description'  => $request->description,
            'functional_requirements'  => $request->functional_requirements,
            'non_functional_requirements'  => $request->non_functional_requirements,
            'member_id'  => implode(",",$request->member_id),
        ]);
        return $state ?  redirect()->route('projects')->with('success','Record updated successfully') : redirect()->route('projects')->with('error','Something went wrong'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = Project::find($id)->delete();
        return $state ?  redirect()->route('projects')->with('success','Record deleted successfully') : redirect()->route('projects')->with('error','Something went wrong');
   
    }
    public function get_risks()
    {
        return Risk::where('project_id',request()->project_id)->get();
    }

    public function add_spent_hours(Request $request)
    {
        $state = DB::table('hours_spents')->insert([
            "analysis" => $request->analysis,
            "designing" => $request->designing,
            "coding" => $request->coding,
            "testing" => $request->testing,
            "project_management" => $request->project_management,
            "project_id" => $request->project_id,
            "created_at"    => now()
        ]);
        return $state ?  redirect()->route('project.spent_hours')->with('success','Record updated successfully') : redirect()->route('project.spent_hours')->with('error','Something went wrong'); 
    }
    public function update_spent_hours(Request $request)
    {
        $state = DB::table('hours_spents')->where('id',$request->id)->update([
            "analysis" => $request->analysis,
            "designing" => $request->designing,
            "coding" => $request->coding,
            "testing" => $request->testing,
            "project_management" => $request->project_management,
            "project_id" => $request->project_id,
            "created_at"    => now()
        ]);
        return $state ?  redirect()->route('project.spent_hours')->with('success','Record updated successfully') : redirect()->route('project.spent_hours')->with('error','Something went wrong'); 
    }
    public function spent_hours()
    {
        $projects = Project::orderBy('id','desc')->get();
        $spent_hours = DB::table('hours_spents')->orderBy('created_at','desc')->get();
        $spent_hours = $spent_hours->groupBy(function ($item) {
            return  $item->project_id ;
        });
        return view('backend.projects.spent_hours',compact('spent_hours','projects'));
    }

    public function delete_hours($id)
    {
        $state = DB::table('hours_spents')->where('id',$id)->delete();
        return $state ?  redirect()->route('project.spent_hours')->with('success','Record deleted successfully') : redirect()->route('project.spent_hours')->with('error','Something went wrong');
   
    }
}
