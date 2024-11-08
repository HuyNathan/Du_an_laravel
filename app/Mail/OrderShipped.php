<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        // Nếu cần, bạn có thể truyền dữ liệu vào đây
    }

    public function build()
    {
        return $this->subject('Đơn hàng đã được giao')
                    ->view('emails.order_shipped'); // Đảm bảo bạn đã tạo view này
    }
}
