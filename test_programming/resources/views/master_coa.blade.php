@extends('layouts.app')

@section('content')
        <h1>Master COA</h1>

        <div class="mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_coa">
                Tambah Data COA
            </button>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table" id="tabel_coa" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Acc. Code</th>
                            <th scope="col" class="text-center">Acc. Name</th>
                            <th scope="col" class="text-center">Acc. Type</th>
                            <th scope="col" class="text-center">Level</th>
                            <th scope="col" class="text-center">Acc. Parents</th>
                            <th scope="col" class="text-center">Acc. Group</th>
                            <th scope="col" class="text-center">Acc. Control</th>
                            <th scope="col" class="text-center">Currency</th>
                            <th scope="col" class="text-center">Depart</th>
                            <th scope="col" class="text-center">Gain-Loss</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah COA -->
        <div class="modal fade" id="modal_coa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Data COA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="tambahCOA" action="{{ route('tambahcoa') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mt-3">
                                <label for="mis_kodeacc" class="form-label">Acc. Code</label>
                                <input type="text" name="mis_kodeacc" id="mis_kodeacc" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="namaacc" class="form-label">Acc. Name</label>
                                <input type="text" name="namaacc" id="namaacc" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tipeacc" class="form-label">Acc. Type</label>
                                        <select class="form-select" name="tipeacc" id="tipeacc" aria-label="Default select example">
                                            <option value="general">General</option>
                                            <option value="detil">Detil</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="levelacc" class="form-label">Level</label>
                                        <select class="form-select" name="levelacc" id="levelacc" aria-label="Default select example">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="parentacc" class="form-label">Acc. Parent</label>
                                <input type="text" name="parentacc" id="parentacc" class="form-control" readonly>
                            </div>
                            <div class="mt-3">
                                <label for="groupacc" class="form-label">Acc. Group</label>
                                <select class="form-select" name="groupacc" id="groupacc" aria-label="Default select example">
                                    <option value="asset">Asset</option>
                                    <option value="liabilities">Liabilities</option>
                                    <option value="capital">Capital</option>
                                    <option value="revenue">Revenue</option>
                                    <option value="cogs">Cogs</option>
                                    <option value="expences">Expences</option>
                                    <option value="other_revenue">Other Revenue</option>
                                    <option value="other_expences">Other Expences</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="controlacc" class="form-label">Acc. Control</label>
                                        <select class="form-select" name="controlacc" id="controlacc" aria-label="Default select example">
                                            <option value="none">None</option>
                                            <option value="cash/bank">Cash/Bank</option>
                                            <option value="acc.receivable">Acc.Receivable</option>
                                            <option value="acc.paylable">Acc.Paylable</option>
                                            <option value="fixed_asset">Fixed Asset</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mis_ccy" class="form-label">Currency</label>
                                        <select class="form-select" name="mis_ccy" id="mis_ccy" aria-label="Default select example">
                                            @foreach($ccy as $item)
                                                <option value="{{ $item->mis_ccy }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="depart" id="depart">
                                    <label class="form-check-label" for="depart">
                                        Department
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="gainloss" id="gainloss">
                                    <label class="form-check-label" for="gainloss">
                                        Gain-Loss
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="simpan-coa" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ubah COA -->
        <div class="modal fade" id="editCOAModal" tabindex="-1" aria-labelledby="editCOAModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data COA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-edit-coa" action="{{ url('prosesubahcoa/') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="mis_kodeacclama" id="KodeCoaLama">
                            <div class="mt-3">
                                <label for="mis_kodeacc" class="form-label">Acc. Code</label>
                                <input type="text" name="mis_kodeacc" id="editmis_kodeacc" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="namaacc" class="form-label">Acc. Name</label>
                                <input type="text" name="namaacc" id="editnamaacc" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tipeacc" class="form-label">Acc. Type</label>
                                        <select class="form-select" name="tipeacc" id="edittipeacc" aria-label="Default select example">
                                            <option value="general">General</option>
                                            <option value="detil">Detil</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="levelacc" class="form-label">Level</label>
                                        <select class="form-select" name="levelacc" id="editlevelacc" aria-label="Default select example">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="parentacc" class="form-label">Acc. Parent</label>
                                <input type="text" name="parentacc" id="editparentacc" class="form-control" readonly>
                            </div>
                            <div class="mt-3">
                                <label for="groupacc" class="form-label">Acc. Group</label>
                                <select class="form-select" name="groupacc" id="editgroupacc" aria-label="Default select example">
                                    <option value="asset">Asset</option>
                                    <option value="liabilities">Liabilities</option>
                                    <option value="capital">Capital</option>
                                    <option value="revenue">Revenue</option>
                                    <option value="cogs">Cogs</option>
                                    <option value="expences">Expences</option>
                                    <option value="other_revenue">Other Revenue</option>
                                    <option value="other_expences">Other Expences</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="controlacc" class="form-label">Acc. Control</label>
                                        <select class="form-select" name="controlacc" id="editcontrolacc" aria-label="Default select example">
                                            <option value="none">None</option>
                                            <option value="cash/bank">Cash/Bank</option>
                                            <option value="acc.receivable">Acc.Receivable</option>
                                            <option value="acc.paylable">Acc.Paylable</option>
                                            <option value="fixed_asset">Fixed Asset</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mis_ccy" class="form-label">Currency</label>
                                        <select class="form-select" name="mis_ccy" id="editmis_ccy" aria-label="Default select example">
                                            @foreach($ccy as $item)
                                                <option value="{{ $item->mis_ccy }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="depart" id="editdepart">
                                    <label class="form-check-label" for="depart">
                                        Department
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="gainloss" id="editgainloss">
                                    <label class="form-check-label" for="gainloss">
                                        Gain-Loss
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" style="margin-right: 10px;" data-bs-dismiss="modal">Tutup</button>
                            <button form="form-edit-coa" type="submit" class="btn btn-primary">Ubah</button>
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

            // Proses Menampilkan Semua Data COA Ke Datatable
            $('#tabel_coa').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('datacoa') }}",
                columns: [
                    { data: 'mis_kodeacc', name: 'mis_kodeacc', render: function (data, type, row, meta) {
                        return `<p class="text-center">${meta.row + meta.settings._iDisplayStart + 1}</p>`;
                    }},
                    { data: 'mis_kodeacc', name: 'mis_kodeacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.mis_kodeacc}</p>`;
                    }},
                    { data: 'namaacc', name: 'namaacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.namaacc}</p>`;
                    }},
                    { data: 'tipeacc', name: 'tipeacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.tipeacc}</p>`;
                    }},
                    { data: 'levelacc', name: 'levelacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.levelacc}</p>`;
                    }},
                    { data: 'parentacc', name: 'parentacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.parentacc ? row.parentacc : ''}</p>`;
                    }},
                    { data: 'groupacc', name: 'groupacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.groupacc}</p>`;
                    }},
                    { data: 'controlacc', name: 'controlacc', render: function (data, type, row) {
                        return `<p class="text-center">${row.controlacc}</p>`;
                    }},
                    { data: 'currency.name', name: 'currency.name', render: function (data, type, row) {
                        return `<p class="text-center">${row.currency ? row.currency.name : ''}</p>`;
                    }},
                    { data: 'depart', name: 'depart', render: function (data, type, row) {
                        return `<p class="text-center">${row.depart ? row.depart : ''}</p>`;
                    }},
                    { data: 'gainloss', name: 'gainloss', render: function (data, type, row) {
                        return `<p class="text-center">${row.gainloss ? row.gainloss : ''}</p>`;
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        return `
                            <div class="dropdown d-flex justify-content-center">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item edit-coa text-center" href="#" data-id="${row.mis_kodeacc}">Ubah</a>
                                    <a class="dropdown-item hapus-coa text-center" href="#" data-id="${row.mis_kodeacc}">Hapus</a>
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

            loadDataCOA();

            // Proses Load Data COA yang baru
            function loadDataCOA() {
                $.ajax({
                    url: '/ambil_coa_terakhir',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#parentacc').empty();
                        // Menampilkan data mis_kodeacc langsung ke dalam input
                        $('#parentacc').val(data.mis_kodeacc);
                    }
                });
            }

            // Proses Tambah Data COA
            $('#tambahCOA').on('submit', function (e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#modal_coa').modal('hide');
                            $('#tambahCOA')[0].reset();
                            loadDataCOA();
                            alert(response.message);
                            $('#tabel_coa').DataTable().ajax.reload();
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

            // Proses Ubah Data Coa
            // ambil satu data coa untuk di ubah
            $(document).on('click', '.edit-coa', function(e) {
                e.preventDefault();
                var button = $(this);
                var kodeCoa = button.data('id');
                var editUrl = "{{ url('/ambilcoa') }}/" + kodeCoa;

                $('#form-edit-coa')[0].reset();

                $.ajax({
                    url: editUrl,
                    type: 'PUT',
                    success: function(response) {
                        if (response.status == 'success') {
                            var coa = response.coa;

                            $('#KodeCoaLama').val(coa.mis_kodeacc);
                            $('#editmis_kodeacc').val(coa.mis_kodeacc);
                            $('#editnamaacc').val(coa.namaacc);
                            $('#edittipeacc').val(coa.tipeacc);
                            $('#editlevelacc').val(coa.levelacc);
                            $('#editparentacc').val(coa.parentacc);
                            $('#editgroupacc').val(coa.groupacc);
                            $('#editcontrolacc').val(coa.controlacc);
                            $('#editmis_ccy').val(coa.mis_ccy);
                            $('#editdepart').prop('checked', coa.depart === 'Y');
                            $('#editgainloss').prop('checked', coa.gainloss === 'Y');
                            $('#editCOAModal').modal('show');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: Terjadi kesalahan saat mengambil data.');
                    }
                });
            });

            // ambil semua data coa yang diubah lalu simpan
            $('#form-edit-coa').on('submit', function(e) {
                e.preventDefault();

                var data = $(this).serialize();
                var url = $(this).attr('action');
                var idUpdate = $('#editmis_kodeacc').val();
                url = url + '/' + idUpdate;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#editCOAModal').modal('hide');
                            alert('Success: ' + response.message);
                            $('#tabel_coa').DataTable().ajax.reload();
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

            // Proses Hapus Data COA
            $(document).ready(function () {
                $(document).on('click', '.hapus-coa', function () {
                    hapusCoa(this);
                });

                function hapusCoa(e) {
                    let mis_kodeacc = e.getAttribute('data-id');
                    
                    // Konfirmasi penghapusan menggunakan confirm
                    if (confirm('Apakah anda yakin ingin menghapus data coa ini?')) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ url("/hapuscoa") }}/' + mis_kodeacc,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if (data.success) {
                                    alert('Data coa berhasil dihapus.');
                                    $('#tabel_coa').DataTable().ajax.reload();
                                } else {
                                    alert('Gagal menghapus data: ' + data.message);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat menghapus data.');
                            }
                        });
                    } else {
                        alert('Proses hapus data coa dibatalkan.');
                    }
                }
            });

</script>
@endpush