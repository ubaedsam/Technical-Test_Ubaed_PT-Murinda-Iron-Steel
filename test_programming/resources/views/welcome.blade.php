@extends('layouts.app')

@section('content')
        {{-- Proses Transaksi --}}
        <div class="card mb-2">
            <div class="card-body">
                <form id="tambahTransaksi" action="{{ route('tambahtransaksi') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Kode Jurnal :</label>
                                <select class="form-select" id="kode_jurnal" name="jrcode">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Tanggal :</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Ref :</label>
                                <input type="text" name="nomor_ref" id="nomor_ref" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="remark" id="remark"></textarea>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Kode Rekening</label>
                        <select class="form-select" id="mis_kodeacc" name="mis_kodeacc">
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">Uraian Transaksi</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Department</label>
                                <select class="form-select" name="departemen" id="departemen" aria-label="Default select example">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Debet :</label>
                                <input type="text" name="debet" id="debet" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-2">
                                <label for="" class="form-label">Kredit :</label>
                                <input type="text" name="kredit" id="kredit" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="simpan-transaksi" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <h3 class="mt-2" style="margin-left: 5px;">Jurnal Transaction</h3>
            <div class="card-body">
                <table class="table" id="table_transaksi" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Acc Code</th>
                            <th scope="col" class="text-center">Uraian Transaksi</th>
                            <th scope="col" class="text-center">Depart</th>
                            <th scope="col" class="text-center">Debet</th>
                            <th scope="col" class="text-center">Kredit</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Ubah Transaksi -->
        <div class="modal fade" id="editTransaksiModal" tabindex="-1" aria-labelledby="editTransaksiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Transaksi Jurnal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @php
                        use App\Models\JURNAL\jurnal;
                        use App\Models\COA\coa;

                        $jurnal = jurnal::orderBy('created_at', 'desc')->get();
                        $coa = coa::orderBy('created_at', 'desc')->get();
                    @endphp
                    <form id="form-edit-transaksi" action="{{ url('prosesubahtransaksi/') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="text" class="form-control" name="id" id="kodeId">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Kode Jurnal :</label>
                                        <select class="form-select" id="edit_kode_jurnal" name="jrcode">
                                            @foreach($jurnal as $item)
                                                <option value="{{ $item->jrcode }}">{{ $item->jrcode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Tanggal :</label>
                                        <input type="date" name="tanggal_transaksi" id="edit_tanggal_transaksi" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Ref :</label>
                                        <input type="text" name="nomor_ref" id="edit_nomor_ref" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="remark" id="edit_remark"></textarea>
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label">Kode Rekening</label>
                                <select class="form-select" id="edit_mis_kodeacc" name="mis_kodeacc">
                                    @foreach($coa as $item)
                                        <option value="{{ $item->mis_kodeacc }}">{{ $item->mis_kodeacc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="" class="form-label">Uraian Transaksi</label>
                                <textarea class="form-control" name="description" id="edit_description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Department</label>
                                        <select class="form-select" name="departemen" id="edit_departemen" aria-label="Default select example">
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Debet :</label>
                                        <input type="text" name="debet" id="edit_debet" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <label for="" class="form-label">Kredit :</label>
                                        <input type="text" name="kredit" id="edit_kredit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
                            <button form="form-edit-transaksi" type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
            loadDataJurnal();
            loadDataCOA();

            function loadDataJurnal() {
                $.ajax({
                        url: '/ambil_jurnal_baru',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Bersihkan opsi sebelum menambahkan yang baru
                            $('#kode_jurnal').empty();

                            // Tambahkan opsi baru dari data yang diterima
                            $.each(data, function (key, value) {
                            $('#kode_jurnal').append('<option value="' + value.jrcode + '">' + value.nama + '</option>');
                        });
                    }
                });
            }

            function loadDataCOA() {
                $.ajax({
                        url: '/ambil_coa_baru',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Bersihkan opsi sebelum menambahkan yang baru
                            $('#mis_kodeacc').empty();

                            // Tambahkan opsi baru dari data yang diterima
                            $.each(data, function (key, value) {
                            $('#mis_kodeacc').append('<option value="' + value.mis_kodeacc + '">' + value.mis_kodeacc + '</option>');
                        });
                    }
                });
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const printPdfRoute = "{{ route('downloadPDFTransaksi', ':id') }}";

            // Proses Menampilkan semua data jurnal transaksi ke dalam tabel
            $('#table_transaksi').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatransaksi') }}",
                columns: [
                    { data: 'id', name: 'id', render: function (data, type, row, meta) {
                        return `<p class="text-center">${meta.row + meta.settings._iDisplayStart + 1}</p>`;
                    }},
                    { data: 'mis_kodeacc', name: 'mis_kodeacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.mis_kodeacc}</p>`;
                    }},
                    { data: 'description', name: 'description', render: function (data, type, row) {
                        return `<p class="text-center">${row.description}</p>`;
                    }},
                    { data: 'departemen', name: 'departemen', render: function (data, type, row) {
                        return `<p class="text-center">${row.departemen}</p>`;
                    }},
                    { data: 'debet', name: 'debet', render: function (data, type, row) {
                        return `<p class="text-center">${row.debet}</p>`;
                    }},
                    { data: 'kredit', name: 'kredit', render: function (data, type, row) {
                        return `<p class="text-center">${row.kredit}</p>`;
                    }},
                    { data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        const pdfUrl = printPdfRoute.replace(':id', row.id);
                        return `
                            <div class="dropdown d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item edit-transaksi text-center" href="#" data-id="${row.id}">Ubah</a>
                                    <a class="dropdown-item hapus-transaksi text-center" href="#" data-id="${row.id}">Hapus</a>
                                    <a class="dropdown-item print-transaksi text-center" href="${pdfUrl}">Print PDF</a>
                                </div>
                            </div>
                        `;
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                },
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        $(column.footer()).find('input').on('keyup change', function() {
                            column.search(this.value).draw();
                        });
                    });
                }
            });

            // Proses Tambah Data Transaksi Jurnal
            $('#tambahTransaksi').on('submit', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#tambahTransaksi')[0].reset();
                            loadDataJurnal();
                            loadDataCOA();
                            alert(response.message);
                            $('#table_transaksi').DataTable().ajax.reload();
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

            // Proses Ubah Data Transaksi Jurnal
            // ambil satu data Transaksi Jurnal untuk di ubah
            $(document).on('click', '.edit-transaksi', function(e) {
                e.preventDefault();
                var button = $(this);
                var kodeTransaksi = button.data('id');
                var editUrl = "{{ url('/ambiltransaksi') }}/" + kodeTransaksi;

                $('#form-edit-transaksi')[0].reset();

                $.ajax({
                    url: editUrl,
                    type: 'PUT',
                    success: function(response) {
                        if (response.status == 'success') {
                            var transaksi = response.transaksi;

                            $('#kodeId').val(transaksi.id);
                            $('#edit_kode_jurnal').val(transaksi.jrcode);
                            $('#edit_tanggal_transaksi').val(transaksi.tanggal_transaksi);
                            $('#edit_nomor_ref').val(transaksi.nomor_ref);
                            $('#edit_remark').val(transaksi.remark);
                            $('#edit_mis_kodeacc').val(transaksi.mis_kodeacc);
                            $('#edit_description').val(transaksi.description);
                            $('#edit_departemen').val(transaksi.departemen);
                            $('#edit_debet').val(transaksi.debet);
                            $('#edit_kredit').val(transaksi.kredit);
                            $('#editTransaksiModal').modal('show');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            // ambil semua data transaksi jurnal yang diubah lalu simpan
            $('#form-edit-transaksi').on('submit', function(e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');
                var idUpdate = $('#kodeId').val();
                url = url + '/' + idUpdate;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#editTransaksiModal').modal('hide');
                            alert('Success: ' + response.message);
                            $('#table_transaksi').DataTable().ajax.reload();
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

            // Proses Hapus Data Transaksi Jurnal
            $(document).ready(function () {
                $(document).on('click', '.hapus-transaksi', function () {
                    hapusTransaksi(this);
                });

                function hapusTransaksi(e) {
                    let id = e.getAttribute('data-id');
                    
                    // Konfirmasi penghapusan menggunakan confirm
                    if (confirm('Apakah anda yakin ingin menghapus data transaksi ini?')) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ url("/hapustransaksi") }}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert('Data transaksi jurnal berhasil dihapus.');
                                    $('#table_transaksi').DataTable().ajax.reload();
                                } else {
                                    alert('Gagal menghapus data: ' + data.message);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat menghapus data.');
                            }
                        });
                    } else {
                        alert('Proses hapus data transaksi jurnal dibatalkan.');
                    }
                }
            });

</script>
@endpush