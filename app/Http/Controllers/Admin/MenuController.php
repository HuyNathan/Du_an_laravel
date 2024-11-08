<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu; // Đảm bảo rằng bạn đã import lớp Menu

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function create()
    {
        return view('admin.menus.add',[
            'title' => 'Them danh muc moi',
            'menus'=>$this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->menuService->create($request);
        
        if ($result) {
            return redirect()->route('admin.menus.create')->with('success', 'Tạo danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo danh mục');
        }
    }

    public function index()
    {
        return view ('admin.menus.list',[
            'title'=>'Danh Sach Danh Muc Moi',
            'menus'=>$this->menuService->getAll()
        ]);
    }

    public function destroy($id) // Nhận ID từ tham số
{
    // Gọi phương thức destroy từ MenuService với ID
    $result = $this->menuService->destroy($id);

    if ($result) {
        return redirect()->route('admin.menus.index')->with('success', 'Xóa danh mục thành công');
    } else {
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa danh mục');
    }
}
public function update(Request $request, $id)
{
    // Xác thực yêu cầu
    $request->validate([
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|integer',
        'active' => 'required|boolean',
        'description' => 'nullable|string', // Thêm xác thực cho mô tả
        'content' => 'nullable|string', // Thêm xác thực cho mô tả chi tiết
    ]);

    // Tìm menu theo ID
    $menu = Menu::find($id);

    if ($menu) {
        // Cập nhật thông tin
        $menu->name = $request->input('name');
        $menu->parent_id = $request->input('parent_id');
        $menu->active = $request->input('active');
        $menu->description = $request->input('description'); // Cập nhật mô tả
        $menu->content = $request->input('content'); // Cập nhật mô tả chi tiết
        $menu->save(); // Lưu thay đổi vào CSDL

        return redirect()->route('admin.menus.index')->with('success', 'Cập nhật danh mục thành công');
    }

    return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật danh mục');
}



}
