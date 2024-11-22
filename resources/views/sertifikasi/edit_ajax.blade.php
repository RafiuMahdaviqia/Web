@empty($sertifikasi)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                        Data yang anda cari tidak ditemukan
                    </div>
                    <a href="{{ url('/data_sertifikasi') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    @else
        <form action="{{ url('/data_sertifikasi/' . $sertifikasi->id_sertifikasi . '/update_ajax') }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div id="modal-master" class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Sertifikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Nama User</label>
                                <div class="col-10">
                                    <select class="form-control" id="id_user" name="id_user" required>
                                        <option value="">- Pilih user -</option>
                                        @foreach ($user as $item)
                                            <option {{ $item->id_user == $sertifikasi->id_user ? 'selected' : '' }}
                                                value="{{ $item->id_user }}">{{ $item->nama_user }}</option>
                                        @endforeach
                                    </select>
                                    <small id="error-id_user" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Nama Vendor</label>
                                <div class="col-10">
                                    <select class="form-control" id="id_vendor" name="id_vendor" required>
                                        <option value="">- Pilih vendor -</option>
                                        @foreach ($vendor as $item)
                                            <option {{ $item->id_vendor == $sertifikasi->id_vendor ? 'selected' : '' }}
                                                value="{{ $item->id_vendor }}">{{ $item->nama_vendor }}</option>
                                        @endforeach
                                    </select>
                                    <small id="error-id_vendor" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Nama Sertifikasi</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="nama_sertif" name="nama_sertif"
                                        value="{{ $sertifikasi->nama_sertif }}" required>
                                    <small id="error-nama_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Jenis Sertifikasi</label>
                                <div class="col-10">
                                    <select class="form-control" name="jenis_sertif" id="jenis_sertif" required>
                                        <option value="">- Pilih Jenis Sertifikasi -</option>
                                        <option value="Profesi">Profesi</option>
                                        <option value="Keahlian">Keahlian</option>
                                    </select>
                                    <small id="error-jenis_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>                                                       
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Tanggal Mulai</label>
                                <div class="col-10">
                                    <input type="date" class="form-control" id="tgl_mulai_sertif" name="tgl_mulai_sertif"
                                        value="{{ $sertifikasi->tgl_mulai_sertif }}" required>
                                    <small id="error-tgl_mulai_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Tanggal Akhir</label>
                                <div class="col-10">
                                    <input type="date" class="form-control" id="tgl_akhir_sertif" name="tgl_akhir_sertif"
                                        value="{{ $sertifikasi->tgl_akhir_sertif }}" required>
                                    <small id="error-tgl_akhir_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Jenis Pendanaan</label>
                                <div class="col-10">
                                    <select class="form-control" id="jenis_pendanaan_sertif" name="jenis_pendanaan_sertif" required>
                                        <option value="">- Pilih Jenis Pendanaan -</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Eksternal">Eksternal</option>
                                    </select>
                                    <small id="error-jenis_pendanaan_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>                                                                                   
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Bukti Sertifikasi</label>
                                <div class="col-10">
                                    <input type="file" class="form-control" id="bukti_sertif" name="bukti_sertif" accept=".pdf,.jpg,.png" required>
                                    <small id="error-bukti_sertif" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Status</label>
                                <div class="col-10">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">- Pilih status -</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    <small id="error-status" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(document).ready(function() {
                $("#form-edit").validate({
                    rules: {
                        id_user: {
                        required: true,
                        number: true
                    },
                    id_vendor: {
                        required: true,
                        number: true
                    },
                    nama_sertif: {
                        required: true,
                        minlength: 3
                    },
                    jenis_sertif: {
                        required: true,
                    },
                    tgl_mulai_sertif: {
                        required: true,
                        date: true
                    },
                    tgl_akhir_sertif: {
                        required: true,
                        date: true
                    },
                    jenis_pendanaan_sertif: {
                        required: true,
                    },
                    bukti_sertif: {
                        required: true,
                        extension: "pdf|jpg|png"
                    },
                    status: {
                        required: true
                    }
                    },
                    submitHandler: function(form) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            success: function(response) {
                                if (response.status) {
                                    $('#myModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message
                                    });
                                    datasertifikasi.ajax.reload();
                                } else {
                                    $('.error-text').text('');
                                    $.each(response.msgField, function(prefix, val) {
                                        $('#error-' + prefix).text(val[0]);
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan',
                                        text: response.message
                                    });
                                }
                            }
                        });
                        return false;
                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endempty