<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
</head>

<body class="bg-light">
    <main class="container">

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <a href='' class="btn btn-primary tombol-tambah">+ Tambah Data</a>
                <a href='{{ url('penjualan') }}' class="btn btn-primary ">+ Penjualan</a>
            </div>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-5">Nama buku</th>
                        <th class="col-md-2">tahun buku</th>
                        <th class="col-md-2">stok</th>
                        <th class="col-md-4">aksi</th>
                    </tr>
                </thead>
                {{--  <tbody>
                    <tr>
                        <td>1</td>
                        <td>Anton</td>
                        <td>anton@gmail.com</td>
                        <td>
                            <a href='' class="btn btn-warning btn-sm">Edit</a>
                            <a href='' class="btn btn-danger btn-sm">Del</a>
                        </td>
                    </tr>
                </tbody>  --}}
            </table>

        </div>
        <!-- AKHIR DATA -->
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- START FORM -->
                    <div class="alert alert-danger d-none"></div>
                    <div class="alert alert-success d-none"></div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='namabuku' id="namabuku">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Tanggal Buku</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tglbuku' id="tglbuku">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='stok' id="stok">
                        </div>
                    </div>
                    <!-- AKHIR FORM -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @include('buku.script')
</body>

</html>
