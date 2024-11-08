<?php
namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session; // Sử dụng Facade cho Session
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get(); // Lấy danh mục cha
    }
    // public function get($parent_id = 1)
    // {
    //     return Menu::
    //     when($parent_id == 0, function($query)use($parent_id){
    //         $query->where('parent_id',$parent_id);
    //     })
    //     ->get(); // Lấy danh mục cha
    // }
    public function getAll()
    {
        return Menu::orderBy('id', 'asc')->paginate(20);
    }
    
    public function create($request)
    {
        try {
            // Tạo danh mục mới
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (int) $request->input('active'),
                'slug' => Str::slug($request->input('name')), // Tạo slug tự động từ tên
            ]);

            // Thêm thông báo vào session khi thành công
            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $err) {
            // Bắt lỗi và thêm thông báo lỗi vào session
            Session::flash('error', 'Có lỗi xảy ra: ' . $err->getMessage());
            return false;
        }

        return true;
    }
    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderByDesc('id')
            ->get(); 
    }
    public function destroy($id)
    {
        // Tìm mục menu bằng ID và xóa
        $menu = Menu::find($id); // Tìm mục theo ID
    
        if ($menu) {
            return $menu->delete(); // Xóa và trả về kết quả
        }
    
        return false; // Trả về false nếu không tìm thấy
    }
    public function update($id, $request)
    {
       // Tìm danh mục theo ID
        $menu = Menu::find($id);

        if ($menu) {
            return $menu->update(); // Nếu không tìm thấy, trả về false
        }

        // Cập nhật thông tin

    
        // Xử lý lỗi và trả về false
        return false;
    }

    public function getId($id)
    {
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

    
        if ($request->input('price')) {
            $query->orderByDesc('price', $request->input('price'));
        }

        return $query->orderByDesc('id')
            ->paginate(12);
    }

}
        
    

