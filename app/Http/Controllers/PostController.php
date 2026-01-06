<?php
namespace App\Http\Controllers;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::all(); // Mengambil semua data dari tabel posts
        return view('tampil', compact('data')); // Kirim ke file view bernama tampil.blade.php
    }
}