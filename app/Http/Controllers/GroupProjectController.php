<?php

namespace App\Http\Controllers;

use App\GroupProject;
use App\Jobdesc;
use App\Agency;
use App\File;
use App\GroupProjectSchedule;
use Illuminate\Http\Request;
use App\InternshipStudentGroupProject;
use App\InternshipStudentJobdesc;
use App\InternshipStudent;
use Illuminate\Http\UploadedFile;
use Auth;
use Carbon\Carbon;
use App\Exports\GroupProjectExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class GroupProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $i = 1;

        foreach ($request->nim as $nim) {
            $request->validate(
                [
                    'nama-' . $i => 'required',
                    'ipk-' . $i => 'gt:2.49',
                    'sks-' . $i => 'gt:90',
                    'jobdesc_' . $i => 'required',
                    'khs_' . $i => 'required',
                    'transkrip_' . $i => 'required',
                    'krs_' . $i => 'required',
                    'instansi' => 'required',
                    'bidang' => 'required',
                    'alamat' => 'required',
                    'tlp' => 'required|numeric|gt:11',
                    'start' => 'required|date',
                    'end' => 'required|date|after:start',
                    'kak' => 'required'
                ],
                [
                    'required' => 'Harap di isi',
                    'numeric' => 'Hanya boleh di isi menggunakan angka',
                    'min' => 'Minimal :min karakter',
                    'nama-' . $i . '.required' => 'NIM tidak tersedia atau sedang cuti',
                    'ipk-' . $i . '.gt' => 'Minimal 2.5',
                    'sks-' . $i . '.gt' => 'Minimal 90',
                ]
            );
        }
        
        $student = new InternshipStudent();
        $agency = Agency::create([
            'agency_name' => $request->instansi,
            'sector' =>  $request->bidang,
            'address' => $request->alamat,
            'phone_number' => $request->tlp
        ]);
        
        if ($request->hasFile('kak')) {
            $filekak = $request->file('kak');
            $folderkak = 'berkas/kak';
            $fileNamekak =  Carbon::now()->timestamp . '_' . uniqId() . '_kak';
            $filekak->move($folderkak, $fileNamekak);
        }

        $groupProject = new GroupProject;
            $groupProject->start_intern = $request->input('start');
            $groupProject->end_intern = $request->input('end');
            $groupProject->agency_id = $agency->id;
            $groupProject->kak = $fileNamekak;

            $groupProject->save();

        foreach ($request->nim as $nim) {

            $groupProject->InternshipStudents()->attach(InternshipStudent::where('nim', $nim)->first()->id);
            $student = InternshipStudent::where('nim', $nim)->first();
                foreach ($request->input('jobdesc_' . $i) as $jobdesc) {
                    $student->Jobdescs()->attach($jobdesc);
                }

            if ($request->hasFile('transkrip_' . $i)) {
                $fileTranskrip = $request->file('transkrip_' . $i);
                $folderTranskrip = 'berkas/transkrip';
                $fileNameTranskrip =  Carbon::now()->timestamp . '_' . uniqId() . '_transkrip';
                $fileTranskrip->move($folderTranskrip, $fileNameTranskrip);
            }
            if ($request->hasFile('krs_' . $i)) {
                $fileKrs = $request->file('krs_' . $i);
                $folderKrs = 'berkas/krs';
                $fileNameKrs =  Carbon::now()->timestamp . '_' . uniqId() . '_krs';
                $fileKrs->move($folderKrs, $fileNameKrs);
            }
            if ($request->hasFile('khs_' . $i)) {
                $fileKhs = $request->file('khs_' . $i);
                $folderKhs = 'berkas/khs';
                $fileNameKhs =  Carbon::now()->timestamp . '_' . uniqId() . '_khs';
                $fileKhs->move($folderKhs, $fileNameKhs);
            }

            $berkas = new File;
            $berkas->internship_student_id = $student->id;
            $berkas->transcript = $fileNameTranskrip;
            $berkas->krs = $fileNameKrs;
            $berkas->khs = $fileNameKhs;
            $berkas->save();

            $i++;
        };
        return redirect()->route('mahasiswa.home')->with('status', 'Berhasil Mendaftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $student = InternshipStudent::whereNim($request->nim)->whereStatus($request->status)->first();

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function getVerif($id)
    {
        $groupProject = GroupProject::with('InternshipStudents.User')->find(Auth::user()->InternshipStudent->getGroupProjectId());
        return response()->json(['data' => $groupProject]);
    }

    public function accSeminar(Request $request, $id)
    {
        $i=1;
        $verif = GroupProject::with('InternshipStudentGroupProject')->find($id);
        // dd($verif);
        if ($request->hasFile('bimbinganPK')) {
            $fileBimbingPK = $request->file('bimbinganPK');
            $folderBimbingPK = 'berkas/bimbinganPK';
            $fileNameBimbingPK =  Carbon::now()->timestamp . '_' . uniqId() . '_bimbinganPK';
            $fileBimbingPK->move($folderBimbingPK, $fileNameBimbingPK);
        }
        if ($request->hasFile('setuju')) {
            $fileSetuju = $request->file('setuju');
            $folderSetuju = 'berkas/persetujuan';
            $fileNameSetuju =  Carbon::now()->timestamp . '_' . uniqId() . '_persetujuan';
            $fileSetuju->move($folderSetuju, $fileNameSetuju);
        }
        $verif->bimbingan_pk = $fileNameBimbingPK;
        $verif->persetujuan = $fileNameSetuju;
        
            
        foreach ($verif->InternshipStudentGroupProject as $udin) {
                // dd($udin);
                // $groupProject->InternshipStudents()->attach(InternshipStudent::where('nim', $nim)->first()->id);
                // if ($request->hasFile('krs_'.$i)) {
                //     $fileKRS = $request->file('krs_'.$i);
                //     $folderKRS = 'berkas/krs';
                //     $fileNameKRS = Carbon::now()->timestamp . '_' . uniqId() . '_krs';
                //     $fileKRS->move($folderKRS, $fileNameKRS);
                // }
                if ($request->hasFile('nilaiPKL_'.$i)) {
                    $fileNilai = $request->file('nilaiPKL_'.$i);
                    $folderNilai = 'berkas/nilaiPKL';
                    $fileNameNilai = Carbon::now()->timestamp . '_' . uniqId() . '_nilaiPKL';
                    $fileNilai->move($folderNilai, $fileNameNilai);
                }
                if ($request->hasFile('sertifikat_'.$i)) {
                    $fileSertifikat = $request->file('sertifikat_'.$i);
                    $folderSertifikat = 'berkas/sertifikat';
                    $fileNameSertifikat = Carbon::now()->timestamp . '_' . uniqId() . '_sertifikat';
                    $fileSertifikat->move($folderSertifikat, $fileNameSertifikat);
                }
                if ($request->hasFile('bimbingPKL_'.$i)) {
                    $fileBimbing = $request->file('bimbingPKL_'.$i);
                    $folderBimbing = 'berkas/bimbingPKL';
                    $fileNameBimbing = Carbon::now()->timestamp . '_' . uniqId() . '_bimbinganPKL';
                    $fileBimbing->move($folderBimbing, $fileNameBimbing);
                }
                if ($request->hasFile('sertifikatLkmm_'.$i)) {
                    $fileSertifikatLKMM = $request->file('sertifikatLkmm_'.$i);
                    $folderSertifikatLKMM = 'berkas/LKMM';
                    $fileNameSertifikatLKMM = Carbon::now()->timestamp . '_' . uniqId() . '_sertifikatLKMM';
                    $fileSertifikatLKMM->move($folderSertifikatLKMM, $fileNameSertifikatLKMM);
                }
                $berkas = File::where('internship_student_id', $udin->internship_student_id)->first();
                // $berkas->krs = $fileNameKRS;
                $berkas->penilaian_pkl = $fileNameNilai;
                $berkas->bimbingan_pkl = $fileNameBimbing;
                $berkas->sertifikat = $fileNameSertifikat;
                $berkas->sertifikat_lkmm = $fileNameSertifikatLKMM;
                $berkas->save();
            
                $i++;
        }
        $verif->is_verified = $request->is_verified + '1';

        if ($verif->save()) {
            return response()->json("success");
        }
        return response()->json("failed");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new GroupProjectExport, 'DataPKMerge.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupProject  $groupProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupProject $groupProject)
    {
        //
    }
}
