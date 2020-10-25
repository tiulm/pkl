@extends('layout.master')

@section('title', 'Koordinator | Seminar')
@section('content')
<section class="content">
    <div class="container-fluid">
        @if($seminar !== 0)
        <h5 class="py-2">Pendaftaran Seminar</h5>
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-plus mr-1"></i>
                    Verifikasi Pendaftaran
                </h3>
            </div>
            <div class="card-body table-responsive">
                <table id="reg_sem" class="table table-striped projects dataTable w-100">
                    <thead>
                        <tr>
                            <th width="500px">Judul</th>
                            <th>Kelompok</th>
                            <th>Pembimbing</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <h5 class="py-2">Seminar</h5>
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Jadwal Seminar
                </h5>
            </div>
            <div class="card-body table-responsive">
                <table id="seminar" class="table table-striped projects dataTable w-100">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th width="500px">Judul</th>
                            <th>Kelompok</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Detail Modal -->
<div class="modal fade" id="detail" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-1"></i>
                    Detail
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-2" id="tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="group-tab" data-toggle="pill" href="#group" role="tab" aria-controls="group" aria-selected="true">Kelompok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="team-tab" data-toggle="pill" href="#team" role="tab" aria-controls="team" aria-selected="true">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="instansi-tab" data-toggle="pill" href="#instansi" role="tab" aria-controls="instansi" aria-selected="false">Instansi/Perusahaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="seminar-tab" data-toggle="pill" href="#detailsm" role="tab" aria-controls="seminar" aria-selected="false">Penguji</a>
                    </li>
                </ul>           
                <form id="form_detail">
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="group-tab">
                        <table class="table" id="files">
                            <thead>
                                <tr>
                                    <th>Berkas Proyek Kelompok</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab">
                        <table class="table table-responsive" id="mahasiswa">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Job Description</th>
                                    <th>Kelengkapan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="instansi" role="tabpanel" aria-labelledby="instansi-tab">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="instansi">Nama Instansi/Perusahaan</label>
                                <input type="text" class="form-control" id="agency" value="" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="instansi">Pembimbing Lapangan</label>
                                <input type="text" class="form-control" id="pemLapangan" value="" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="bidang">Bidang/Sektor Usaha</label>
                                <input type="text" class="form-control" id="bidang" value="" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" value="" readonly>
                            </div>
                            <div class="form-group col-12">
                                <label for="tlp">No. Telephon/Handphone</label>
                                <input type="text" class="form-control" id="tlp" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="start">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="start" value="" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="end">Tanggal Berakhir</label>
                                <input type="date" class="form-control" id="end" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detailsm" role="tabpanel" aria-labelledby="seminar-tab">
                        <div class="form-group">
                            <label>Ketua Penguji</label>
                            <input type="text" class="form-control" id="ketuapem" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Sekretaris</label>
                            <input type="text" class="form-control" id="pem1" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Penguji I</label>
                            <input type="text" class="form-control" id="pem2" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label>Penguji II</label>
                            <input type="text" class="form-control" id="pem3" value="" disabled>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>=
    </div>
</div>
<!-- Terima Modal -->
<div class="modal fade" id="accept" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Seminar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="verifSeminar" method="POST">
                    @csrf
                    <input type="hidden" name="groupProject" id="groupProject_id" value="">
                    <input type="hidden" id="_method" value="PUT" name="_method">
                    <input type="hidden" name="is_verified" id="is_verified" value="">
                    <div class="form-group">
                        <label>Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input name="tanggal" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <div class="input-group">
                            <input name="waktuMulai" type="time" class="form-control">
                            <input name="waktuSelesai" type="time" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ketua Penguji</label>
                        <input type="text" class="form-control" id="examiner_1" value="" disabled>
                        <input type="hidden" class="form-control" id="examiner_1_id" name="examiner_1[lecturer_id]" value="">
                        <input type="hidden" id="examiner_role_1" name="examiner_1[role]" value="Ketua Penguji">
                    </div>
                    <div class="form-group">
                        <label>Sekretaris</label>
                        <select id="examiner_2" name="examiner_2[lecturer_id]" class="form-control">
                            @foreach($examiner as $lecturer)
                            <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="examiner_role_2" name="examiner_2[role]" value="Sekretaris">
                    </div>
                    <div class="form-group">
                        <label>Penguji I</label>
                        <select id="examiner_3" name="examiner_3[lecturer_id]" class="form-control">
                            @foreach($examiner as $lecturer)
                            <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="examiner_role_3" name="examiner_3[role]" value="Penguji 1">
                    </div>
                    <div class="form-group">
                        <label>Penguji II</label>
                        <select id="examiner_4" name="examiner_4[lecturer_id]" class="form-control">
                            @foreach($examiner as $lecturer)
                            <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="examiner_role_4" name="examiner_4[role]" value="Penguji 2">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success float-right">Terima</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- College-Student Cancel Modal-->
