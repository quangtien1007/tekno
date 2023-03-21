<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
	{
		// Bắt buộc phải đăng nhập
		$this->middleware('auth');
	}
	
	public function getHome()
	{
		return view('admin.index');
	}
}