<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Support\Facades\Redis;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    public function create()
    {
        return view('admin.slider.add',[
            'title' => 'Thêm Slider mới'
    ]);
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'    
        ]);

        $this->slider->insert($request); 
        
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.slider.list', [
            'title' => 'Danh sách slider mới nhất',
            'sliders' => $this->slider->get() 
        ]);
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider 
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'    
        ]);

        $result = $this->slider->update($request, $slider); 
        if ($result) {
            return redirect('admin/sliders/list');
        }

        return redirect()->back();
    }

    public function destroy($id)
{
    // Tìm slider theo ID
    $slider = Slider::find($id);

    // Kiểm tra xem slider có tồn tại không
    if (!$slider) {
        return redirect()->route('admin.slider.index')->with('error', 'Slider không tồn tại.');
    }

    // Xóa slider
    $slider->delete();

    // Chuyển hướng về danh sách sliders với thông báo thành công
    return redirect()->route('admin.slider.index')->with('success', 'Slider đã được xóa thành công.');
}

}