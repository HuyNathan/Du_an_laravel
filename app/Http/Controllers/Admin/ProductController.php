<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Menu\MenuService; // Dịch vụ để lấy danh sách menus
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;

    public function __construct(ProductService $productService, MenuService $menuService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        // Lấy danh sách menus từ MenuService
        $menus = $this->menuService->getAll();

        return view('admin.product.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' => $menus, // Truyền biến menus vào view
        ]);
    }

    // Lưu sản phẩm vào database
    public function store(Request $request)
    {
        // Validate dữ liệu
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'menu_id' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'required',
            'content' => 'required',
            'thumb' => 'required|string',
            'active' => 'nullable|boolean' // Thêm kiểm tra cho trường active
        ]);
    
        // Gọi service để thêm sản phẩm
        $data = $request->all();
        $data['active'] = isset($data['active']) ? 1 : 0; // Chuyển đổi checkbox thành 0 hoặc 1
    
        $result = $this->productService->create($data);
    
        // Kiểm tra kết quả
        if ($result) {
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
        } else {
            return redirect()->back()->with('error', 'Thêm sản phẩm thất bại. Vui lòng thử lại.');
        }
    }
    
    public function update(Request $request, $id)
{
    $product = Product::find($id);

    // Cập nhật sản phẩm
    $product->name = $request->input('name');
    $product->menu_id = $request->input('menu_id');
    $product->price = $request->input('price');
    $product->price_sale = $request->input('price_sale');
    $product->description = $request->input('description');
    $product->content = $request->input('content');
    $product->thumb = $request->input('thumb');
    $product->active = $request->input('active', 0); // Mặc định là 0 nếu không chọn

    $product->save();

    // Chuyển hướng về trang danh sách sản phẩm sau khi cập nhật thành công
    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
}


    

    public function show(Product $product)
{
    return view('admin.product.edit', [
        'title' => 'Chỉnh sửa sản phẩm',
        'product' => $product,
        'menus' => $this->menuService->getAll()
    ]);
}

    


    // Hiển thị sản phẩm chi tiết (ví dụ khi chỉnh sửa)
    public function index()
    {
        // Lấy danh sách tất cả sản phẩm thông qua ProductService
        $products = $this->productService->get(); // Không cần truyền $page
    
        // Trả về view và truyền danh sách sản phẩm
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $products
        ]);
    }
    public function destroy($id) // Nhận ID từ tham số
    {
        // Tìm sản phẩm theo ID
        $product = Product::find($id);
    
        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$product) {
            return redirect()->route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }
    
        // Xóa sản phẩm
        $product->delete();
    
        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

}
