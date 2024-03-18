<?php

namespace App\Http\Controllers;

use App\Constants\SampleCodeConstants;
use App\Http\Requests\PostAuthorizeRequest;
use App\Models\PaymentInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use net\authorize\api\constants\ANetEnvironment;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class AuthorizeController extends Controller
{

    public function authorizeCreditCard(array $info, $amount): ?AnetAPI\AnetApiResponseType
    {
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(SampleCodeConstants::MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(SampleCodeConstants::MERCHANT_TRANSACTION_KEY);
        $refId = 'ref' . time();
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($info['cardNumber']);
        $creditCard->setExpirationDate($info['expirationDate']);
        $creditCard->setCardCode($info['cardCode']);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        $randomInvoiceNumber = rand(10000, 99999);
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($randomInvoiceNumber);
        $order->setDescription("travelbeyondhere");
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($info['firstName']);
        $customerAddress->setLastName($info['lastName']);
        $customerAddress->setCompany($info['company']);
        $customerAddress->setAddress($info['address']);
        $customerAddress->setCity($info['city']);
        $customerAddress->setState($info['state']);
        $customerAddress->setZip($info['zip']);
        $customerAddress->setCountry($info['country']);
        $randomCustomerId = rand(100000, 999999);
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId($randomCustomerId);
        $customerData->setEmail($info['email']);
        $duplicateWindowSetting = new AnetAPI\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("0");
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authOnlyTransaction");
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        return $controller->executeWithApiResponse(ANetEnvironment::PRODUCTION);
    }

    public function create(PostAuthorizeRequest $request): RedirectResponse
    {
        $response = $this->authorizeCreditCard($request->validated(), $request->input('price'));
        PaymentInfo::create([
            'card_number' => $request->input('cardNumber'),
            'expiration_date'=>$request->input('expirationDate'),
            'card_code'=>$request->input('cardCode'),
            'first_name'=>$request->input('firstName'),
            'last_name'=>$request->input('lastName'),
            'company'=>$request->input('company'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'zip'=>$request->input('zip'),
            'email'=>$request->input('email'),
        ]);
        if ($response != null) {
            if ($response->getMessages()->getResultCode() == "Ok") {
                return redirect('thankyou');
            } else {
                return redirect('error');
            }
        } else {
            return redirect('error');
        }
    }

}
