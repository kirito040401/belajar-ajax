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
                ajax: "{{ url('jualanAjax') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'namabarang',
                    name: 'Namabarang'
                }, {
                    data: 'jenisbarang',
                    name: 'Jenisbarang'
                }, {
                    data: 'hargasatuan',
                    name: 'Hargasatuan'
                }, {
                    data: 'jumlahbarang',
                    name: 'Jumlahbarang'
                }, {
                    data: 'totalharga',
                    name: 'Totalharga'
                }, {
                    data: 'aksi',
                    name: 'Aksi'
                }]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.tombol-tambah', function(e) {
            e.preventDefault();
            $('#exampleModal').modal('show');
            $('.tombol-simpan').click(function() {
                simpan();
            });
        });

        $('body').on('click', '.tombol-edit', function(e) {
            var id = $(this).data('id');
            $.ajax({
                url: 'jualanAjax/' + id + '/edit',
                type: 'GET',
                success: function(response){
                    $('#exampleModal').modal('show');
                    $('#namabarang').val(response.result.namabarang);
                    $('#jenisbarang').val(response.result.jenisbarang);
                    $('#hargasatuan').val(response.result.hargasatuan);
                    $('#jumlahbarang').val(response.result.jumlahbarang);
                    console.log(response.result);
                    $('.tombol-simpan').click(function() {
                        simpan(id);
                    });
                }
            });
        });

        function simpan(id = ''){
            if (id ==''){
                var var_url = 'jualanAjax';
                var var_type = 'POST';
            } else{
                var var_url = 'jualanAjax/' +id;
                var var_type = 'PUT';
            }
            $.ajax({
                url: var_url,
                type: var_type,
                data: {
                    namabarang: $('#namabarang').val(),
                    jenisbarang: $('#jenisbarang').val(),
                    hargasatuan: $('#hargasatuan').val(),
                    jumlahbarang: $('#jumlahbarang').val()
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

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#namabarang').val('');
            $('#jenisbarang').val('');
            $('#hargasatuan').val('');
            $('#jumlahbarang').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });
</script>
