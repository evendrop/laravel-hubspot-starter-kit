<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portal;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portals = Portal::whereTeamId(session('alias'))->get([
            'id', 'created_at', 'hub__domain', 'hub__id', 'hub__user_email'
        ]);

        return response()->json(['portals' => $portals, 'active_portal' => session('portal')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return redirect()->route('/hs-auth');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function aliasAs(Request $request) {

        $portal = Portal::whereTeamId(session('alias'))->whereId($request->input('id'))->first();

        if(!$portal){
            return response()->json(['status' => '0', 'message' => 'invalid portal.'], 401);
        }else{
            session()->put('portal', $portal);
            return response()->json(['status' => '1', 'message' => 'Portal switched.']);
        }

    }
}
