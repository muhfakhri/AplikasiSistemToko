<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function karyawan()
    {
        return view('karyawan.home');
    }
}