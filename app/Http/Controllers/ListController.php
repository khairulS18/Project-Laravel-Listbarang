<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $barangModel;
    public function __construct()
    {
        $this->barang = new barangModel();
    }

    public function index()
    {
        $data = [
            "title" => "Halaman Table",
            "barangs" => $this->barang::paginate(10)
        ];

        return view('view.index', $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "title" => "Halaman Tambah Data Barang"
        ];

        return view('view.created', $data);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "inputnamabarang" => "required",
            "inputhargabarang" => "required",
            "inputstokbarang" => "required",
            "foto" => "required|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:10240 ",
        ], [
            "inputnamabarang.required" => "Nama barang harus diisi!",
            "inputhargabarang.required" => "Harga barang harus diisi!",
            "inputstokbarang.required" => "Stok barang harus diisi!",
            "foto.required" => "Harus menyertakan foto barang!"
        ]);

        if (!is_dir('storage/img')) {
            # code...
            mkdir('/storage/img', 0777);
        };

        if ($request->hasFile("foto")) {
            $file = $request->file("foto");
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move("storage/img", $nama_file);
        } else {
            $nama_file = null;
        };

        $data = ([
            "nama_barang" => $request->inputnamabarang,
            "harga" => $request->inputhargabarang,
            "stok" => $request->inputstokbarang,
            "foto" => $nama_file
        ]);

        if ($this->barang->create($data)) {
            # code...
            return redirect()->route("view.index")->with("success", "Data barang berhasil ditambahkan!");
        } else {
            return redirect()->route("view.index")->with("error", "Data barang gagal ditambahkan!");
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function getData($id)
    {
        $data = $this->barang->find($id);

        $json = [
            'id' => $data->id,
            "namabarang" => $data->nama_barang,
            "harga" => $data->harga,
            "stok" => $data->stok
        ];
        return response()->json($json);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            "title" => "Halaman Edit Data Barang",
            "barang" => $this->barang->find($id)
        ];

        return view('view.edit', $data);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "inputnamabarang" => "required",
            "inputhargabarang" => "required",
            "inputstokbarang" => "required",
            "foto" => "required|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:10240 ",
        ], [
            "inputnamabarang.required" => "Nama barang harus diisi!",
            "inputhargabarang.required" => "Harga barang harus diisi!",
            "inputstokbarang.required" => "Stok barang harus diisi!",
            "foto.required" => "Harus menyertakan foto barang!"
        ]);

        $barang = $this->barang->find($id);
        $foto = $barang;

        if (!is_dir('storage/img')) {
            # code...
            mkdir('/storage/img', 0777);
        };

        if ($request->hasFile("foto")) {
            $file = $request->file("foto");
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move("storage/img", $nama_file);
        } else {
            $nama_file = $foto;
        }

        $data = ([
            "nama_barang" => $request->inputnamabarang,
            "harga" => $request->inputhargabarang,
            "stok" => $request->inputstokbarang,
            "foto" => $nama_file
        ]);

        if (!$this->barang->find($id)->update($data)) {
            return redirect()->route('view.index')->with("error", "Gagal mengubah data barang!");
            # code...
        }
        return redirect()->route('view.index')->with("success", "Data barang berhasil diubah!");

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = $this->barang->findOrFail($id);
        
        // Hapus foto jika ada
        if ($barang->foto) {
            Storage::delete('public/img/' . $barang->foto);
        }
        // Hapus entri barang dari basis data
        $barang->delete();

        return redirect()->route('view.index')
            ->with('success', 'Berhasil Manghapus Data Mahasiswa');
    }
}
