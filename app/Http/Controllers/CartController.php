<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendMail;


class CartController extends Controller
{
    protected $cartService;
    
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        // Gọi hàm create và lưu kết quả trả về vào biến $result
        $result = $this->cartService->create($request);
        
        // Kiểm tra nếu kết quả trả về là false thì chuyển hướng lại trang trước
        if($result === false){
            return redirect()->back();
        }

        // Nếu thành công thì chuyển hướng đến trang giỏ hàng
        return redirect('/carts');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();
        return view('carts.list',[
            'title' => 'Gio Hang',
            'products' => $products,
            'carts'=> Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function addCart(Request $request)
    {
        $this->cartService->addCart($request);

        return redirect()->back();
    }
    // Ví dụ trong controller
    public function placeOrder(Request $request)
    {
        // Kiểm tra xem khách hàng đã đăng nhập chưa
        if (!Session::has('customer_id')) {
            return redirect()->route('user.login')->with('error', 'Bạn cần đăng nhập trước khi đặt hàng.');
        }
    
        // Kiểm tra thông tin đơn hàng trong session
        $carts = Session::get('carts');
    
        if (empty($carts)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống!');
        }
    
        // Gọi phương thức trong CartService để thực hiện đặt hàng
        $result = $this->cartService->addCart($request);
    
        if ($result) {
            // Sau khi đặt hàng thành công
            session()->flash('success', 'Đặt hàng thành công! Cảm ơn bạn đã mua hàng.');
            return redirect('/carts');
        } else {
            return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình đặt hàng, vui lòng thử lại.');
        }
    }
    
    

}
