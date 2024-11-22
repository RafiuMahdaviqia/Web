<?php
namespace App\Http\Controllers;
use App\Models\VendorModel;
use App\Models\PelatihanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pelatihan',
            'list' => ['Home', 'Pelatihan']
        ];
        $page = (object) [
            'title' => 'Daftar Pelatihan yang terdaftar dalam sistem'
        ];
        $activeMenu = 'pelatihan'; // set menu yang sedang aktif
        $vendor = VendorModel::all(); // ambil data vendor untuk filter vendor
        $user = UserModel::all(); // ambil data user untuk filter user
        return view('pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'vendor' => $vendor, 'user' => $user, 'activeMenu' => $activeMenu]);
    }
    
    // Ambil data pelatihan dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $pelatihan = PelatihanModel::select('id_pelatihan', 'id_user','id_vendor','nama_pelatihan', 'tgl_mulai', 'tgl_akhir', 'level_pelatihan', 'jenis_pendanaan', 'bukti_pelatihan', 'status')
            ->with('vendor')
            ->with('user');
        // filter data pelatihan berdasarkan id_vendor dan id_user
        if ($request->id_vendor) {
            $pelatihan->where('id_vendor', $request->id_vendor);
        }
        if ($request->id_user) {
            $pelatihan->where('id_user', $request->id_user);
        }
        
        return DataTables::of($pelatihan)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelatihan) { // menambahkan kolom aksi
                // $btn = '<a href="' . url('/data_pelatihan/' . $pelatihan->id_pelatihan) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn = '<button onclick="modalAction(\'' . url('/data_pelatihan/' . $pelatihan->id_pelatihan ) . '\')" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<button onclick="modalAction(\'' . url('/data_pelatihan/' . $pelatihan->id_pelatihan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/data_pelatihan/' . $pelatihan->id_pelatihan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah pelatihan 
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Pelatihan',
            'list' => ['Home', 'Pelatihan', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Pelatihan baru'
        ];
        $vendor = VendorModel::all(); // ambil data vendor untuk filter vendor
        $user = UserModel::all(); // ambil data user untuk filter user
        $activeMenu = 'pelatihan'; // set menu yang sedang aktif
        return view('pelatihan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'vendor' => $vendor, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan detail pelatihan
    public function store(Request $request)
    {
        $request->validate([
            'id_user'            => 'required|integer',
            'id_vendor'          => 'required|integer',
            'nama_pelatihan'     => 'required|string|max:100',
            'tgl_mulai'          => 'required|date',
            'tgl_akhir'          => 'required|date',
            'level_pelatihan'    => 'required|string|max:50',
            'jenis_pendanaan'    => 'required|string|max:50',
            'bukti_pelatihan'    => 'nullable|string|max:255',
        ]);

        $status = $this->determineStatus($request->tgl_mulai, $request->tgl_akhir);

        PelatihanModel::create([
            'id_user'                  => $request->id_user,
            'id_vendor'                => $request->id_vendor,
            'nama_pelatihan'           => $request->nama_pelatihan,
            'tgl_mulai          '      => $request->tgl_mulai,
            'tgl_akhir'                => $request->tgl_akhir,
            'level_pelatihan'          => $request->level_pelatihan,
            'jenis_pendanaan'          => $request->jenis_pendanaan,
            'bukti_pelatihan'           => $request->bukti_pelatihan,
            'status'                   => $status,
        ]);
        return redirect('/data_pelatihan')->with('success', 'Data pelatihan berhasil disimpan');
    }

    // Fungsi untuk menentukan status berdasarkan tanggal mulai dan akhir
    private function determineStatus(string $tgl_mulai, string $tgl_akhir): string
    {
        try {
            $now = Carbon::now();
            $mulai = Carbon::parse($tgl_mulai);
            $akhir = Carbon::parse($tgl_akhir);

            if ($now->lt($mulai)) {
                return 'Belum Dimulai';
            } elseif ($now->between($mulai, $akhir)) {
                return 'Aktif';
            } else {
                return 'Selesai';
            }
        } catch (\Exception $e) {
            return 'Tanggal Tidak Valid'; // Tangani kasus tanggal yang tidak valid
        }
    }


    // Menampilkan detail pelatihan
    public function show(string $id)
    {
        $pelatihan = PelatihanModel::with('vendor')->find($id);
        $breadcrumb = (object) ['title' => 'Detail pelatihan', 'list' => ['Home', 'Pelatihan', 'Detail']];
        $page = (object) ['title' => 'Detail pelatihan'];
        $activeMenu = 'pelatihan'; // set menu yang sedang aktif
        return view('pelatihan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pelatihan' => $pelatihan, 'activeMenu' => $activeMenu]);
    }
    // Menampilkan halaman fore edit pelatihan 
    public function edit(string $id)
    {
        $pelatihan = PelatihanModel::find($id);
        $vendor = VendorModel::all(); // Ambil data vendor
        $user = UserModel::all(); // Ambil data user
        $breadcrumb = (object) [
            'title' => 'Edit Pelatihan',
            'list' => ['Home', 'Pelatihan', 'Edit']
        ];
        $page = (object) [
            "title" => 'Edit Pelatihan'
        ];
        $activeMenu = 'pelatihan'; // set menu yang sedang aktif
        return view('pelatihan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'pelatihan'=> $pelatihan, 'vendor' => $vendor, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data pelatihan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_user'            => 'required|integer',
            'id_vendor'          => 'required|integer',
            'nama_pelatihan'     => 'required|string|max:100',
            'tgl_mulai'          => 'required|date',
            'tgl_akhir'          => 'required|date',
            'level_pelatihan'    => 'required|string|max:50',
            'jenis_pendanaan'    => 'required|string|max:50',
            'bukti_pelatihan'    => 'nullable|string|max:255',
        ]);

        $status = $this->determineStatus($request->tgl_mulai, $request->tgl_akhir);

        PelatihanModel::find($id)->update([
            'id_user'                  => $request->id_user,
            'id_vendor'                => $request->id_vendor,
            'nama_pelatihan'           => $request->nama_pelatihan,
            'tgl_mulai          '      => $request->tgl_mulai,
            'tgl_akhir'                => $request->tgl_akhir,
            'level_pelatihan'          => $request->level_pelatihan,
            'jenis_pendanaan'          => $request->jenis_pendanaan,
            'bukti_pelatihan'           => $request->bukti_pelatihan,
            'status'                   => $status,
        ]);
        return redirect('/data_pelatihan')->with("success", "Data pelatihan berhasil diubah");
    }

    // Menghapus data pelatihan 
    public function destroy(string $id)
    {
        $check = PelatihanModel::find($id);
        if (!$check) {      // untuk mengecek apakah data pelatihan dengan id yang dimaksud ada atau tidak
            return redirect('/data_pelatihan')->with('error', 'Data pelatihan tidak ditemukan');
        }
        try {
            PelatihanModel::destroy($id); // Hapus data supplier
            return redirect('/data_pelatihan')->with('success', 'Data pelatihan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/data_pelatihan')->with('error', 'Data pelatihan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    // 1. public function create_ajax()
    public function create_ajax()
    {
        $vendor = VendorModel::select('id_vendor', 'nama_vendor')->get();
        $user = UserModel::select('id_user', 'nama_user')->get();
        return view('pelatihan.create_ajax')
            ->with('vendor', $vendor)
            ->with('user', $user);
    }
    

    // 2. public function store_ajax(Request $request)
    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_user'            => 'required|integer',
                'id_vendor'          => 'required|integer',
                'nama_pelatihan'     => 'required|string|max:100',
                'tgl_mulai'          => 'required|date',
                'tgl_akhir'          => 'required|date',
                'level_pelatihan'    => 'required|string|max:50',
                'jenis_pendanaan'    => 'required|string|max:50',
                'bukti_pelatihan'    => 'nullable|string|max:255',
            ];

            $status = $this->determineStatus($request->tgl_mulai, $request->tgl_akhir);

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            PelatihanModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data user berhasil disimpan'
            ]);
        }
        redirect('/');
    }


    // 3. public function edit_ajax(string $id)
    public function edit_ajax(string $id)
    {
        $pelatihan = PelatihanModel::find($id);
        $vendor = VendorModel::select('id_vendor', 'nama_vendor')->get();
        $user = UserModel::select('id_user', 'nama_user')->get();

        return view('pelatihan.edit_ajax', ['pelatihan' => $pelatihan, 'vendor' => $vendor, 'user' => $user]);
    }

    // 4. public function update_ajax(Request $request, $id)
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_user'            => 'required|integer',
                'id_vendor'          => 'required|integer',
                'nama_pelatihan'     => 'required|string|max:100',
                'tgl_mulai'          => 'required|date',
                'tgl_akhir'          => 'required|date',
                'level_pelatihan'    => 'required|string|max:50',
                'jenis_pendanaan'    => 'required|string|max:50',
                'bukti_pelatihan'    => 'nullable|string|max:255',
            ];

            $status = $this->determineStatus($request->tgl_mulai, $request->tgl_akhir);

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = PelatihanModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // 5. public function confirm_ajax(string $id)
    public function confirm_ajax(string $id)
    {
        $pelatihan = PelatihanModel::find($id);
        return view('pelatihan.confirm_ajax', ['pelatihan' => $pelatihan]);
    }

    // 6. public function delete_ajax(Request $request, $id)
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $pelatihan = PelatihanModel::find($id);
            if ($pelatihan) {
                $pelatihan->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // 7. public function show_ajax(string $id)
    public function show_ajax(string $id)
    {
        $pelatihan = PelatihanModel::find($id);

        $vendor = VendorModel::find($pelatihan->id_vendor);
        $user = UserModel::find($pelatihan->id_user);

        return view('pelatihan.show_ajax', ['pelatihan' => $pelatihan, 'vendor' => $vendor, 'user' => $user]);
    }

    
    public function import()
    {
        return view('pelatihan.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                // validasi file harus xls atau xlsx, max 1MB
                'file_pelatihan' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_pelatihan'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); // load reader file excel
            $reader->setReadDataOnly(true); // hanya membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
            $data = $sheet->toArray(null, false, true, true); // ambil data excel
            $insert = [];
            if (count($data) > 1) { // jika data lebih dari 1 baris
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // baris ke 1 adalah header, maka lewati
                        $insert[] = [
                            'id_user'            => $value['A'],
                            'id_vendor'          => $value['B'],
                            'nama_pelatihan'     => $value['C'],
                            'tgl_mulai'          => $value['D'],
                            'tgl_akhir'          => $value['E'],
                            'level_pelatihan'    => $value['F'],
                            'jenis_pendanaan'    => $value['G'],
                            'bukti_pelatihan'    => $value['H'],
                            'status'             => $value['I'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    // insert data ke database, jika data sudah ada, maka diabaikan
                    PelatihanModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }
    public function export_excel()
    {
        // ambil data barang yang akan di export
        $pelatihan = PelatihanModel::select('id_user','id_vendor','nama_pelatihan', 'tgl_mulai', 'tgl_akhir', 'level_pelatihan', 'jenis_pendanaan', 'bukti_pelatihan', 'status')
            ->orderBy('id_vendor')
            ->with('vendor')
            ->with('user')
            ->get();
        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama User');
        $sheet->setCellValue('C1', 'Nama Vendor');
        $sheet->setCellValue('D1', 'Nama Pelatihan');
        $sheet->setCellValue('E1', 'Tanggal Mulai');
        $sheet->setCellValue('F1', 'Tanggal Akhir');
        $sheet->setCellValue('G1', 'Level Pelatihan');
        $sheet->setCellValue('H1', 'Jenis Pendanaan');
        $sheet->setCellValue('I1', 'Bukti Pelatihan');
        $sheet->setCellValue('J1', 'Status');

        $sheet->getStyle('A1:J1')->getFont()->setBold(true); // bold header
        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($pelatihan as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->user->nama_user);
            $sheet->setCellValue('C' . $baris, $value->vendor->nama_vendor);
            $sheet->setCellValue('D' . $baris, $value->nama_sertif);
            $sheet->setCellValue('E' . $baris, $value->jenis_sertif);
            $sheet->setCellValue('F' . $baris, $value->tgl_mulai_sertif);
            $sheet->setCellValue('G' . $baris, $value->tgl_akhir_sertif);
            $sheet->setCellValue('H' . $baris, $value->jenis_pendanaan_sertif);
            $sheet->setCellValue('I' . $baris, $value->bukti_sertif);
            $sheet->setCellValue('J' . $baris, $value->status);
            $baris++;
            $no++;
        }
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }
        $sheet->setTitle('Data Pelatihan'); // set title sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Pelatihan ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    } // end function export_excel
    public function export_pdf()
    {
        $pelatihan = pelatihanModel::select('id_user','id_vendor','nama_pelatihan', 'tgl_mulai', 'tgl_akhir', 'level_pelatihan', 'jenis_pendanaan', 'bukti_pelatihan', 'status')
            ->orderBy('id_vendor')
            ->orderBy('id_user')
            ->with('vendor')
            ->with('user')
            ->get();
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('pelatihan.export_pdf', ['pelatihan' => $pelatihan]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url $pdf->render();
        return $pdf->stream('Data pelatihan' . date('Y-m-d H:i:s') . '.pdf');
    }
}
