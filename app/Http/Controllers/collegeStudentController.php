<?php

namespace App\Http\Controllers;

use App\Jobdesc;
use App\User;
use App\InternshipStudent;
use App\GroupProject;
use App\GroupProjectExaminer;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class CollegeStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $job = Jobdesc::get()->sortByDesc('status');
        $anggota = GroupProject::with(['Agency', 'GroupProjectSchedule', 'InternshipStudents.Jobdescs', 'InternshipStudents.User', 'GroupProjectSupervisor.Lecturer'])
            ->find(Auth::user()->InternshipStudent->getGroupProjectId());
        if ($anggota !== null) {
            $fck = GroupProjectExaminer::with('Lecturer')->where('group_project_id', $anggota->id)->get();
            return view('college_student.home', compact(['job', 'anggota', 'fck']));
        }
        
        return view('college_student.home', compact(['job', 'anggota']));
    }

    public function progress()
    {
        return view('college_student.progress');
    }
    public function show($id)
    {
        $project = GroupProject::findOrFail($id);
        return response()->json(['data' => $project]);
    }

    public function update(Request $request, $id)
    {
        $project = GroupProject::findOrFail($id);
        $project->title = $request->input('editJudul');
        $project->field_supervisor = $request->input('editPemLapangan');

        if ($project->save()) {
            return response()->json("success");
        }
        return response()->json("failed");
    }
    public function upload(Request $request, $id)
    {
        $project = GroupProject::findOrFail($id);
        if ($request->hasFile('laporan')) {
            $fileLaporan = $request->file('laporan');
            $folderLaporan = 'berkas/laporan';
            $fileNameLaporan =  Carbon::now()->timestamp . '_' . uniqId() . '_' .$fileLaporan->getClientOriginalName();
            $fileLaporan->move($folderLaporan, $fileNameLaporan);
        }
        $project->laporan = $fileNameLaporan;

        if ($project->save()) {
            return response()->json("success");
        }
        return response()->json("failed");
    }
}
