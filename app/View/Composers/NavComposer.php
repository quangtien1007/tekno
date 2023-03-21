<?php

namespace App\View\Composers;

use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\View\View;

class NavComposer
{
    /**
     * The user repository implementation.
     *
     * @var  \App\Models\LoaiSanPham
     */
    protected $loaisanpham;
    protected $hangsanxuat;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Models\LoaiSanPham  $loaisanpham
     * @return void
     */
    public function __construct(LoaiSanPham $lsp)
    {
        $this->loaisanpham = $lsp;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navdata', $this->loaisanpham->where('parent_id', 0)->get());
    }
}
