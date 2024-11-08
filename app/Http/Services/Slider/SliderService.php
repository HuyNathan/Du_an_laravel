<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request)
    {
        try {
            // Lưu hình ảnh vào thư mục lưu trữ
            if ($request->hasFile('thumb')) {
                $path = $request->file('thumb')->store('uploads', 'public'); // Lưu vào thư mục uploads trong storage
                $request->merge(['thumb' => '/storage/' . $path]); // Cập nhật đường dẫn hình ảnh
            }

            Slider::create($request->input());
            Session::flash('success', 'Thêm Slider mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Slider đã lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function get()
    {
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try {
            if ($request->hasFile('thumb')) {
                // Xóa hình ảnh cũ nếu có
                Storage::delete(str_replace('storage', 'public', $slider->thumb)); 
                $path = $request->file('thumb')->store('uploads', 'public'); // Lưu hình ảnh mới
                $slider->thumb = '/storage/' . $path; // Cập nhật đường dẫn hình ảnh
            }

            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Cập nhật slider thành công');
        } catch (\Exception $err) {
            Session::flash('error','Cập nhật slider đã lỗi');
            Log::info($err->getMessage());
            return false;
        }

        return true;
    }
    public function show()
    {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path); // Xóa ảnh từ thư mục lưu trữ
            $slider->delete();
            return true;
        }

        return false;
    }
}
