@extends('admin.page')
@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between">
                <div class="flex-column flex-md-row justify-content-start">
                    <h2 class="border-start border-danger border-4 py-2 px-2" style="">Surat Masuk</h2>
                </div>
                <div class="flex-column flex-md-row justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah
                        Surat Masuk</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Judul Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Tahun</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratMasuk as $surat)
                                        <tr>
                                            <td>{{ $surat->judul_surat }}</td>
                                            <td>{{ $surat->jenisSurat->nama }}</td>
                                            <td>{{ $surat->tanggal_masuk }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $surat->id }}">Detail</button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $surat->id }}">Edit</button>
                                                <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
    {{-- ===MODAL TAMBAH --}}
    <div id="tambahModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/add-surat-masuk" method="POST" id="myForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Tambah Surat
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Judul Surat</label>
                                <input class="form-control" type="text" placeholder="Judul Surat" id="judul-surat"
                                    name="judul_surat">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Jenis Surat</label>
                                <select class="form-control" placeholder="Jenis Surat" id="jenis-surat" name="jenis_surat">
                                    @foreach (App\Models\JenisSurat::all() as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Nama Pengirim</label>
                                <input class="form-control" type="text" placeholder="Nama Pengirim" id="nama-pengirim"
                                    name="nama_pengirim">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Arah Surat</label>
                                <input class="form-control" type="text" placeholder="Arah Surat" id="arah-surat"
                                    name="arah_surat" value="Surat Masuk" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">No Telepon</label>
                                <input class="form-control" type="text" placeholder="No Telepon" id="no-telepon"
                                    name="no_telepon">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd"
                                        name="tanggal_masuk" required>
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- ===MODAL DETAIL=== --}}
    <!-- sample modal content -->
    @foreach ($suratMasuk as $dataSuratMasuk)
        <div id="detailModal{{ $dataSuratMasuk->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Detail Surat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Judul Surat</label>
                                <input class="form-control" type="text" placeholder="Judul Surat"
                                    id="judul-surat{{ $dataSuratMasuk->id }}" name="judul_surat"
                                    value="{{ $dataSuratMasuk->judul_surat }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Jenis Surat</label>
                                <input class="form-control" placeholder="Jenis Surat"
                                    id="jenis-surat{{ $dataSuratMasuk->id }}" name="jenis_surat"
                                    value="{{ $dataSuratMasuk->id_jenis_surat }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Nama Pengirim</label>
                                <input class="form-control" type="text" placeholder="Nama Pengirim"
                                    id="nama-pengirim{{ $dataSuratMasuk->id }}" name="nama_pengirim"
                                    value="{{ $dataSuratMasuk->nama_pengirim }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Arah Surat</label>
                                <input class="form-control" type="text" placeholder="Arah Surat"
                                    id="arah-surat{{ $dataSuratMasuk->id }}}" name="arah_surat"
                                    value="{{ $dataSuratMasuk->arah_surat }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">No Telepon</label>
                                <input class="form-control" type="text" placeholder="No Telepon"
                                    id="no-telepon{{ $dataSuratMasuk->id }}}" name="no_telepon"
                                    value="{{ $dataSuratMasuk->no_telepon }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd"
                                        name="tanggal_masuk{{ $dataSuratMasuk->id }}"
                                        value="{{ $dataSuratMasuk->tanggal_masuk }}" disabled>
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
    <!-- /.modal -->
    {{-- ===END MODAL DETAIL=== --}}

    {{-- ===MODAL EDIT=== --}}
    @foreach ($suratMasuk as $dataSuratMasuk)
        <div id="editModal{{ $dataSuratMasuk->id }}" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('surat-masuk.edit', $dataSuratMasuk->id) }}" method="POST"
                        id="form{{ $dataSuratMasuk->id }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Edit Surat
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Judul Surat</label>
                                <input class="form-control" type="text" placeholder="Judul Surat"
                                    id="judul-surat{{ $dataSuratMasuk->id }}" name="judul_surat"
                                    value="{{ $dataSuratMasuk->judul_surat }}">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Jenis Surat</label>
                                <select class="form-control" placeholder="Jenis Surat"
                                    id="jenis-surat{{ $dataSuratMasuk->id }}" name="jenis_surat">
                                    @foreach (App\Models\JenisSurat::all() as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ $jenis->id == $dataSuratMasuk->id_jenis_surat ? 'selected' : '' }}>
                                            {{ $jenis->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Nama Pengirim</label>
                                <input class="form-control" type="text" placeholder="Nama Pengirim"
                                    id="nama-pengirim{{ $dataSuratMasuk->id }}" name="nama_pengirim"
                                    value="{{ $dataSuratMasuk->nama_pengirim }}">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Arah Surat</label>
                                <input class="form-control" type="text" placeholder="Arah Surat"
                                    id="arah-surat{{ $dataSuratMasuk->id }}}" name="arah_surat"
                                    value="{{ $dataSuratMasuk->arah_surat }}" disabled>
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">No Telepon</label>
                                <input class="form-control" type="text" placeholder="No Telepon"
                                    id="no-telepon{{ $dataSuratMasuk->id }}}" name="no_telepon"
                                    value="{{ $dataSuratMasuk->no_telepon }}">
                            </div>
                            <div class="col-md-12 pb-3">
                                <label for="example-text-input" class="form-label">Tanggal Masuk</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="date" class="form-control" placeholder="yyyy-mm-dd"
                                        name="tanggal_masuk" value="{{ $dataSuratMasuk->tanggal_masuk }}">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </div>
                <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        {{-- ===END MODAL EDIT=== --}}
    @endforeach
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tambahModal').on('hidden.bs.modal', function() {
                $('#myForm')[0].reset();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($suratMasuk as $dataSuratMasuk)
                const modalElement{{ $dataSuratMasuk->id }} = document.getElementById(
                    'editModal{{ $dataSuratMasuk->id }}');
                const formElement{{ $dataSuratMasuk->id }} = document.getElementById(
                    'form{{ $dataSuratMasuk->id }}');
                const originalValues{{ $dataSuratMasuk->id }} = {
                    judul_surat: '{{ $dataSuratMasuk->judul_surat }}',
                    jenis_surat: '{{ $dataSuratMasuk->id_jenis_surat }}',
                    nama_pengirim: '{{ $dataSuratMasuk->nama_pengirim }}',
                    arah_surat: '{{ $dataSuratMasuk->arah_surat }}',
                    no_telepon: '{{ $dataSuratMasuk->no_telepon }}',
                    tanggal_masuk: '{{ $dataSuratMasuk->tanggal_masuk }}'
                    // Tambahkan field lainnya sesuai kebutuhan
                };

                modalElement{{ $dataSuratMasuk->id }}.addEventListener('hidden.bs.modal', function() {
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="judul_surat"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.judul_surat;
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="jenis_surat"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.jenis_surat;
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="nama_pengirim"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.nama_pengirim;
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="arah_surat"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.arah_surat;
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="no_telepon"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.no_telepon;
                    formElement{{ $dataSuratMasuk->id }}.querySelector('[name="tanggal_masuk"]').value =
                        originalValues{{ $dataSuratMasuk->id }}.tanggal_masuk;
                });
            @endforeach
        });
    </script>
@endsection
