<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2">
        <div class="alert alert-primary shadow">
            <h2 class="text-black">Table List Barang</h2>
        </div>

        {{-- Card --}}
        <div class="card shadow">
            <div class="card-body">
                @if ($barangs->isEmpty())
                    <div class="alert alert-danger">Data tidak tersedia</div>
                @else
                    {{ $barangs }}
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <a href="{{ route('view.created') }}" class="btn btn-primary mb-2">Tambah Barang</a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->harga }}</td>
                                    <td>
                                        @if ($barang->stok == 0)
                                            <div class="btn btn-danger btn-sm" disabled>Stok Kosong</div>
                                        @else
                                            <div class="btn btn-success btn-sm" disabled>Stok Tersedia</div>
                                        @endif
                                    </td>
                                    <td><img src="{{ asset('storage/img') . '/' . $barang->foto }}" alt="barang"
                                            height="150px"></td>
                                    <td>
                                        <a href="{{ route('view.edit', $barang->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form onclick="return confirm('Anda yakin ingin menghapus data ini?')"
                                            action="{{ route('view.destroy', $barang->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-primary show-data-btn"
                                            data-id="{{ $barang->id }}" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!-- Modal -->
                        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog"
                            aria-labelledby="modalLabelDetail" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabelDetail">Detail Data</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for viewing data -->
                                        <form>
                                            <div class="mb-3">
                                                <label for="namabarang" class="form-label">Nama Barang</label>
                                                <input type="namabarang" class="form-control" id="namabarang"
                                                    name="namabarang" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="hargabarang" class="form-label">Harga Barang</label>
                                                <input type="hargabarang" class="form-control" id="hargabarang"
                                                    name="hargabarang" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stokbarang" class="form-label">Stok Barang</label>
                                                <input type="stokbarang" class="form-control" id="stokbarang"
                                                    name="stokbarang" disabled>
                                            </div>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- EndModal --}}
                    </table>
                    {{ $barangs->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
                    $('.show-data-btn').click(function() {
                        var id = $(this).data('id');

                        $.ajax({
                            url: '/get-data/' + id,
                            type: 'GET',
                            success: function(data) {
                                $('#namabarang').val(data.namabarang);
                                $('#hargabarang').val(data.harga);
                                $('#stokbarang').val(data.stok);
                                // $('#matakuliah').val(data.matakuliah_id ? data.matakuliah_id.nama : '');

                                // Show modal using data-bs-toggle
                                $('#modalDetail').modal('show');
                            },
                            error: function(error) {
                                console.log('Error:', error);
                            }
                        });
                    });
                });
    </script>
</body>

</html>
