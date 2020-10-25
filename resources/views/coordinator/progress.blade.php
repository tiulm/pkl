@extends('layout.master')

@section('title', 'Koordinator | Bimbingan')
@section('content')
<section class="content">
    <div class="container-fluid">
        <h5 class="py-2">Bimbingan PKL dan PK</h5>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-spinner mr-1"></i>
                    Progress Mahasiswa
                </h3>
            </div>
            <div class="card-body table-responsive">
                <table id="progress-detail" class="table table-striped projects dataTable w-100">
                    <thead>
                        <tr>
                            <th width="25%">Kelompok</th>
                            <th width="25%">Pembimbing</th>
                            <th width="25%">Progress</th>
                            <th width="25%"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade bimbingan" id="project-progress" aria-hidden="true">
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
            <form id="formUpdate" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Tambahkan Progress</label>
                        <input type="hidden" id="groupProjectId" value="">
                        <input type="hidden" id="_method" value="PUT" name="_method">
                        <input type="number" id="updateProgress" min="0" max="100" name="updateProgress" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
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
    $("#progress-detail").DataTable({
        "processing": true,
        "order": [[ 2, "desc" ]],
        "ajax": {
            url: "{{ url('../koor/bimbingan/show') }}"
        },
        "columns": [{
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
                    if(full.progress == 100){
                        return '<span class="badge badge-success p-2">Siap Seminar</span>'
                    }
                    else {
                        return '<div class="progress progress-sm">' +
                            '<div class="progress-bar bg-success" role="progressbar" aria-volumenow="' + full.progress + '" aria-volumemin="0" aria-volumemax="100" style="width:' + full.progress + '%">' +
                            '</div>' +
                            '</div>' +
                            '<small>' + full.progress + '% Complete</small>'
                    }
                }
            },
            {
                sortable: false,
                "render": function(data, type, full, meta) {
                    let buttonId = full.id;
                    return '<button id="' + buttonId + '" class="btn btn-sm btn-info bimbingan">Update Progress</button>'
                }
            }
        ]
    });

    $('#progress-detail tbody').on('click', '.bimbingan', function() {
        let id = $(this).attr('id');

        $.ajax({
            url: "bimbingan/" + id,
            dataType: "json",
            success: function(result) {
                $('#project-progress').modal('show');
                $('#updateProgress').val(result.data.progress);
                $('#groupProjectId').val(result.data.id);
            }
        })
    });
    $('#formUpdate').submit(function(e) {
        e.preventDefault();

        var request = new FormData(this);

        const id = $('#groupProjectId').val();
        $.ajax({
            url: "bimbingan/" + id + "/update",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == "success") {
                    $('#modalSuccess').modal();
                    $('#formUpdate')[0].reset();
                    $('#project-progress').modal('hide');
                    $('#progress-detail').DataTable().ajax.reload();

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
    });
</script>
@endsection