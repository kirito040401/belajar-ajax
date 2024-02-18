<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ url('bukuAjax') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'namabuku',
                    name: 'Namabuku'
                }, {
                    data: 'tglbuku',
                    name: 'Tglbuku'
                }, {
                    data: 'stok',
                    name: 'Stok'
                }, {
                    data: 'aksi',
                    name: 'Aksi'
                }]
            });
        });

    //global setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //02 form tambah
        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show');
            $('.tombol-simpan').click(function() {
                simpan();
            });
        });

    //03 form edit
    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        $.ajax({
            url: 'bukuAjax/' + id + '/edit',
            type: 'GET',
            success: function(response){
                $('#exampleModal').modal('show');
                $('#namabuku').val(response.result.namabuku);
                $('#tglbuku').val(response.result.tglbuku);
                $('#stok').val(response.result.stok);
                console.log(response.result);
                $('.tombol-simpan').click(function() {
                    simpan(id);
                });
            }
        });
    });

    //04 delete
    $('body').on('click', '.tombol-delete', function(e) {
        if (confirm('yakin data tersebut mau dihapus?') ==true){
            var id = $(this).data('id');
            $.ajax({
                url: 'bukuAjax/' + id ,
                type: 'DELETE',
            })
            $('#myTable').DataTable().ajax.reload();
        }
    });

    //simpan-update
    function simpan(id = ''){
        if (id ==''){
            var var_url = 'bukuAjax';
            var var_type = 'POST';
        } else{
            var var_url = 'bukuAjax/' +id;
            var var_type = 'PUT';
        }
        $.ajax({
            url: var_url,
            type: var_type,
            data: {
                namabuku: $('#namabuku').val(),
                tglbuku: $('#tglbuku').val(),
                stok: $('#stok').val()
            },
            success: function(response) {
                if (response.errors) {
                    console.log(response.errors);
                    $('.alert-danger').removeClass('d-none');
                    $('.alert-danger').html("<ul>");
                    $.each(response.errors, function(key, value) {
                        $('.alert-danger').find('ul').append("<li>" + value +
                            "</li>");
                    });
                    $('.alert-danger').append("</ul>");
                } else {
                    $('.alert-success').removeClass('d-none');
                    $('.alert-success').html(response.success);
                }
                $('#myTable').DataTable().ajax.reload();
            }

        });
    }

    //validasi
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#namabuku').val('');
            $('#tglbuku').val('');
            $('#stok').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
    </script>
