<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductService
{
    const LIMIT = 16;

    // Lấy danh sách sản phẩm với phân trang
    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb', 'active')
            ->orderByDesc('id')
            ->paginate(self::LIMIT); // Sử dụng paginate thay vì get
    }


    // Lấy thông tin sản phẩm theo ID, chỉ lấy sản phẩm đang active
    public function show($id)
    {
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }

    // Lấy thêm sản phẩm cho phần "Sản phẩm tương tự", không lấy sản phẩm hiện tại
    public function more($id)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }

    // Thêm sản phẩm mới vào cơ sở dữ liệu
    public function create($data)
    {
        try {
            Product::create([
                'name' => $data['name'],
                'menu_id' => $data['menu_id'],
                'price' => $data['price'],
                'price_sale' => $data['price_sale'],
                'description' => $data['description'],
                'content' => $data['content'],
                'thumb' => $data['thumb'],
                'active' => isset($data['active']) ? $data['active'] : 0, // Kiểm tra active
            ]);

            Session::flash('success', 'Thêm sản phẩm thành công');
            return true;
        } catch (\Exception $e) {
            Log::error('Error adding product: ' . $e->getMessage()); // Ghi log lỗi
            Session::flash('error', 'Thêm sản phẩm thất bại');
            return false;
        }
    }

    // Lấy tất cả sản phẩm không phân trang
    public function getAllProducts()
    {
        return Product::orderBy('updated_at', 'desc')->get();
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($id);
    
        if ($product) {
            $product->delete();
            Session::flash('success', 'Xóa sản phẩm thành công');
            return true;
        } else {
            Session::flash('error', 'Sản phẩm không tồn tại');
            return false;
        }
    }
}
