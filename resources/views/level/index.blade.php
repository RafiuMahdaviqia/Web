@extends('layouts.template') 
 
@section('content') 
  <div class="card card-outline card-primary"> 
      <div class="card-header"> 
        <h3 class="card-title">{{ $page->title }}</h3> 
        <div class="card-tools"> 
          <button onclick="modalAction('{{ url('/level/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah</button> <!-- Ajax --> 
        </div> 
      </div> 
      <div class="card-body"> 
        @if (session('success'))
            <div class="alert alert-succes">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                        <small class="form-text text-muted">Level Pengguna</small>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_level"> 
          <thead> 
            <tr><th>ID</th><th>Kode Level</th><th>Nama Level</th><th>Aksi</th></tr> 
          </thead> 
      </table> 
    </div> 
  </div> 
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection 
 
@push('css') 
@endpush 
 
@push('js') 
  <script> 

    // Fungsi modalAction untuk load konten ke dalam modal
    function modalAction(url = '') {
      $('#myModal').load(url, function() {
          $('#myModal').modal('show');
      });
    }

    var dataLevel
    
    $(document).ready(function() { 
      dataLevel = $('#table_level').DataTable({ 
          // serverSide: true, jika ingin menggunakan server side processing 
          serverSide: true,      
          ajax: { 
              "url": "{{ url('level/list') }}", 
              "dataType": "json", 
              "type": "POST",
              "data": function (d) {
                d.id_level = $('#id_level').val();
              } 
          }, 
          columns: [ 
            { 
              // nomor urut dari laravel datatable addIndexColumn() 
              data: "DT_RowIndex",             
              className: "text-center", 
              orderable: false, 
              searchable: false     
            },{ 
              data: "kode_level",                
              className: "", 
              // orderable: true, jika ingin kolom ini bisa diurutkan  
              orderable: true,     
              // searchable: true, jika ingin kolom ini bisa dicari 
              searchable: true     
            },{ 
              data: "nama_level",                
              className: "", 
              orderable: true,     
              searchable: true     
            },{ 
              data: "aksi",                
              className: "", 
              orderable: false,     
              searchable: false     
            } 
          ] 
      }); 

      $('#id_level').on('change', function() {
        dataLevel.ajax.reload();
      });
      
    }); 
  </script> 
@endpush  