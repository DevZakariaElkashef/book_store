<?php


namespace App\Services;

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
            "CallBackUrl" => route("order.success"),
            "ErrorUrl" => route("order.error"),
            "Language" => app()->getLocale(),
            "DisplayCurrencyIso" => 'SAR',
            'CustomerReference'  => $order->id,
        ];

        $response = $this->fatoorahService->sendPayment($data);
        return str_replace('\\', '', $response['Data']['InvoiceURL']);
    }
}
