<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamUser;
use App\Models\Team;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $team = Team::create([
            'name' => $request->input('name')
        ]);

        $team->users()->attach(Auth::user(), ['primary' => 0, 'last_used' => 1]);

        session()->put('alias', $team->id);

        return response()->json(['status' => '1']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function aliasAs(Request $request){

        $team_user = TeamUser::whereUserId(Auth::user()->id)->whereTeamId($request->input('team_id'))->first();

        if(!$team_user){
            return response()->json(['status' => '0', 'message' => 'invalid team.'], 401);
        }else{
            session()->put('alias', $request->input('team_id'));
            session()->put('portal', null);
            return response()->json(['status' => '1', 'message' => 'Team switched.']);
        }
        
    }
}
