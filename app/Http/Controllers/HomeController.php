<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use App\Models\Gallery;
use App\Models\Pendaftaran;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $pendaftar = Pendaftaran::query();

        $data = [
            'gallery' => Gallery::all(),
            'faq' => FaqModel::all(),
            'testimoni' => Testimoni::where('status', 'active')->get(),
            'pendaftar' => [
                'menunggu' => $pendaftar->where('status', 'menunggu')->get()->count(),
                'diperiksa' => $pendaftar->where('status', 'diperiksa')->count(),
                'selesai' => $pendaftar->where('status', 'selesai')->count(),
            ],

        ];

        // dd($data['pendaftar']['menunggu']);

        return view('pasien.home.index', $data);
    }
}