<div class="modal fade" id="reject" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check mr-1"></i>
                    Konfirmasi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menolak pendaftaran seminar Proyek Kelompok #Nama-Mahasiswa?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light float-right">Yakin</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="seminar-edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit mr-1"></i>
                    Edit Jadwal Seminar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editVerifSeminar" method="POST">
                    @csrf
                    <input type="hidden" name="groupProject" id="group_id" value="">
                    <input type="hidden" id="_method" value="PUT" name="_method">
                    <div class="form-group">
                        <label>Tempat</label>
                        <input id="editTempat" name="editTempat" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input id="editTanggal" name="editTanggal" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <div class="input-group">
                            <input id="editStart" name="editStart" type="time" class="form-control">
                            <input id="editEnd" name="editEnd" type="time" class="form-control">
                        </div>
                    </div>
                <div class="form-group">
                    <label>Ketua Penguji</label>
                    <input type="text" class="form-control" id="editExaminer_1" value="" disabled>
                    <input type="hidden" class="form-control" id="editExaminer_1_id" value="" disabled>
                </div>
                <div class="form-group">
                    <label>Sekretaris</label>
                    <select id="editExaminer_2" name="editExaminerId_2" class="form-control">
                        @foreach($examiner as $lecturer)
                        <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Penguji I</label>
                    <select id="editExaminer_3" name="editExaminerId_3" class="form-control">
                        @foreach($examiner as $lecturer)
                        <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Penguji II</label>
                    <select id="editExaminer_4" name="editExaminerId_4" class="form-control">
                        @foreach($examiner as $lecturer)
                        <option value="{{$lecturer->id}}"> {{$lecturer->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- College-Student Finish Modal-->
<div class="modal fade" id="seminar-finish" aria-hidden="true">
    <form id="is-done">
    @csrf
    <input type="hidden" name="groupProject" id="gp_id" value="">
    <input type="hidden" id="_method" value="PUT" name="_method">
    <input type="hidden" name="is_verified" id="is_done" value="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-check mr-1"></i>
                    Konfirmasi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Seminar Proyek Kelompok telah selesai?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success float-right">Selesai</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </form>
</div>

<div class="modal fade" id="modalSuccess">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Success</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Data berhasil disimpan</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFailed">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Failed</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Data gagal disimpan</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('ajax')
<script>
    $("#reg_sem").DataTable({
        "processing": true,
        "ajax": {
            url: "{{ url('../koor/daftarSeminar/show') }}"
        },
        "columns": [{
                data: "title"
            },
            {
                sortable: false,
                "render": function(data, type, full, meta) {
                    let img = ''
                    for (let i = 0; i < full.internship_students.length; i++) {
                        img += '<a href=../public/image/' + full.internship_students[i].user.image_profile + ' target="_blank"><img src="../public/image/' + full.internship_students[i].user.image_profile + '" data-toggle="tooltip" data-placement="bottom" class="table-avatar m-1" title="' + full.internship_students[i].name + '"></a>'
                    }
                    return img
                }
            },
            {
                data: "group_project_supervisor.lecturer.name"
            },
            {
                sortable: false,
                "render": function(data, type, full, meta) {
                    let buttonId = full.id;
                    return '<button id="' + buttonId + '" class="btn btn-primary detail">Detail</button>' +
                        '<button id="' + buttonId + '" class="btn btn-success terima ml-1 mr-1">Terima</button>' +
                        '<button id="' + buttonId + '" class="btn btn-danger tolak">Tolak</button>'
                }
            }
        ]
    });
    $('#reg_sem tbody').on('click', '.detail', function() {
        let id = $(this).attr('id')

        $.ajax({
            url: "../koor/detailDaftarSem/" + id,
            success: function(result) {
                $('#detail').modal('show')
                $('#mahasiswa tbody').html('')
                $('#files tbody').html('')
                $('#form_detail')[0].reset();
                $('#agency').val(result.data.agency.agency_name)
                $('#pemLapangan').val(result.data.field_supervisor)
                $('#bidang').val(result.data.agency.sector)
                $('#alamat').val(result.data.agency.address)
                $('#tlp').val(result.data.agency.phone_number)
                $('#start').val(result.data.start_intern)
                $('#end').val(result.data.end_intern)

                let modal = ''
                let job = ''

                file = '<tr><td>Kerangka Acuan Kerja</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/kak/' + result.data.kak + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'+
                        '<tr><td>Lembar Bimbingan Proyek Kelompok</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/bimbinganPK/' + result.data.bimbingan_pk + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'+
                        '<tr><td>Lembar Persetujuan Seminar PKL dan PK</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/persetujuan/' + result.data.persetujuan + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'
                    $('#files tbody').append(file);

                result.data.internship_students.forEach(function(i) {
                    let call_job = ''
                    i.jobdescs.forEach(function(job) {
                        call_job += job.jobname + '<br>'
                    })
                    modal = '<tr><td>' + i.nim + '</td>' +
                        '<td>' + i.name + '</td>' +

                        '<td>' + call_job + '</td>' +
                        '<td><a href="../berkas/krs/' + i.file.krs + '" target="blank">Kartu Rencana Studi</a><br>' +
                        '<a href="../berkas/nilaiPKL/' + i.file.penilaian_pkl + '" target="blank">Lembar Penilaian PKL</a><br>' +
                        '<a href="../berkas/bimbingPKL/' + i.file.bimbingan_pkl + '" target="blank">Lembar Bimbingan PKL</a><br>' +
                        '<a href="../berkas/sertifikat/' + i.file.sertifikat + '" target="blank">Sertifikat Kehadiran Seminar PKL & PK</a><br>'+
                        '<a href="../berkas/LKMM/' + i.file.sertifikat_lkmm + '" target="blank">Sertifikat LKMM</a></td></tr>'

                    $('#mahasiswa tbody').append(modal)
                });

            }
        })
    });
    $('#reg_sem tbody').on('click', '.terima', function() {
        let id = $(this).attr('id')
        $('#accept').modal('show');

        $.ajax({
            url: "../koor/terimaSeminar/" + id,
            success: function(result) {
                $('#is_verified').val(result.data.is_verified)
                $('#groupProject_id').val(result.data.id)
                $('#examiner_1').val(result.data.group_project_supervisor.lecturer.name)
                $('#examiner_1_id').val(result.data.group_project_supervisor.lecturer_id)
            }
        })
    });
    $('#reg_sem tbody').on('click', '.tolak', function() {
        let id = $(this).attr('id');
        var token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Yakin ingin menolak pendaftaran seminar Proyek Kelompok?',
            text: "Data ini akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: 'Loading',
                    timer: 60000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    url: "tolakSeminar/" + id,
                    method: "POST",
                    data: {
                        _method: "DELETE",
                        "_token": token,
                    },
                    success: function() {
                        Swal.fire(
                                'Deleted!',
                                'Telah Dihapus',
                                'Success'
                            )
                            .then(function() {
                                $('#reg_sem').DataTable().ajax.reload();
                                $('#seminar').DataTable().ajax.reload();
                            })
                    }
                })
            }
        })
    });
    $('#verifSeminar').submit(function(e) {
        e.preventDefault();

        var request = new FormData(this);

        const id = $('#groupProject_id').val();
        $.ajax({
            url: "verifSeminar/" + id + "/edit",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $('#modalSuccess').modal();
                    $('#verifSeminar')[0].reset();
                    $('#accept').modal('hide');
                    $('#reg_sem').DataTable().ajax.reload();
                    $('#seminar').DataTable().ajax.reload();

                } else {
                    $('#modalFailed').modal();
                }
            },
            error: function(data) {
                $("small").remove(".text-danger");
                $("input").removeClass("is-invalid");
                $.each(data.responseJSON.errors, function(key, value) {
                    $('#' + key + '').addClass('is-invalid');
                    $('#' + key + '').after('<small class="text-danger">' + value + '</small>')
                });
            }
        })
    })
    $("#seminar").DataTable({
        "processing": true,
        "ajax": {
            url: "{{ url('../koor/seminar/show') }}"
        },
        "columns": [{
                sortable: false,
                "render": function(data, type, full, meta) {
                    return '<b>' + full.group_project_schedule.tanggal + '</b><br><small>' + full.group_project_schedule.place + '<br>' +
                        moment(full.group_project_schedule.time, 'HH:mm:ss').format('HH:mm') + '-' + moment(full.group_project_schedule.time_end, 'HH:mm:ss').format('HH:mm') + ' WITA</small>'
                }
            },
            {
                data: "title"
            },
            {
                sortable: false,
                "render": function(data, type, full, meta) {
                    let img = ''
                    for (let i = 0; i < full.internship_students.length; i++) {
                        img += '<a href=../public/image/' + full.internship_students[i].user.image_profile + ' target="_blank"><img src="../public/image/' + full.internship_students[i].user.image_profile + '" data-toggle="tooltip" data-placement="bottom" class="table-avatar m-1" title="' + full.internship_students[i].name + '"></a>'
                    }
                    return img
                }
            },
            {
                sortable: false,
                "render": function(data, type, full, meta) {
                    let buttonId = full.id;
                    return '<button id="' + buttonId + '" class="btn btn-primary detail">Detail</button>' +
                        '<button id="' + buttonId + '" class="btn btn-warning edit mx-1">Edit</button>' +
                        '<button id="' + buttonId + '" class="btn btn-success selesai">Selesai</button>'
                }
            }
        ]
    });
    $('#seminar tbody').on('click', '.detail', function() {
        let id = $(this).attr('id')
        $('#detail').modal('show');

        $.ajax({
            url: "../koor/detailDaftarSem/" + id,
            success: function(result) {
                $('#mahasiswa tbody').html('')
                $('#files tbody').html('')
                $('#agency').val(result.data.agency.agency_name)
                $('#pemLapangan').val(result.data.field_supervisor)
                $('#bidang').val(result.data.agency.sector)
                $('#alamat').val(result.data.agency.address)
                $('#tlp').val(result.data.agency.phone_number)
                $('#start').val(result.data.start_intern)
                $('#end').val(result.data.end_intern)
                $('#pem3').val(result.supervisor.lecturer.name) 
                result.fck.forEach(function(mmk) {
                    let role = mmk.role;
                    if (role === "Ketua Penguji") {
                        $('#ketuapem').val(mmk.lecturer.name);
                    } else if (role === "Sekretaris") {
                        $('#pem1').val(mmk.lecturer.name);
                    } else if (role === "Penguji 1") {
                        $('#pem2').val(mmk.lecturer.name);
                    } else if (role === "Penguji 2") {
                        $('#pem3').val(mmk.lecturer.name);
                    }
                });
                let modal = ''
                let job = ''

                file = '<tr><td>Kerangka Acuan Kerja</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/kak/' + result.data.kak + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'+
                        '<tr><td>Lembar Bimbingan Proyek Kelompok</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/bimbinganPK/' + result.data.bimbingan_pk + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'+
                        '<tr><td>Lembar Persetujuan Seminar PKL dan PK</td>' +
                        '<td class="text-right py-0 align-middle">' +
                        '<a href="../berkas/persetujuan/' + result.data.persetujuan + '" target="blank" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a></td></tr>'
                    $('#files tbody').append(file);

                result.data.internship_students.forEach(function(i) {
                    let call_job = ''
                    i.jobdescs.forEach(function(job) {
                        call_job += job.jobname + '<br>'
                    })
                    modal = '<tr><td>' + i.nim + '</td>' +
                        '<td>' + i.name + '</td>' +

                        '<td>' + call_job + '</td>' +
                        '<td><a href="../berkas/krs/' + i.file.krs + '" target="blank">Kartu Rencana Studi</a><br>' +
                        '<a href="../berkas/nilaiPKL/' + i.file.penilaian_pkl + '" target="blank">Lembar Penilaian PKL</a><br>' +
                        '<a href="../berkas/bimbingPKL/' + i.file.bimbingan_pkl + '" target="blank">Lembar Bimbingan PKL</a><br>' +
                        '<a href="../berkas/sertifikat/' + i.file.sertifikat + '" target="blank">Sertifikat Kehadiran Seminar PKL & PK</a><br>'+
                        '<a href="../berkas/LKMM/' + i.file.sertifikat_lkmm + '" target="blank">Sertifikat LKMM</a></td></tr>'

                    $('#mahasiswa tbody').append(modal)
                });
            }
        })
    });
    $('#seminar tbody').on('click', '.edit', function() {
        let id = $(this).attr('id');

        $.ajax({
            url: "getSeminar/" + id,
            dataType: "json",
            success: function(result) {
                $('#seminar-edit').modal('show');
                $('#group_id').val(result.data.id)
                $('#editTempat').val(result.data.group_project_schedule.place)
                $('#editTanggal').val(result.data.group_project_schedule.date)
                $('#editStart').val(result.data.group_project_schedule.time)
                $('#editEnd').val(result.data.group_project_schedule.time_end)
                result.examiner.forEach(function(examiner) {
                    let role = examiner.role;
                    if (role === "Sekretaris") {
                        $('#editExaminer_2').val(examiner.lecturer.id);
                    } else if (role === "Penguji 1") {
                        $('#editExaminer_3').val(examiner.lecturer.id);
                    } else if (role === "Penguji 2") {
                        $('#editExaminer_4').val(examiner.lecturer.id);
                    }
                })
                $('#editExaminer_1').val(result.data.group_project_supervisor.lecturer.name)
                $('#editExaminer_1_id').val(result.data.group_project_supervisor.lecturer_id)
            }
        })
    });
    $('#seminar tbody').on('click', '.selesai', function() {
        let id = $(this).attr('id')
        $('#seminar-finish').modal('show');

        $.ajax({
            url: "../koor/terimaSeminar/" + id,
            success: function(result) {
                $('#is_done').val(result.data.is_verified)
                $('#gp_id').val(result.data.id)
            }
        })
    });
    $('#is-done').submit(function(e) {
        e.preventDefault();

        var request = new FormData(this);

        const id = $('#gp_id').val();
        $.ajax({
            url: "isDone/" + id + "/edit",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $('#modalSuccess').modal();
                    $('#is-done')[0].reset();
                    $('#seminar-finish').modal('hide');
                    $('#reg_sem').DataTable().ajax.reload();
                    $('#seminar').DataTable().ajax.reload();

                } else {
                    $('#modalFailed').modal();
                }
            },
            error: function(data) {
                $("small").remove(".text-danger");
                $("input").removeClass("is-invalid");
                $.each(data.responseJSON.errors, function(key, value) {
                    $('#' + key + '').addClass('is-invalid');
                    $('#' + key + '').after('<small class="text-danger">' + value + '</small>')
                });
            }
        })
    })
    $('#editVerifSeminar').submit(function(e) {
        e.preventDefault();

        var request = new FormData(this);

        const id = $('#group_id').val();
        $.ajax({
            url: "updateSeminar/" + id + "/edit",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $('#modalSuccess').modal();
                    $('#editVerifSeminar')[0].reset();
                    $('#seminar-edit').modal('hide');
                    $('#seminar').DataTable().ajax.reload();

                } else {
                    $('#modalFailed').modal();
                }
            },
            error: function(data) {
                $("small").remove(".text-danger");
                $("input").removeClass("is-invalid");
                $.each(data.responseJSON.errors, function(key, value) {
                    $('#' + key + '').addClass('is-invalid');
                    $('#' + key + '').after('<small class="text-danger">' + value + '</small>')
                });
            }
        })
    })
</script>
@endsection