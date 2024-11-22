@empty($pelatihan)
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
                    <a href="{{ url('/data_pelatihan') }}" class="btn btn-warning">Kembali</a>
                </div>
            </div>
        </div>
    @else
        <form action="{{ url('/data_pelatihan/' . $pelatihan->id_pelatihan . '/update_ajax') }}" method="POST" id="form-edit">
            @csrf
            @method('PUT')
            <div id="modal-master" class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelatihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Nama Pelatihan</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="nama_pelatihan" name="nama_pelatihan"
                                        value="{{ $pelatihan->nama_pelatihan }}" required>
                                    <small id="error-nama_pelatihan" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Level Pelatihan</label>
                                <div class="col-10">
                                    <select class="form-control" id="level_pelatihan" name="level_pelatihan" required>
                                        <option value="">- Pilih Level Pelatihan -</option>
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                    <small id="error-level_pelatihan" class="error-text form-text text-danger"></small>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Tanggal Mulai</label>
                                <div class="col-10">
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                                        value="{{ $pelatihan->tgl_mulai }}" required>
                                    <small id="error-tgl_mulai" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Tanggal Akhir</label>
                                <div class="col-10">
                                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                        value="{{ $pelatihan->tgl_akhir }}" required>
                                    <small id="error-tgl_akhir" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Jenis Pendanaan</label>
                                <div class="col-10">
                                    <select class="form-control" id="jenis_pendanaan" name="jenis_pendanaan" required>
                                        <option value="">- Pilih Jenis Pendanaan -</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="Eksternal">Eksternal</option>
                                    </select>
                                    <small id="error-jenis_pendanaan" class="error-text form-text text-danger"></small>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Bukti Pelatihan</label>
                                <div class="col-10">
                                    <input type="file" class="form-control" id="bukti_pelatihan" name="bukti_pelatihan" accept=".pdf,.jpg,.png" required>
                                    <small id="error-bukti_pelatihan" class="error-text form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 control-label col-form-label">Status</label>
                                <div class="col-10">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">- Pilih Status -</option>
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
                        minlength: 3
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
                        minlength: 3
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
                                    datapelatihan.ajax.reload();
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