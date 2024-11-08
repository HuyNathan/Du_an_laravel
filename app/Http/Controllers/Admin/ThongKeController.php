<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu; // Nếu bạn sử dụng model Menu
use App\Models\Customer; // Import model Customer
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThongKeController extends Controller
{
    public function index()
    {
        // Lấy danh sách danh mục và số lượng sản phẩm
        $menus = Menu::withCount('products')->get();

        // Lấy số lượng khách hàng
        $customerCount = Customer::count(); // Đếm số lượng khách hàng

        return view('admin.statistics', [
            'title' => 'Trang thống kê',
            'menus' => $menus,
            'customerCount' => $customerCount, // Truyền số lượng khách hàng
        ]);
    }
}
