<?php


namespace App\Services;

use App\Models\Order;
use App\Services\FatoorahService;

class PaymentService
{
    protected $fatoorahService;

    public function __construct(FatoorahService $fatoorahService)
    {
        $this->fatoorahService = $fatoorahService;
    }

    public function processPayment($user, $order, $total)
    {
        $data = [
            "CustomerName" => $user->name,
            "NotificationOption" => 'LNK',
            "InvoiceValue" => $total,
            "CustomerEmail" => $user->email,
            "CallBackUrl" => url("order-callback"),
            "ErrorUrl" => route("orders.error"),
            "Language" => app()->getLocale(),
            "DisplayCurrencyIso" => 'SAR',
            'CustomerReference'  => $order->id,
        ];

        $response = $this->fatoorahService->sendPayment($data);
        return str_replace('\\', '', $response['Data']['InvoiceURL']);
    }

    public function getStatus($request)
    {
        $data['Key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';

        $response =  $this->fatoorahService->GetPaymentStatus($data);

        if ($response['Data']['CustomerReference']) {
            $order = Order::find($response['Data']['CustomerReference']);
            $order->transaction_id = $response['Data']['InvoiceId'];
            $order->payment_status = 1;
            $order->save();
        }


        return true;
    }
}
