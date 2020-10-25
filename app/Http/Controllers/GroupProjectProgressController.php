<?php

namespace App\Http\Controllers;

use App\GroupProjectProgress;
use Illuminate\Http\Request;
use App\InternshipStudent;
use App\GroupProject;
use App\Agency;
use App\Lecturer;
use App\GroupProjectSupervisor;

class GroupProjectProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verified = GroupProject::all();
        return view('coordinator.progress');
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
    public function update(Request $request, $id)
    {
        
        $request->validate(
            [
                'updateProgress' => 'numeric|min:0|max:100',
                
            ],
            [
                'max' => 'Tidak boleh lebih dari :max',
                'min' => 'Jumlah karakter = :min',
                'numeric' => 'Hanya boleh di isi menggunakan angka',
            ]
        );
        
        $progress = GroupProject::findOrFail($id);
        $progress->progress = $request->input('updateProgress');

        if ($progress->save()) {
            return response()->json("success");
        }
        return response()->json("failed");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupProjectProgress  $groupProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $verified = GroupProject::with(['Agency', 'GroupProjectSupervisor' => function($ccd){
            $ccd->with('Lecturer');
        }, 'InternshipStudents' => function($abc) {
            $abc->with('User');
        }])->where('is_verified', '1')->get();
        return response()->json(['data' => $verified]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupProjectProgress  $groupProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupProjectProgress $groupProjectProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupProjectProgress  $groupProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function tampil($id)
    {
        $verified = GroupProject::findOrFail($id);
        return response()->json(['data' => $verified]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupProjectProgress  $groupProjectProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupProjectProgress $groupProjectProgress)
    {
        //
    }
}
