@extends('layouts.app')

@section('content')
        <h1>Master Jurnal</h1>

        <div class="mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_jurnal">
                Tambah Data Jurnal
            </button>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table" id="tabel_jurnal" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Kode Jurnal</th>
                            <th scope="col" class="text-center">Nama Jurnal</th>
                            <th scope="col" class="text-center">Nomor Terakhir</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Jurnal -->
        <div class="modal fade" id="modal_jurnal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Data Jurnal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahJurnal" action="{{ route('tambahjurnal') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mt-3">
                                <label for="jrcode" class="form-label">Kode Jurnal</label>
                                <input type="text" name="jrcode" id="jrcode" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="nama" class="form-label">Nama Jurnal</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="nomor_terakhir" class="form-label">No Terakhir</label>
                                <input type="text" name="nomor_terakhir" id="nomor_terakhir" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="simpan-jurnal" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ubah Jurnal -->
        <div class="modal fade" id="editJurnalModal" tabindex="-1" aria-labelledby="editJurnalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Jurnal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-edit-jurnal" action="{{ url('prosesubahjurnal/') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="jrcodelama" id="KodeJurnalLama">
                            <div class="mt-3">
                                <label for="jrcode" class="form-label">Kode Jurnal</label>
                                <input type="text" name="jrcode" id="editKodeJurnal" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="nama" class="form-label">Nama Jurnal</label>
                                <input type="text" name="nama" id="editnama" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="nomor_terakhir" class="form-label">No Terakhir</label>
                                <input type="text" name="nomor_terakhir" id="editnomor_terakhir" class="form-control">
                            </div>
                            <div class="mt-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="editketerangan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
                            <button form="form-edit-jurnal" type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
            document.getElementById("nomor_terakhir").addEventListener("input", function () {
                // Hanya izinkan angka positif
                let value = this.value;
                this.value = value.replace(/[^0-9]/g, ''); // Hapus karakter selain angka
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Proses Menampilkan Semua Data Jurnal Ke Datatable
            $('#tabel_jurnal').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('datajurnal') }}",
                columns: [
                    {data: 'jrcode', name: 'jrcode', render: function (data, type, row, meta) {
                        return `<p class="text-center">${meta.row + meta.settings._iDisplayStart + 1}</p>`
                    }},
                    {data: 'jrcode', name: 'jrcode', render: function (data, type, row) {
                        return `<p class="text-center">${row.jrcode}</p>`
                    }},
                    {data: 'nama', name: 'nama', render: function (data, type, row) {
                        return `<p class="text-center">${row.nama}</p>`
                    }},
                    {data: 'nomor_terakhir', name: 'nomor_terakhir', render: function (data, type, row) {
                        return `<p class="text-center">${row.nomor_terakhir}</p>`
                    }},
                    {data: 'keterangan', name: 'keterangan', render: function (data, type, row) {
                        return `<p class="text-center">${row.keterangan}</p>`
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        return `
                            <div class="dropdown d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item edit-jurnal text-center" href="#" data-id="${row.jrcode}">Ubah</a>
                                    <a class="dropdown-item hapus-jurnal text-center" href="#" data-id="${row.jrcode}">Hapus</a>
                                </div>
                            </div>
                        `;
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                }
            });

            // Proses Tambah Data Jurnal
            $('#tambahJurnal').on('submit', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#modal_jurnal').modal('hide');
                            $('#tambahJurnal')[0].reset();
                            alert(response.message);
                            $('#tabel_jurnal').DataTable().ajax.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr) {
                        var res = xhr.responseJSON;
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function (key, value) {
                                alert(value);
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });

            // Proses Ubah Data Jurnal
            // ambil satu data jurnal untuk di ubah
            $(document).on('click', '.edit-jurnal', function(e) {
                e.preventDefault();
                var button = $(this);
                var kodeJurnal = button.data('id');
                var editUrl = "{{ url('/ambiljurnal') }}/" + kodeJurnal;

                $('#form-edit-jurnal')[0].reset();

                $.ajax({
                    url: editUrl,
                    type: 'PUT',
                    success: function(response) {
                        if (response.status == 'success') {
                            var jurnal = response.jurnal;

                            $('#KodeJurnalLama').val(jurnal.jrcode);
                            $('#editKodeJurnal').val(jurnal.jrcode);
                            $('#editnama').val(jurnal.nama);
                            $('#editnomor_terakhir').val(jurnal.nomor_terakhir);
                            $('#editketerangan').val(jurnal.keterangan);
                            $('#editJurnalModal').modal('show');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            // ambil semua data jurnal yang diubah lalu simpan
            $('#form-edit-jurnal').on('submit', function(e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');
                var idUpdate = $('#editKodeJurnal').val();
                url = url + '/' + idUpdate;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#editJurnalModal').modal('hide');
                            alert('Success: ' + response.message);
                            $('#tabel_jurnal').DataTable().ajax.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        var res = xhr.responseJSON;
                        if ($.isEmptyObject(res) == false) {
                            $.each(res.errors, function(key, value) {
                                alert('Error: ' + value);
                            });
                        }
                        console.log('Gagal 2');
                    }
                });
            });

            // Proses Hapus Data Jurnal
            $(document).ready(function () {
                $(document).on('click', '.hapus-jurnal', function () {
                    hapusJurnal(this);
                });

                function hapusJurnal(e) {
                    let jrcode = e.getAttribute('data-id');
                    
                    // Konfirmasi penghapusan menggunakan confirm
                    if (confirm('Apakah anda yakin ingin menghapus data jurnal ini?')) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ url("/hapusjurnal") }}/' + jrcode,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert('Data jurnal berhasil dihapus.');
                                    $('#tabel_jurnal').DataTable().ajax.reload();
                                } else {
                                    alert('Gagal menghapus data: ' + data.message);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat menghapus data.');
                            }
                        });
                    } else {
                        alert('Proses hapus data jurnal dibatalkan.');
                    }
                }
            });

</script>
@endpush