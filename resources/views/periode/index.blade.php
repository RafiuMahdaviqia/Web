@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Daftar Periode Sertifikasi</h3>
            <div class="card-tools">
                <!-- Tombol Tambah Data (Ajax) -->
                <button onclick="modalAction('{{ url('/periode/create_ajax') }}')" class="btn btn-success">Tambah Periode (Ajax)</button>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_periode">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sertifikasi</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

<!-- Modal untuk Form -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div>

@endsection
@push('css')
<style>
    .card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .card-header {
        background: #007bff;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 15px;
    }

    .btn-success {
        border-radius: 20px;
        padding: 6px 12px;
        transition: background 0.3s ease;
    }

    #table_periode thead {
        background: #007bff;
        color: white;
    }

    #table_periode tbody tr {
        transition: background 0.3s;
    }

    #table_periode tbody tr:hover {
        background: #f5f5f5;
    }
</style>
@endpush
@push('js')
<script>
    var dataperiode;
    $(document).ready(function() {
        dataperiode = $('#table_periode').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('periode/list') }}",
                "dataType": "json",
                "type": "POST"
            },
            columns: [{
                data: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false
            }, {
                data: "sertifikasi.nama_sertifikasi",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "user.nama_user",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "status",
                className: "",
                orderable: true,
                searchable: true
            }, {
                data: "aksi",
                className: "",
                orderable: false,
                searchable: false
            }]
        });
    });

    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
</script>
@endpush