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
            <h2 class="text-black">Tambah Barang</h2>
        </div>

        {{-- Card --}}
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('view.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="mb-3">
                        <label for="inputnamabarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('inputnamabarang') is-invalid @enderror"
                            id="inputnamabarang" name="inputnamabarang" placeholder="Isikan nama barang!" value="{{ $barang->nama_barang }}">
                        @error('inputnamabarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputhargabarang" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control @error('inputhargabarang') is-invalid @enderror"
                            id="inputhargabarang" name="inputhargabarang" placeholder="Isikan harga barang!" value="{{ $barang->harga }}">
                        @error('inputhargabarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputstokbarang" class="form-label">Stok Barang</label>
                        <input type="number" class="form-control  @error('inputstokbarang') is-invalid @enderror"
                        id="inputstokbarang" name="inputstokbarang" placeholder="Isikan stok barang!" value="{{ $barang->stok }}">
                        @error('inputstokbarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Gambar Barang</label>
                        <input type="file" class="form-control  @error('foto') is-invalid @enderror" id="foto"
                            name="foto">
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <a href="{{ route('view.index') }}" class="btn btn-danger">Kembali</a>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
