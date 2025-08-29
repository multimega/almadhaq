<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use DataTables;
use App\Models\User;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Shipment;
use App\Models\OrderTrack;
use App\Models\VendorOrder;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Imports\OrdersImport;
use App\Models\Generalsetting;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderEmail;

class OrderController extends Controller
{


    public  $b;
    protected $tokenz;
    protected $access_token;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->b = Generalsetting::findOrFail(1);


        /*if(($this->b->abs_username != null && $this->b->abs_password != null )){
                     
                      $bostaa=array(
                        
                          "UserName"=>$this->b->abs_username,
                          "Password"=>$this->b->abs_password,
                     
                     );
                 
                       $d = $bostaa;
                       $data = json_encode($d) ;
                       $client = new Client([
                        'headers' => ['Content-Type' =>'application/json']
                      
                      ]);
                
                          $response = $client->put('http://a1.mpsegypt.com/DemoAPI/api/ClientUsers/Login',
                
                              ['body' =>$data]
                        
                         );
                      
                       $m = json_decode($response->getBody(), true);
                       
                       $this->tokenz=$m['AccessToken'];
                       
                 }*/
    }

    //*** JSON Request
    public function datatables($status)
    {
        if ($status == 'pending') {
            $datas = Order::where('status', '=', 'pending')->where('order_completed', 1)->orderBy('id', 'desc')->get();
        } elseif ($status == 'processing') {
            $datas = Order::where('status', '=', 'processing')->where('order_completed', 1)->orderBy('id', 'desc')->get();
        } elseif ($status == 'completed') {
            $datas = Order::where('status', '=', 'completed')->where('order_completed', 1)->orderBy('id', 'desc')->get();
        } elseif ($status == 'declined') {
            $datas = Order::where('status', '=', 'declined')->where('order_completed', 1)->orderBy('id', 'desc')->get();
        } else {
            $datas = Order::orderBy('id', 'desc')->where('order_completed', 1)->get();
        }

        return Datatables::of($datas)
            ->editColumn('id', function (Order $data) {
                $id = '<a href="' . route('admin-order-invoice', $data->id) . '">' . $data->order_number . '</a>';
                return $id;
            })->editColumn('user_id', function (Order $data) {
                $user = User::find($data->user_id);
                if ($user) {
                    $id = '<a href="' . route('admin-user-show', $data->user_id) . '">' . $user->name . '</a>';
                } else {
                    $id = 'User Deleted';
                }
                return $id;
            })
            ->editColumn('created_at', function (Order $data) {
                return $data->created_at
                    ->format('d/m/Y h:i A');     // 12-hour format with AM/PM
            })


            ->editColumn('pay_amount', function (Order $data) {
                return $data->currency_sign . round($data->pay_amount * $data->currency_value, 2);
            })
            ->addColumn('action', function (Order $data) {
                $orders = '<a href="javascript:;" data-href="' . route('admin-order-edit', $data->id) . '" class="delivery" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-dollar-sign"></i> Delivery Status</a>';
                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-order-show', $data->id) . '" > <i class="fas fa-eye"></i> Details</a>  <a href="javascript:;" data-href="' . route('admin-order-delete', $data->id) . '" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a>      <a href="javascript:;" class="send" data-email="' . $data->customer_phone . '" data-bs-toggle="modal" data-bs-target="#vendorform"><i class="fas fa-envelope"></i> Send</a><a href="javascript:;" data-href="' . route('admin-order-track', $data->id) . '" class="track" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-truck"></i> Track Order</a>' . $orders . '</div></div>';
            })
            ->rawColumns(['id', 'user_id', 'action'])
            ->toJson();
    }
    public function index()
    {

        return view('admin.order.index');
    }

    public function edit($id)
    {
        // return 'here ';
        $data = Order::find($id);
        return view('admin.order.delivery', compact('data'));
    }



    public function generate_pdf(Request $request)
    {
        // dd($request);
        $password = md5('DtH@A!t10pos2n1');

        $security_key = "HAdhn1k!onDFG";

        $order = Order::where('id', $request->id)->first();

        //DWB Serial Number
        $sn = $request->serial;
        // dd($order);
        //encrypt security key
        $keyEncrypted = strrev(md5($security_key));

        //hash key
        $Hhash_key = trim(sha1($sn . $keyEncrypted));

        $client = new Client;

        $response = $client->post(
            'http://api.egyptexpress.me/api/AWBpdf/',
            [
                'form_params' => [
                    "accountNo" => 37,
                    "password" => $password,
                    "SN" => $sn,
                    "hashkey" => $Hhash_key
                ]
            ]
        );
        return $response;
    }



    //*** POST Request


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data  = Order::findOrFail($id);
        $order = Order::findOrFail($id);
        $this->createShipmentMethod();
        $input = $request->all();

        $nowtimz = time();

        if ($order->customer_city == "القاهرة") {

            $c = "CAI";
        } elseif ($order->customer_city == "الجيزة") {

            $c = "GIZ";
        } elseif ($order->customer_city == "بنى سويف") {

            $c = "BAN";
        } elseif ($order->customer_city  = "دمياط") {


            $c = "QDX";
        } elseif ($order->customer_city  = "الفيوم") {
            $c = "FAY";
        } elseif ($order->customer_city == "الاسكندرية") {

            $c = "ALX";
        } elseif ($order->customer_city == "القليوبية") {

            $c = "KAL";
        } elseif ($order->customer_city == "الغربية") {


            $c = "GHA";
        } elseif ($order->customer_city  == " الشرقية") {


            $c = "SHA";
        } elseif ($order->customer_city == "المنوفية") {


            $c = "MEN";
        } elseif ($order->customer_city == "الدقهلية") {


            $c = "DAK";
        } elseif ($order->customer_city  == "المنيا") {


            $c = "EMY";
        } elseif ($order->customer_city  == "سوهاج") {


            $c = "QHX";
        } elseif ($order->customer_city = "شرم الشيخ") {


            $c = "SSH";
        } elseif ($order->customer_city == "الإسماعيلية") {


            $c = "QIV";
        } elseif ($order->customer_city  == "الأقصر") {


            $c = "LXR";
        } elseif ($order->customer_city  == "قنا") {


            $c = "QU";
        } elseif ($order->customer_city == "السويس") {


            $c = "SUZ";
        } elseif ($order->customer_city  == "بورسعيد") {


            $c = "PSD";
        } else {



            $c = "CAI";
        }


        if ($order->customer_city = "Cairo") {

            $shipp_city = 13;
        } elseif ($order->customer_city = "Giza") {

            $shipp_city = 13;
        } elseif ($order->customer_city = "Alexandria") {
            $shipp_city = 23;
        } else {

            $shipp_city = 40;
        }



        if ($input['status'] == "processing") {

            $gs = Generalsetting::findOrFail(1);

            if ($data->shipment_id == 3) {

                $bostaa = array(

                    "type" => 10,

                    "cod" => round($order->pay_amount * $order->currency_value, 2)

                );

                $bostaa['pickupAddress'] = array(

                    "firstLine" => $order->customer_address,
                    "floor" => $order->customer_address,
                    "city" => "EG-01",
                    "zone" => $order->customer_city,
                    "district" => "cairo",
                );

                $bostaa['dropOffAddress'] = array(

                    "firstLine" => $order->customer_address,
                    "floor" => $order->customer_address,
                    "city" => "EG-01",
                    "zone" => $order->customer_city,
                    "buildingNumber" => "43"


                );

                $bostaa['receiver'] = array(

                    "firstName" => $order->customer_name,
                    "lastName" => $order->customer_name,
                    "phone" => "$order->customer_phone",

                );

                $d = $bostaa;
                $data = json_encode($d);
                $client = new Client([
                    'headers' => ['Content-Type' => 'application/json', 'Authorization' => $this->b->bostaakey]
                ]);
                $response = $client->post(
                    'https://api.bosta.co/api/v0/deliveries',

                    ['body' => $data]
                );
            }



            if ($order->shipment_id == 1) {

                $bostaa = array(

                    'request' => array(

                        'sender_address' => array(

                            "sender_name" => $order->customer_name,
                            "sender_mobile1" => "0532120000",
                            "sender_mobile2" => "",
                            "sender_country" => "SA",
                            "sender_city" => "Riyadh",
                            "sender_area" => "Alrimal",
                            "sender_street" => "",
                            "sender_additional" => "",
                            "sender_latitude" => "",
                            "sender_longitude" => ""

                        ),


                        'receiver_address' => array(

                            "receiver_name" => $order->customer_name,
                            "receiver_mobile1" => "0532120000",
                            "receiver_mobile2" => "",
                            "receiver_country" => "SA",
                            "receiver_city" => $order->customer_city,
                            "receiver_area" => $order->customer_address,
                            "receiver_street" => "",
                            "receiver_additional" => "",
                            "receiver_latitude" => "",
                            "receiver_longitude" => ""

                        ),



                        'shipment_data' => array(
                            "collect_cash_amount" => $order->pay_amount,
                            "number_of_pieces" => 1,
                            "reference" => "order-1234-123",
                            "mode" => "testing"
                        ),
                    ),
                );
                $d = $bostaa;
                $data = json_encode($d);
                $client = new Client([
                    'headers' => ['Content-Type' => 'application/json', 'fastlo-api-key' => $this->b->fastlookey]
                ]);

                $response = $client->post(
                    'https://fastlo.com/api/v1/add_shipment',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);

                $order = Order::findOrFail($id);
                $order['status'] = "processing";
                $order['company_fastlo_api'] = $m['output']['tracknumber'];

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }



            if ($order->shipment_id == 2) {

                $date = strtotime("+2 days 6 hours 5 seconds") * 1000;

                $aramex = array(

                    "ClientInfo" => array(

                        "UserName" => $this->b->aramexuser,
                        "Password" => $this->b->aramex_password,
                        "Version" => "v1",
                        "AccountNumber" => $this->b->accountnum,
                        "AccountPin" => "226321",
                        "AccountEntity" => "CAI",
                        "AccountCountryCode" => "EG",
                        "Source" => 24

                    ),



                    "LabelInfo" => null,

                    "Shipments" => array(


                        array(
                            "Reference1" => "",
                            "Reference2" => "",
                            "Reference3" => "",
                            "Shipper" => array(
                                "Reference1" => "",
                                "Reference2" => "",
                                "AccountNumber" => $this->b->accountnum,
                                "PartyAddress" => array(
                                    "Line1" => "test",
                                    "Line2" => "",
                                    "Line3" => "",
                                    "City" => "Duabi",
                                    "StateOrProvinceCode" => "",
                                    "PostCode" => "",
                                    "CountryCode" => "SA",
                                    "Longitude" => 0,
                                    "Latitude" => 0,
                                    "BuildingNumber" => null,
                                    "BuildingName" => null,
                                    "Floor" => null,
                                    "Apartment" => null,
                                    "POBox" => null,
                                    "Description" => null

                                ),

                                "Contact" => array(
                                    "Department" => "",
                                    "PersonName" => $order->customer_name,
                                    "Title" => "",
                                    "CompanyName" => "aramex",
                                    "PhoneNumber1" => $order->customer_phone,
                                    "PhoneNumber1Ext" => "",
                                    "PhoneNumber2" => "",
                                    "PhoneNumber2Ext" => "",
                                    "FaxNumber" => "",
                                    "CellPhone" => "9677956000200",
                                    "EmailAddress" => $order->customer_phone,
                                    "Type" => ""
                                ),
                            ),
                            "Consignee" => array(
                                "Reference1" => "",
                                "Reference2" => "",
                                "AccountNumber" => "",

                                "PartyAddress" => array(
                                    "Line1" => "Test",
                                    "Line2" => "",
                                    "Line3" => "",
                                    "City" => "Duabi",
                                    "StateOrProvinceCode" => "",
                                    "PostCode" => "",
                                    "CountryCode" => "AE",
                                    "Longitude" => 0,
                                    "Latitude" => 0,
                                    "BuildingNumber" => "",
                                    "BuildingName" => "",
                                    "Floor" => "",
                                    "Apartment" => "",
                                    "POBox" => null,
                                    "Description" => ""

                                ),

                                "Contact" => array(
                                    "Department" => "",
                                    "PersonName" => "aramex",
                                    "Title" => "",
                                    "CompanyName" => "aramex",
                                    "PhoneNumber1" => "009625515111",
                                    "PhoneNumber1Ext" => "",
                                    "PhoneNumber2" => "",
                                    "PhoneNumber2Ext" => "",
                                    "FaxNumber" => "",
                                    "CellPhone" => "9627956000200",
                                    "EmailAddress" => "test@test.com",
                                    "Type" => ""


                                ),
                            ),

                            "ThirdParty" => array(

                                "Reference1" => "",
                                "Reference2" => "",
                                "AccountNumber" => "",
                                "PartyAddress" => array(
                                    "Line1" => "",
                                    "Line2" => "",
                                    "Line3" => "",
                                    "City" => "",
                                    "StateOrProvinceCode" => "",
                                    "PostCode" => "",
                                    "CountryCode" => "",
                                    "Longitude" => 0,
                                    "Latitude" => 0,
                                    "BuildingNumber" => null,
                                    "BuildingName" => null,
                                    "Floor" => null,
                                    "Apartment" => null,
                                    "POBox" => null,
                                    "Description" => null


                                ),

                                "Contact" => array(
                                    "Department" => "",
                                    "PersonName" => "",
                                    "Title" => "",
                                    "CompanyName" => "",
                                    "PhoneNumber1" => "",
                                    "PhoneNumber1Ext" => "",
                                    "PhoneNumber2" => "",
                                    "PhoneNumber2Ext" => "",
                                    "FaxNumber" => "",
                                    "CellPhone" => "",
                                    "EmailAddress" => "",
                                    "Type" => ""
                                ),
                            ),

                            "ShippingDateTime" => "/Date($date)/",
                            "DueDate" => "/Date($date)/",
                            "Comments" => "",
                            "PickupLocation" => "",
                            "OperationsInstructions" => "",
                            "AccountingInstrcutions" => "",
                            "Details" => array(
                                "Dimensions" => null,
                                "ActualWeight" => array(
                                    "Unit" => "KG",
                                    "Value" => 0.5

                                ),
                                "ChargeableWeight" => null,
                                "DescriptionOfGoods" => "Books",
                                "GoodsOriginCountry" => "JO",
                                "NumberOfPieces" => 1,
                                "ProductGroup" => "EXP",
                                "ProductType" => "PDX",
                                "PaymentType" => "P",
                                "PaymentOptions" => "",
                                "CustomsValueAmount" => null,
                                "CashOnDeliveryAmount" => null,
                                "InsuranceAmount" => null,
                                "CashAdditionalAmount" => null,
                                "CashAdditionalAmountDescription" => "",
                                "CollectAmount" => null,
                                "Services" => "",
                                "Items" => array(),

                            ),

                            "Attachments" => array(),
                            "ForeignHAWB" => "",
                            "TransportType" => 0,
                            "PickupGUID" => "",
                            "Number" => null,
                            "ScheduledDelivery" => null

                        ),
                    ),

                    "Transaction" => array(
                        "Reference1" => "6",
                        "Reference2" => "",
                        "Reference3" => "",
                        "Reference4" => "",
                        "Reference5" => ""



                    ),

                );




                $d = $aramex;
                $data = json_encode($d);

                $client = new Client([

                    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']


                ]);

                $response = $client->post(
                    'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreateShipments',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);

                $order = Order::findOrFail($id);

                $order['status'] = "processing";

                $order['aramex_api_numbeer'] = $m['Shipments'][0]['ID'];

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }


            if ($order->shipment_id == 4) {

                $pieces = 3;

                $weightt = 1;

                $dimensions = "1X1X1";

                $password = md5($this->b->fedex_password);

                $security_key = $this->b->privatekey;

                $keyPart1 =  $pieces . $weightt . $dimensions;

                $keyPart2 = strrev(md5($security_key));

                $hashKey = trim(sha1($keyPart1 . $keyPart2));

                $client = new Client([]);

                $response = $client->post(
                    'http://api.egyptexpress.me/api/AWBcreate/',

                    [


                        'form_params' => [

                            "accountNo" => $this->b->fedexaccount,
                            "password" => $password,
                            "hashkey" => $hashKey,
                            "shipper_name" => "X COMPANY",
                            "shipper_phone" => "01234567891",
                            "shipper_city" => $c,
                            "shipper_address1" => "23 Abbas El Akad, 10th floor, apt 22",
                            "recipient_name" => $order->customer_name,
                            "recipient_phone" => $order->customer_phone,
                            "recipient_city" => $c,
                            "recipient_address1" => $order->customer_address,
                            "payment_method" => "COD",
                            "COD_amount" => $order->pay_amount,
                            "no_of_pieces" => $pieces,
                            "weight" => $weightt,
                            "dimensions" => "1X1X1",
                            "goods_origin_country" => "CHINA",
                            "product_group" => "test",
                            "product_type" => "Mobile phone cover",
                            "notes" => "tests"

                        ],
                    ]
                );

                $m = json_decode($response->getBody(), true);

                $order = Order::findOrFail($id);

                $order['serial'] = $m['SN'];

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }

            if ($order->shipment_id == 6) {

                $abs = array(

                    "FromCityID" => 13,
                    "FromAddress" => "Yasmine 1, Villa 222, Tagamo3 Awal",
                    "FromPhone" => "01233445566",
                    "FromContactPerson" => "Osama Anas",
                    "ToCityID" => $shipp_city,
                    "ToConsigneeName" => "Omar Ahmed",
                    "ToAddress" => $order->customer_address,
                    "ToPhone" => $order->customer_phone,
                    "ToMobile" => $order->customer_phone,
                    "ToRef" => "1234321",
                    "ToContactPerson" => "Osama",
                    "ProductID" => 1,
                    "COD" => 1234,


                );


                $d = $abs;
                $data = json_encode($d);
                $client = new Client([
                    'headers' => ['Content-Type' => 'application/json', 'AccessToken' => $this->tokenz]
                ]);

                $response = $client->post(
                    'http://api201.mpsegypt.com/DemoAPI/api/ClientUsers/SaveShipment',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);


                $order = Order::findOrFail($id);
                $order['Awb'] = $m[0]['AWB'];
                $order->update($input);
                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }



            if ($order->shipment_id == 7) {


                $orderss = Order::find($id);

                if ($orderss->customer_city == "Cairo") {

                    $ck = "Maadi";
                } elseif ($orderss->customer_city == "Giza") {


                    $ck = "Giza";
                } elseif ($orderss->customer_city == "Bani Sweif") {

                    $ck = "BENS";
                } elseif ($orderss->customer_city == "Damietta") {


                    $ck = "DAMT";
                } elseif ($orderss->customer_city == "Fayoum") {
                    $ck = "FAYM";
                } elseif ($orderss->customer_city == "Alexandria") {

                    $ck = "ALX";
                } elseif ($orderss->customer_city == "Qalyubia") {

                    $ck = "QLYB";
                } elseif ($orderss->customer_city == "Gharbeia") {


                    $ck = "GHRB";
                } elseif ($orderss->customer_city == "Sharkia") {

                    $ck = "SHRk";
                } elseif ($orderss->customer_city == "Monufia") {


                    $ck = "MONF";
                } elseif ($orderss->customer_city == "Dakahlia") {

                    $ck = "DAHK";
                } elseif ($orderss->customer_city  == "Minya") {

                    $kc = "MNYA";
                } elseif ($orderss->customer_city  == "Sohag") {

                    $ck = "SOHG";
                } elseif ($orderss->customer_city == "Ismailia") {

                    $ck = "ISML";
                } elseif ($orderss->customer_city  == "Luxor") {

                    $ck = "LUXR";
                } elseif ($orderss->customer_city == "Qena") {


                    $ck = "QENA";
                } elseif ($orderss->customer_city == "Suez") {


                    $ck = "SUEZ";
                } elseif ($orderss->customer_city == "Port Said") {


                    $ck = "PORS";
                } else {

                    $ck = "Nasr City";
                }


                $nowtimz = date("Y-m-d");

                $d = strtotime("+2 Days");


                $mylerz = array(
                    array(

                        "PickupDueDate" => date("Y-m-d", $d),
                        "Package_Serial" => 1,
                        "Reference" => "1000",
                        "Description" => "A package with  1 items be sure that be received",
                        "Total_Weight" => 0,
                        "Service_Type" => "DTD",
                        "Service" => "SD",
                        "Service_Category" => "Delivery",
                        "Payment_Type" => "COD",
                        "COD_Value" => round($order->pay_amount * $order->currency_value, 2),
                        "Customer_Name" => $order->customer_name,
                        "Mobile_No" => $order->customer_phone,
                        "Street" => $order->customer_address,
                        "Country" => "Egypt",
                        "Neighborhood" => $ck,

                        "Pieces" => array(

                            array(

                                "PieceNo" => 1,

                            )
                        )
                    ),

                );

                $d = $mylerz;
                $data = json_encode($d);

                $client = new Client([

                    'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer vRdyx_qITd2Qmi3NTGEoiuKntJenM3K9gRBqqtC12-PbrnCSchjvlwkmULWGUmoLJcR-nty70WWe5UqqOoFT0zLdv6aUghu2bf_Sqo1xwsWcN-P5--0AzjQ-SJEa0_guh_uPqXNQsbP01MYAFmHuwPSrdXLXdk9Lo6nOtNeIvJv2ZSVbZG_VthXQ91EMJCZ85Ywtb4kJdSHbHM4iT2dCfev21UDQ3Ver85fLuGupgAh4MbmtS33pfqeFC74O_w_BcpmDBxmHVyaj7rz-EhdXm9G2GABRyvAJZZ7peFsg6l1svJKBosNfs4t-xRnGxrxiNd1UbHBchkk5HFh3oZPYjLvSL9rGUC7E9Sr_wWwk68Jw6iXlgwpTHhajSZVGG2dDPyV2aEgyeWECxeH6lHa2qTTQ2A2ItnkZSnh426jtcEkGxcH0oOVVN8laeYw-uOwIqTs7DvcbJvMrx-o5PUiYriNK_lKK042ztLc5n8pmAattEBzYP2kolmr6eb1DV6HKbGBFiPmXwEHA3bZMC1dUcg']
                ]);

                $response = $client->post(
                    'http://41.33.122.61:58639/api/Orders/AddOrders',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);

                $order = Order::findOrFail($id);

                $order['barcod'] = $m['Value']['Packages'][0]['BarCode'];

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }

            $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

            Mail::to($gs->inventory_email)->send(new OrderEmail($order, $cart));
        }

        if ($input['status'] == "on delivery") {
            $t = time();

            if ($order->shipment_id == 2) {

                $date = strtotime("+2 days 6 hours 5 seconds") * 1000;


                $aramex = array(

                    "ClientInfo" => array(

                        "UserName" => $this->b->aramexuser,
                        "Password" => $this->b->aramex_password,
                        "Version" => "v1",
                        "AccountNumber" => $this->b->accountnum,
                        "AccountPin" => "226321",
                        "AccountEntity" => "CAI",
                        "AccountCountryCode" => "EG",
                        "Source" => 24


                    ),

                    "LabelInfo" => array(
                        "ReportID" => 9201,
                        "ReportType" => "URL"

                    ),
                    "Pickup" => array(
                        "PickupAddress" => array(
                            "Line1" => "Test",
                            "Line2" => "",
                            "Line3" => "",
                            "City" => "Amman",
                            "StateOrProvinceCode" => "",
                            "PostCode" => "",
                            "CountryCode" => "JO",
                            "Longitude" => 0,
                            "Latitude" => 0,
                            "BuildingNumber" => null,
                            "BuildingName" => null,
                            "Floor" => null,
                            "Apartment" => null,
                            "POBox" => null,
                            "Description" => null


                        ),
                        "PickupContact" => array(
                            "Department" => "",
                            "PersonName" => "test",
                            "Title" => "",
                            "CompanyName" => "test",
                            "PhoneNumber1" => "1111111111111",
                            "PhoneNumber1Ext" => "",
                            "PhoneNumber2" => "",
                            "PhoneNumber2Ext" => "",
                            "FaxNumber" => "",
                            "CellPhone" => "11111111111111",
                            "EmailAddress" => "test@test.com",
                            "Type" => ""

                        ),


                        "PickupLocation" => "test",
                        "PickupDate" => "/Date($date)/",
                        "ReadyTime" => "/Date($nowtimz)/",
                        "LastPickupTime" => "/Date($nowtimz)/",
                        "ClosingTime" => "/Date($nowtimz)/",
                        "Comments" => "",
                        "Reference1" => "001",
                        "Reference2" => "",
                        "Vehicle" => "",

                        "Shipments" => array(

                            "Reference1" => "",
                            "Reference2" => "",

                            array(
                                "Reference3" => "",
                                "Shipper" => array(
                                    "Reference1" => "",
                                    "Reference2" => "",
                                    "AccountNumber" => $this->b->accountnum,
                                    "PartyAddress" => array(
                                        "Line1" => $order->customer_address,
                                        "Line2" => "",
                                        "Line3" => "",
                                        "City" => "Duabi",
                                        "StateOrProvinceCode" => "",
                                        "PostCode" => "",
                                        "CountryCode" => "SA",
                                        "Longitude" => 0,
                                        "Latitude" => 0,
                                        "BuildingNumber" => null,
                                        "BuildingName" => null,
                                        "Floor" => null,
                                        "Apartment" => null,
                                        "POBox" => null,
                                        "Description" => null

                                    ),

                                    "Contact" => array(
                                        "Department" => "",
                                        "PersonName" => $order->customer_name,
                                        "Title" => "",
                                        "CompanyName" => "aramex",
                                        "PhoneNumber1" => $order->mobile,
                                        "PhoneNumber1Ext" => "",
                                        "PhoneNumber2" => "",
                                        "PhoneNumber2Ext" => "",
                                        "FaxNumber" => "",
                                        "CellPhone" => "9677956000200",
                                        "EmailAddress" => $order->customer_phone,
                                        "Type" => ""
                                    ),
                                ),
                                "Consignee" => array(

                                    "Reference1" => "",

                                    "Reference2" => "",

                                    "AccountNumber" => "",

                                    "PartyAddress" => array(
                                        "Line1" => "Test",
                                        "Line2" => "",
                                        "Line3" => "",
                                        "City" => "Duabi",
                                        "StateOrProvinceCode" => "",
                                        "PostCode" => "",
                                        "CountryCode" => "AE",
                                        "Longitude" => 0,
                                        "Latitude" => 0,
                                        "BuildingNumber" => "",
                                        "BuildingName" => "",
                                        "Floor" => "",
                                        "Apartment" => "",
                                        "POBox" => null,
                                        "Description" => ""

                                    ),

                                    "Contact" => array(
                                        "Department" => "",
                                        "PersonName" => "aramex",
                                        "Title" => "",
                                        "CompanyName" => "aramex",
                                        "PhoneNumber1" => "009625515111",
                                        "PhoneNumber1Ext" => "",
                                        "PhoneNumber2" => "",
                                        "PhoneNumber2Ext" => "",
                                        "FaxNumber" => "",
                                        "CellPhone" => "9627956000200",
                                        "EmailAddress" => "test@test.com",
                                        "Type" => ""


                                    ),
                                ),

                                "ThirdParty" => array(

                                    "Reference1" => "",
                                    "Reference2" => "",
                                    "AccountNumber" => "",
                                    "PartyAddress" => array(
                                        "Line1" => "",
                                        "Line2" => "",
                                        "Line3" => "",
                                        "City" => "",
                                        "StateOrProvinceCode" => "",
                                        "PostCode" => "",
                                        "CountryCode" => "",
                                        "Longitude" => 0,
                                        "Latitude" => 0,
                                        "BuildingNumber" => null,
                                        "BuildingName" => null,
                                        "Floor" => null,
                                        "Apartment" => null,
                                        "POBox" => null,
                                        "Description" => null

                                    ),

                                    "Contact" => array(
                                        "Department" => "",
                                        "PersonName" => "",
                                        "Title" => "",
                                        "CompanyName" => "",
                                        "PhoneNumber1" => "",
                                        "PhoneNumber1Ext" => "",
                                        "PhoneNumber2" => "",
                                        "PhoneNumber2Ext" => "",
                                        "FaxNumber" => "",
                                        "CellPhone" => "",
                                        "EmailAddress" => "",
                                        "Type" => ""
                                    ),
                                ),

                                "ShippingDateTime" => "/Date($nowtimz)/",
                                "DueDate" => "/Date($nowtimz)/",
                                "Comments" => "",
                                "PickupLocation" => "",
                                "OperationsInstructions" => "",
                                "AccountingInstrcutions" => "",
                                "Details" => array(
                                    "Dimensions" => null,
                                    "ActualWeight" => array(
                                        "Unit" => "KG",
                                        "Value" => 0.5

                                    ),
                                    "ChargeableWeight" => null,
                                    "DescriptionOfGoods" => "Books",
                                    "GoodsOriginCountry" => "JO",
                                    "NumberOfPieces" => 1,
                                    "ProductGroup" => "EXP",
                                    "ProductType" => "PDX",
                                    "PaymentType" => "P",
                                    "PaymentOptions" => "",
                                    "CustomsValueAmount" => null,
                                    "CashOnDeliveryAmount" => null,
                                    "InsuranceAmount" => null,
                                    "CashAdditionalAmount" => null,
                                    "CashAdditionalAmountDescription" => "",
                                    "CollectAmount" => null,
                                    "Services" => "",
                                    "Items" => array(),

                                ),

                                "Attachments" => array(),
                                "ForeignHAWB" => "",
                                "TransportType" => 0,
                                "PickupGUID" => "",
                                "Number" => null,
                                "ScheduledDelivery" => null

                            ),
                        ),


                        "PickupItems" => array(

                            array(

                                "ProductGroup" => "EXP",
                                "ProductType" => "PDX",
                                "NumberOfShipments" => 1,
                                "PackageType" => "Box",
                                "Payment" => "P",
                                "ShipmentWeight" => array(
                                    "Unit" => "KG",
                                    "Value" => 0.5
                                ),
                                "ShipmentVolume" => null,
                                "NumberOfPieces" => 1,
                                "CashAmount" => null,
                                "ExtraCharges" => null,
                                "ShipmentDimensions" => array(
                                    "Length" => 0,
                                    "Width" => 0,
                                    "Height" => 0,
                                    "Unit" => ""
                                ),
                                "Comments" => "Test"

                            ),

                        ),


                        "Status" => "Ready",
                        "ExistingShipments" => null,
                        "Branch" => "",
                        "RouteCode" => ""

                    ),


                    "Transaction" => array(
                        "Reference1" => "6",
                        "Reference2" => "",
                        "Reference3" => "",
                        "Reference4" => "",
                        "Reference5" => ""

                    ),
                );


                $d = $aramex;
                $data = json_encode($d);

                $client = new Client([

                    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']


                ]);

                $response = $client->post(
                    'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CreatePickup',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);
                $order = Order::findOrFail($id);
                $order['status'] = "on delivery";
                $order['id_api_aramex'] = $m['ProcessedPickup']['GUID'];
                $order['pickuptrack_api'] = $m['ProcessedPickup']['ID'];
                $order->update($input);
                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));



                return view('admin.order.details', compact('m', 'order', 'cart'));
            }
            if ($order->shipment_id == 4) {

                $pieces = 1;

                $weightt = 1;

                $dimensions = "1X1X1";

                $password = md5($this->b->fedex_password);

                $security_key = $this->b->privatekey;

                $pKey = $weightt . $pieces;

                $security_key_encrypt = strrev(md5($security_key));

                $hashKey = trim(sha1($pKey . $security_key_encrypt));



                $client = new Client([]);

                $response = $client->post(
                    'http://api.egyptexpress.me/api/pickup/',

                    [
                        'form_params' => [

                            "accountNo" => $this->b->fedexaccount,
                            "password" => $password,
                            "hashkey" => $hashKey,
                            "date" => date("d/m/Y", $t),
                            "timeFrom" => "12:00",
                            "timeTo" => "18:00",
                            "product" => "DOX",
                            "service" => "COD",
                            "originCity" => $c,
                            "destinationCity" => $c,
                            "shipperContact" => $order->customer_address,
                            "shipperMobile" => "01234567891",
                            "shipperAddress1" => $order->customer_address,
                            "shipperCity" => "CAI",
                            "landMark" => "uui",
                            "pickupLocation" => "1X1X1",
                            "consigneeContact" => "CHINA",
                            "consigneeMobile" => $order->customer_phone,
                            "consigneeAddress1" => "COD",
                            "consigneeCity" => $c,
                            "noPieces" => $pieces,
                            "weight" => $weightt,



                        ],
                    ]
                );



                $m = json_decode($response->getBody(), true);


                $order = Order::findOrFail($id);
                $order['status'] = "on delivery";
                $order['fedex_pic_api'] = $m['pickupID'];

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));


                return view('admin.order.details', compact('m', 'order', 'cart'));
            }



            if ($order->shipment_id == 6) {

                $abs = array(

                    "NumberOfAWBs" => 1,
                    "PickupAddress" => $order->customer_address,
                    "Phone" => $order->customer_phone,
                    "ContactPerson" => "Ahmed Aly",
                    "PickupDate" => "2020-02-01",
                    "ProductID" => 1,
                    "CityID" => $shipp_city,
                    "Notes" => "Please call me before pickup",


                );

                $d = $abs;
                $data = json_encode($d);
                $client = new Client([
                    'headers' => ['Content-Type' => 'application/json', 'AccessToken' => $this->tokenz]
                ]);

                $response = $client->post(
                    'http://api201.mpsegypt.com/DemoAPI/api/ClientUsers/SavePickup',

                    ['body' => $data]

                );

                $m = json_decode($response->getBody(), true);

                $order = Order::findOrFail($id);

                $order['pickup_id'] = $m;

                $order->update($input);

                $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

                return view('admin.order.details', compact('m', 'order', 'cart'));
            }
        }

        if ($order->status == "completed") {

            $input['status'] = "completed";

            $order->update($input);

            \Session::flash('flash_message', 'Adding continents not complete, Try agin later '); //<--FLASH MESSAGE

            return  redirect()->back();
        } else {
            if ($input['status'] == "completed") {

                if ($order->method === 'Tabby') {
                    $gs = Generalsetting::findOrFail(1);
                    $secretKey = $gs->tabby_secret;

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $secretKey,
                    ])->post("https://api.tabby.ai/api/v1/payments/{$order->txnid}/captures", [
                        "amount" => $order->pay_amount,
                    ]);

                    if ($response->successful()) {
                        $input['payment_status'] = 'Completed';
                    } else if ($response->failed()) {
                        Log::error($response->body());
                    }
                }

                foreach ($data->vendororders as $vorder) {
                    $uprice = User::findOrFail($vorder->user_id);
                    $uprice->current_balance = $uprice->current_balance + $vorder->price;
                    $uprice->update();
                }

                $gs = Generalsetting::findOrFail(1);
                if ($gs->is_smtp == 1) {
                    $maildata = [
                        'to' => $data->customer_phone,
                        'subject' => 'Your order ' . $data->order_number . ' is Confirmed!',
                        'body' => "Hello " . $data->customer_name . "," . "\n Thank you for shopping with us. We are looking forward to your next visit.",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);
                } else {
                    $to = $data->customer_phone;
                    $subject = 'Your order ' . $data->order_number . ' is Confirmed!';
                    $msg = "Hello " . $data->customer_name . "," . "\n Thank you for shopping with us. We are looking forward to your next visit.";
                    $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                    mail($to, $subject, $msg, $headers);
                }

                /* old code
                        
                        $user = User::where('id',$order->affilate_user_id)->first();
                        $user->affilate_income += $order->affilate_charge;
                        $user->update();
                    */

                // new code
                if (!empty($order->affilate_user_id)) {
                    $user = User::where('id', $order->affilate_user_id)->first();
                    $user->affilate_income += $order->affilate_charge;
                    $user->update();
                }
            }
            if ($input['status'] == "declined") {
                $gs = Generalsetting::findOrFail(1);
                if ($gs->is_smtp == 1) {
                    $maildata = [
                        'to' => $data->customer_phone,
                        'subject' => 'Your order ' . $data->order_number . ' is Declined!',
                        'body' => "Hello " . $data->customer_name . "," . "\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($maildata);
                } else {
                    $to = $data->customer_phone;
                    $subject = 'Your order ' . $data->order_number . ' is Declined!';
                    $msg = "Hello " . $data->customer_name . "," . "\n We are sorry for the inconvenience caused. We are looking forward to your next visit.";
                    $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
                    mail($to, $subject, $msg, $headers);
                }
            }

            // dd($input);

            $order->update($input);
            if ($request->status) {

                $title = ucwords($request->status);
                $ck = OrderTrack::where('order_id', '=', $id)->where('title', '=', $title)->first();
                if ($ck) {
                    $ck->order_id = $id;
                    $ck->title = $title;
                    $ck->text = $request->track_text;
                    $ck->update();
                } else {
                    $data = new OrderTrack;
                    $data->order_id = $id;
                    $data->title = $title;
                    $data->text = $request->track_text;
                    $data->save();
                }
            }

            $order = VendorOrder::where('order_id', '=', $id)->update(['status' => $input['status']]);

            \Session::flash('flash_message', 'Updated Successfully');

            return  redirect()->back();
        }





        \Session::flash('flash_message', 'Updated Successfully');

        return  redirect()->back();
    }



    public function createShipmentMethod() {}

    public function pending()
    {
        return view('admin.order.pending');
    }
    public function processing()
    {
        return view('admin.order.processing');
    }
    public function completed()
    {
        return view('admin.order.completed');
    }
    public function declined()
    {
        return view('admin.order.declined');
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $lang = $this->getLang();
        return view('admin.order.details', compact('order', 'cart', 'lang'));
    }

    public function updateField(Request $request, $orderId)
    {
        $request->validate([
            'field' => 'required|in:customer_address,order_note,shipping_address',
            'value' => 'nullable|string|max:1000'
        ]);

        try {
            $order = Order::findOrFail($orderId);

            $field = $request->input('field');
            $value = $request->input('value');

            $order->update([$field => $value]);

            return response()->json([
                'success' => true,
                'message' => __('Field updated successfully')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('Error updating field: ') . $e->getMessage()
            ], 500);
        }
    }
    public function getLang()
    {
        $sessionLanguage = session()->get('language');
        $defualtLanguage  = DB::table('languages')->where('is_default', '=', 1)->first();

        if ($sessionLanguage)
            return ($sessionLanguage == 1) ? 'en' : 'ar';
        else
            return ($defualtLanguage->id == 2) ? 'ar' : 'en';
    }

    public function invoice($id)
    {

        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.invoice', compact('order', 'cart'));
    }
    public function emailsub(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        if ($gs->is_smtp == 1) {
            $data = 0;
            $datas = [
                'to' => $request->to,
                'subject' => $request->subject,
                'body' => $request->message,
            ];

            $mailer = new GeniusMailer();
            $mail = $mailer->sendCustomMail($datas);
            if ($mail) {
                $data = 1;
            }
        } else {
            $data = 0;
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $mail = mail($request->to, $request->subject, $request->message, $headers);
            if ($mail) {
                $data = 1;
            }
        }

        return response()->json($data);
    }

    public function printpage($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.print', compact('order', 'cart'));
    }

    public function license(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();
        $msg = 'Successfully Changed The License Key.';
        return response()->json($msg);
    }

    public function status($id, $status)
    {
        $mainorder = Order::findOrFail($id);
    }


    public function fastlos_api_delete($fastlig)
    {

        $bostaa = array();

        $bostaa['request'] = array(

            "tracknumber" => $fastlig
        );

        $d = $bostaa;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'fastlo-api-key' => $this->b->fastlookey]

        ]);

        $response = $client->post(
            'https://fastlo.com/api/v1/can_cancel_shipment',

            ['body' => $data]

        );

        \Session::flash('flash_message', 'canceled api succesfully');

        return view('admin.order.fastlo_cancel_api');
    }



    public function   aramex_delete_pickupz($h)
    {

        $aramex = array(

            "ClientInfo" => array(

                "UserName" => "reem@reem.com",
                "Password" => "123456789",
                "Version" => "v1",
                "AccountNumber" => "20016",
                "AccountPin" => "331421",
                "AccountEntity" => "AMM",
                "AccountCountryCode" => "JO",
                "Source" => 24

            ),

            "Comments" => "Test",
            "PickupGUI" => $h,

            "Transaction" => array(
                "Reference1" => "6",
                "Reference2" => "",
                "Reference3" => "",
                "Reference4" => "",
                "Reference5" => ""

            ),
        );



        $d = $aramex;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']

        ]);

        $response = $client->post(
            'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc/json/CancelPickup',

            ['body' => $data]
        );
        \Session::flash('flash_message', 'canceled api succefully');

        return view('admin.order.aramex_api_cancel');
    }

    public function fastlo_show($numbers)
    {

        $j = array(

            'request' => array(

                "tracknumber" => $numbers


            ),
        );


        $d = $j;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'fastlo-api-key' => $this->b->fastlookey]
        ]);

        $response = $client->post(
            'https://fastlo.com/api/v1/read_shipment',

            ['body' => $data]
        );

        $m = json_decode($response->getBody(), true);

        return view('admin.order.fastlo_api_show', compact('m'));
    }

    public function   aramex($o)
    {


        $aramex = array(

            "ClientInfo" => array(

                "UserName" => "reem@reem.com",
                "Password" => "123456789",
                "Version" => "v1",
                "AccountNumber" => "20016",
                "AccountPin" => "331421",
                "AccountEntity" => "AMM",
                "AccountCountryCode" => "JO",
                "Source" => 24
            ),

            "GetLastTrackingUpdateOnly" => false,
            "Shipments" => array(
                "$o"

            ),
            "Transaction" => array(
                "Reference1" => "",
                "Reference2" => "",
                "Reference3" => "",
                "Reference4" => "",
                "Reference5" => "",
            ),
        );



        $d = $aramex;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $response = $client->post(
            'https://ws.dev.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackShipments',

            ['body' => $data]

        );

        $m = json_decode($response->getBody(), true);

        return view('admin.order.arameex_api_show', compact('m'));
    }

    public function  aramex_traack($i)
    {


        $aramex = array(

            "ClientInfo" => array(
                "UserName" => "reem@reem.com",
                "Password" => "123456789",
                "Version" => "v1",
                "AccountNumber" => "20016",
                "AccountPin" => "331421",
                "AccountEntity" => "AMM",
                "AccountCountryCode" => "JO",
                "Source" => 24
            ),

            "Reference" => $i,
            "Transaction" => array(
                "Reference1" => "",
                "Reference2" => "",
                "Reference3" => "",
                "Reference4" => "",
                "Reference5" => "",
            ),
        );



        $d = $aramex;
        $data = json_encode($d);
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json']
        ]);

        $response = $client->post(
            'https://ws.dev.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc/json/TrackPickup',

            ['body' => $data]

        );

        $m = json_decode($response->getBody(), true);

        return view('admin.order.aramex_traack', compact('m'));
    }



    public function  fedexx($id)
    {


        $password = md5($this->b->fedex_password);
        $security_key = "$this->b->privatekey";
        $keyEncrypted = strrev(md5($security_key));
        $hashKey = trim(sha1($keyEncrypted));


        $client = new Client([]);

        $response = $client->post(
            'http://api.egyptexpress.me/api/AWBstatus',

            [
                'form_params' => [
                    "accountNo" => $this->b->fedexaccount,
                    "password" => $password,
                    "hashkey" => $hashKey,
                    "SN[]" => $id

                ],
            ]
        );


        $m = json_decode($response->getBody(), true);

        return view('admin.order.fedex_api_show', compact('m'));
    }




    public function   fedex_Pdf($id)
    {

        $password = md5('DtH@A!t10pos2n1');

        $security_key = "HAdhn1k!onDFG";

        $keyEncrypted = strrev(md5($security_key));

        $hash = trim(sha1($id . $keyEncrypted));


        $client = new Client([]);

        $response = $client->post(
            'http://api.egyptexpress.me/api/AWBhtml/',

            [
                'form_params' => [
                    "accountNo" => 37,
                    "password" => $password,
                    "SN" => $id,
                    "hashkey" => $hash

                ],
            ]
        );


        $m = json_decode($response->getBody(), true);

        dd($m);

        return view('admin.order.fedex_traack', compact('m', 'order', 'cart'));
    }


    public function getapi()
    {

        $client = new Client([

            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $this->b->bostaakey]

        ]);

        $response = $client->get('https://api.bosta.co/api/v0/deliveries');

        $theresult = json_decode($response->getBody(), true);

        return view('admin.order.api_bosta', compact('theresult'));
    }



    public function showbosta($id)
    {

        $client = new Client([

            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $this->b->bostaakey]


        ]);

        $response = $client->get('https://api.bosta.co/api/v0/deliveries/' . $id);
        $theresult = json_decode($response->getBody(), true);

        return view('admin.order.show', compact('theresult'));
    }

    public function deleteapiss($id)
    {

        $client = new Client([

            'headers' => ['Content-Type' => 'application/json', 'Authorization' => $this->b->bostaakey]

        ]);

        $response = $client->delete('https://api.bosta.co/api/v0/deliveries/' . $id);
        return redirect()->back();
    }
    //*** POST Request
    public function import()
    {


        return view('admin.order.ordercsv');
    }

    public function importSubmit(Request $request)
    {
        $log = "";
        //--- Validation Section
        $rules = [
            'csvfile'      => 'required|mimes:csv,txt',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $filename = '';
        if ($file = $request->file('csvfile')) {
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move('assets/temp_files', $filename);
        }

        //$filename = $request->file('csvfile')->getClientOriginalName();
        //return response()->json($filename);
        $datas = "";

        $file = fopen(public_path('assets/temp_files/' . $filename), "r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {

            if ($i == 1) {

                if (!Order::where('order_number', $line[0])->exists()) {

                    //--- Validation Section Ends

                    //--- Logic Section
                    $data = new Order;



                    $input['order_number'] = $line[0];
                    $input['cart'] = $line[1];
                    $input['pay_amount'] = !empty($line[2]) ? $line[2] : 0;
                    $input['currency_sign'] = !empty($line[3]) ? $line[3] : null;

                    $input['totalQty'] = !empty($line[4]) ? $line[4] : null;
                    $input['payment_status'] = !empty($line[5]) ? $line[5] : "Pending";
                    $input['method'] = !empty($line[6]) ? $line[6] : null;

                    $input['shipping'] = !empty($line[7]) ? $line[7] : null;
                    $input['user_id'] = !empty($line[8]) ? $line[8] : null;


                    /*   
             
                $mcat = User::where(DB::raw('lower(name)'), strtolower($line[8]));
                //$mcat = Category::where("name", $line[1]);

                if($mcat->exists()){
                    $input['user_id'] = $mcat->first()->id;
                }else{
                    $input['user_id'] = 0;
                }   */


                    $input['customer_name'] =  !empty($line[9]) ? $line[9] : null;
                    $input['customer_email'] =  !empty($line[10]) ? $line[10] : null;
                    $input['customer_phone'] =  !empty($line[11]) ? $line[11] : null;
                    $input['customer_country'] =  !empty($line[12]) ? $line[12] : "Egypt";
                    $input['customer_city'] =  !empty($line[13]) ? $line[13] : null;
                    $input['customer_address'] =  !empty($line[14]) ? $line[14] : null;
                    $input['status'] =  !empty($line[15]) ? $line[15] : "Pending";
                    $input['shipment_id'] =  !empty($line[16]) ? $line[16] : null;
                    $input['order_completed'] =  1;

                    /*    $input['shipment_id'] = null;
                
                 if($line[16] != ""){
                        $scat = Shipment::where(DB::raw('lower(name)'), strtolower($line[16]));

                        if($scat->exists()) {
                            $input['shipment_id'] = $scat->first()->id;
                        }
                    }
              */

                    $input['shipping_price'] =  !empty($line[17]) ? $line[17] : 0;
                    $input['shipping_tax'] =  !empty($line[18]) ? $line[18] : 0;

                    // Save Data
                    $data->fill($input)->save();
                } else {
                    $log .= "<br>Row No: " . $i . " - Duplicate Order Number!<br>";
                }
            }

            $i++;
        }
        fclose($file);


        //--- Redirect Section
        $msg = 'Bulk Order File Imported Successfully.<a href="' . route('admin-order-index') . '">View Order Lists.</a>' . $log;
        return response()->json($msg);
    }

    public function imports()
    {
        Excel::import(new OrdersImport, request()->file('csvfile'));

        return  redirect()->back();
    }

    public function reportsform(Request $request)
    {

        return view('admin.order.report_form');
    }

    public function reports(Request $request)
    {

        $query = Order::where('status', '=', 'completed')->where('order_completed', 1)->orderBy('id', 'desc');

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $start = $request->start_date;
            $end =  $request->end_date;
            $query->where('created_at', '>=', $start)
                ->where('created_at', '<=', $end);
        }
        $order = $query->get();
        /*     
            return Datatables::of($products)
                        ->editColumn('id', function(Order $data) {
                                $id = '<a href="'.route('admin-order-invoice',$data->id).'">'.$data->order_number.'</a>';
                                return $id;
                            })->editColumn('user_id', function(Order $data) {
                                $user = User::find($data->user_id);
                                if($user){
                                $id = '<a href="'.route('admin-user-show',$data->user_id).'">'.$user->name.'</a>';
                                }else{
                                   $id = 'User Deleted'; 
                                }
                                return $id;
                            })
                            ->editColumn('pay_amount', function(Order $data) {
                                
                                
                                
                                return  '<span class="display_currency final-total" data-currency_symbol="true" data-orig-value="{{round($data->pay_amount * $data->currency_value , 2)}}">{{$data->currency_sign }} {{round($data->pay_amount * $data->currency_value , 2)}}</span>';
                                
                                
                                
                                
                            })
                            ->addColumn('action', function(Order $data) {
                                $orders = '<a href="javascript:;" data-href="'. route('admin-order-edit',$data->id) .'" class="delivery" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-dollar-sign"></i> Delivery Status</a>';
                                return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-order-show',$data->id) . '" > <i class="fas fa-eye"></i> Details</a><a href="javascript:;" class="send" data-email="'. $data->customer_phone .'" data-bs-toggle="modal" data-bs-target="#vendorform"><i class="fas fa-envelope"></i> Send</a><a href="javascript:;" data-href="'. route('admin-order-track',$data->id) .'" class="track" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-truck"></i> Track Order</a>'.$orders.'</div></div>';
                            }) 
                ->rawColumns(['action', 'id', 'user_id', 'pay_amount'])
                ->make(true);
                */


        $total = $query->get()->sum('pay_amount');

        return view('admin.order.report', compact('order', 'total'));
    }




    public function delete($id)
    {

        $data = Order::findOrFail($id);

        $data->delete();
        //--- Redirect Section
        $msg = "Order Delete Successfully";
        return response()->json([
            'status' => true,
            'msg'   =>  $msg
        ], 200);


        //--- Redirect Section Ends

        // PRODUCT DELETE ENDS
    }
}
