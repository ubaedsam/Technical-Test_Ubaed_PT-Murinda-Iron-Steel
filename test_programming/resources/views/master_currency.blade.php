@extends('layouts.app')

@section('content')
        <h1>Master Currency</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_cyy">
            Tambah Data Currency (CCY)
        </button>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table" id="tabel_currency" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Currency (CCY)</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Currency (CCY) -->
        <div class="modal fade" id="modal_cyy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Input Data Currency</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahCCY" action="{{ route('tambahcurrency') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mt-3">
                                <label for="ccy" class="form-label">CCY (Nomor Currency)</label>
                                <input type="text" name="ccy" id="ccy" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="name" class="form-label">Nama Currency</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="simpan-cyy" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ubah Currency (CCY) -->
        <div class="modal fade" id="editCCYModal" tabindex="-1" aria-labelledby="editCCYModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Currency</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-edit-CCY" action="{{ url('prosesubahcurrency/') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" name="misccy" id="kodemisccy">
                            <div class="mt-3">
                                <label for="ccy" class="form-label">CCY (Nomor Currency)</label>
                                <input type="text" name="ccy" id="editccy" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="name" class="form-label">Nama Currency</label>
                                <input type="text" name="name" id="editname" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
                            <button form="form-edit-CCY" type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Proses Menampilkan Semua Data Jurnal Ke Datatable
            $('#tabel_currency').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('datacurrency') }}",
                columns: [
                    {data: 'mis_ccy', name: 'mis_ccy', render: function (data, type, row, meta) {
                        return `<p class="text-center">${meta.row + meta.settings._iDisplayStart + 1}</p>`
                    }},
                    {data: 'ccy', name: 'ccy', render: function (data, type, row) {
                        return `<p class="text-center">${row.ccy}</p>`
                    }},
                    {data: 'name', name: 'name', render: function (data, type, row) {
                        return `<p class="text-center">${row.name}</p>`
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        return `
                            <div class="dropdown d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item edit-currency text-center" href="#" data-id="${row.mis_ccy}">Ubah</a>
                                    <a class="dropdown-item hapus-currency text-center" href="#" data-id="${row.mis_ccy}">Hapus</a>
                                </div>
                            </div>
                        `;
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                }
            });

            // Proses Tambah Data Currency
            $('#tambahCCY').on('submit', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#modal_cyy').modal('hide');
                            $('#tambahCCY')[0].reset();
                            alert(response.message);
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

            // Proses Ubah Data Currency
            // ambil satu data currency untuk di ubah
            $(document).on('click', '.edit-currency', function(e) {
                e.preventDefault();
                var button = $(this);
                var kodeCcy = button.data('id');
                var editUrl = "{{ url('/ambilcurrency') }}/" + kodeCcy;

                $('#form-edit-CCY')[0].reset();

                $.ajax({
                    url: editUrl,
                    type: 'PUT',
                    success: function(response) {
                        if (response.status == 'success') {
                            var ccy = response.ccy;

                            $('#kodemisccy').val(ccy.mis_ccy);
                            $('#editccy').val(ccy.ccy);
                            $('#editname').val(ccy.name);
                            $('#editCCYModal').modal('show');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            // ambil semua data currency yang diubah lalu simpan
            $('#form-edit-CCY').on('submit', function(e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');
                var idUpdate = $('#kodemisccy').val();
                url = url + '/' + idUpdate;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#editCCYModal').modal('hide');
                            alert('Success: ' + response.message);
                            $('#tabel_currency').DataTable().ajax.reload();
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

            // Proses Hapus Data Currency
            $(document).ready(function () {
                $(document).on('click', '.hapus-currency', function () {
                    hapusCurrency(this);
                });

                function hapusCurrency(e) {
                    let mis_ccy = e.getAttribute('data-id');
                    
                    // Konfirmasi penghapusan menggunakan confirm
                    if (confirm('Apakah anda yakin ingin menghapus data currency ini?')) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ url("/hapuscurrency") }}/' + mis_ccy,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert('Data currency berhasil dihapus.');
                                    $('#tabel_currency').DataTable().ajax.reload();
                                } else {
                                    alert('Gagal menghapus data: ' + data.message);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat menghapus data.');
                            }
                        });
                    } else {
                        alert('Proses hapus data currency dibatalkan.');
                    }
                }
            });

</script>
@endpush