<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use App\Models\FormMau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDanhSach()
    {
        $baiviet = BaiViet::paginate(16);
        return view('admin.baiviet.danhsach', compact('baiviet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getThem()
    {
        $form = FormMau::all();
        return view('admin.baiviet.them', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postThem(Request $request)
    {
        // dd($request);
        $bv = new BaiViet();
        $bv->tieude = $request->tieude;
        $bv->tieude_slug = Str::slug($request->tieude, '-');
        $bv->author_id = Auth::user()->id;
        if ($request->hasFile('thumbnail')) {
            $extension = $request->file('thumbnail')->extension();
            $filename = Str::slug($request->tieude, '-') . '.' . $extension;
            $path = Storage::putFileAs('baiviet/' . $bv->tenloai_slug, $request->file('thumbnail'), $filename);
        }
        if (!empty($path)) $bv->thumbnail = $path;
        $bv->noidung = $request->noidung;
        $bv->luotxem = 0;
        $bv->save();
        return redirect()->route('admin.baiviet');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSua($id)
    {
        $form = FormMau::all();
        $baiviet = BaiViet::find($id);
        return view('admin.baiviet.sua', compact('baiviet', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postSua(Request $request, $id)
    {
        $bv = BaiViet::find($id);
        $bv->tieude = $request->tieude;
        $bv->tieude_slug = Str::slug($request->tieude, '-');
        $bv->author_id = Auth::user()->id;
        if ($request->hasFile('thumbnail')) {
            $extension = $request->file('thumbnail')->extension();
            $filename = Str::slug($request->tieude, '-') . '.' . $extension;
            $path = Storage::putFileAs('baiviet/' . $bv->tenloai_slug, $request->file('thumbnail'), $filename);
        }
        if (!empty($path)) $bv->thumbnail = $path;
        $bv->noidung = $request->noidung;
        $bv->save();
        return redirect()->route('admin.baiviet');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getXoa($id)
    {
        $orm = BaiViet::find($id);
        $orm->delete();

        return redirect()->route('admin.baiviet');
    }
}
