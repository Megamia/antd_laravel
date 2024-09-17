<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\DetailProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\VoucherCodeValue;
use App\Models\VoucherPromotionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrderWithoutValue($idAddress, $idVoucherCode = null)
    {
        try {
            $orderData = [
                'idAddress' => $idAddress,
            ];

            if ($idVoucherCode !== null) {
                $orderData['idVoucherCode'] = $idVoucherCode;
            }

            $createOrderWithoutValue = Order::create($orderData);
            $orderId = $createOrderWithoutValue->id;

            return response()->json([
                'status' => 1,
                'createOrderWithoutValue'=>$createOrderWithoutValue,
                'orderId' => $orderId,
                'Message' => 'Order created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'Message' => 'Failed to create order without value',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function createVoucher($idOrder, $idVoucherPromotions = null)
    {

        $createVouchers = [];
        $failedVoucher = [];

        if (!$idOrder) {
            return response()->json([
                'status' => 0,
                'message' => 'ID đơn hàng không hợp lệ'
            ], 400);
        }

        if (empty($idVoucherPromotions)) {
            try {
                $createVoucher = Voucher::create([
                    'idOrder' => $idOrder,
                    'idVoucherPromotionValue' => null,
                ]);
                $createVouchers[] = $createVoucher;
            } catch (\Exception $e) {
                $failedVoucher[] = ['error' => $e->getMessage()];
            }
        } else {
            foreach ($idVoucherPromotions as $idVoucherPromotion) {
                try {
                    $createVoucher = Voucher::create([
                        'idOrder' => $idOrder,
                        'idVoucherPromotionValue' => $idVoucherPromotion,
                    ]);
                    $createVouchers[] = $createVoucher;
                } catch (\Exception $e) {
                    $failedVoucher[] = [
                        'idVoucherPromotion' => $idVoucherPromotion,
                        'error' => $e->getMessage()
                    ];
                }
            }
        }

        if (count($failedVoucher) > 0) {
            return response()->json([
                'status' => 0,
                'message' => 'Một số voucher không thể được tạo',
                'failedVoucher' => $failedVoucher
            ], 500);
        }

        return response()->json([
            'status' => 1,
            'createVoucher' => $createVouchers,
            'message' => 'Voucher đã được tạo thành công'
        ]);
    }

    public function createDetailOrderWithoutValue($orderId)
    {

        if (!$orderId) {
            return response()->json(['status' => 0, 'createDetailOrderWithoutValue' => 'Invalid idOrder']);
        }

        $createDetailOrderWithoutValue = DetailOrder::create([
            'idOrder' => $orderId,
            'timeCreateOrder' => Carbon::now(),
        ]);
        $idDetailOrder = $createDetailOrderWithoutValue->id;

        return response()->json(['status' => 1, 'idDetailOrder' => $idDetailOrder, 'createDetailOrderWithoutValue' => $createDetailOrderWithoutValue]);
    }

    public function createProduct($dataProduct, $idDetailOrder)
    {
        if (!is_array($dataProduct) || empty($idDetailOrder)) {
            return response()->json(['status' => 0, 'error' => 'Invalid input']);
        }

        $createProducts = [];
        $productIds = [];
        foreach ($dataProduct as $data) {
            if (!isset($data['id']) || !isset($data['selectedQuantity'])) {
                return response()->json(['status' => 0, 'error' => 'Invalid dataProduct format']);
            }

            $createProduct = Product::create([
                'idDetailOrder' => $idDetailOrder,
                'idDetailProduct' => $data['id'],
                'numberSelected' => $data['selectedQuantity'] ?? 1,
            ]);
            $productIds[] = $createProduct->id;
            $createProducts[] = $createProduct;
        }

        return response()->json([
            'status' => 1,
            'createProduct' => $createProducts,
            'productIds' => $productIds
        ]);
    }

    public function createDetailOrderWithValue($idProduct, $valueSale)
    {
        if (isset($idProduct) && is_array($idProduct)) {
            $idDetailProducts = Product::whereIn('id', $idProduct)->pluck('idDetailProduct');
            $idDetailOrders = Product::whereIn('id', $idProduct)->pluck('idDetailOrder')->unique();

            $prices = DetailProduct::whereIn('id', $idDetailProducts)->pluck('price');
            $quantities = Product::whereIn('idDetailProduct', $idDetailProducts)
                ->where('idDetailorder', $idDetailOrders)
                ->pluck('numberSelected');
            $priceAllProduct = 0;
            $priceAfterSale = 0;
            foreach ($prices as $index => $price) {
                $price = str_replace([',', '.'], '', $price);
                $price = (float) $price;

                $quantity = $quantities[$index];
                $quantity = (int) $quantity;

                if (is_numeric($price) && is_numeric($quantity)) {
                    $priceAllProduct += $price * $quantity;
                    $priceAfterSale = $priceAllProduct - $valueSale;
                } else {
                    return response()->json(['status' => 0, 'message' => 'Invalid price or quantity value']);
                }
            }

            $formattedPrice = number_format($priceAfterSale, 2, '.', ',');

            $updatedRows = DetailOrder::whereIn('id', $idDetailOrders)
                ->update(['price' => $formattedPrice]);

            $createDetailOrderWithValue = DetailOrder::whereIn('id', $idDetailOrders)->get();

            if ($updatedRows) {
                return response()->json([
                    'status' => 1,
                    'createDetailOrderWithValue' => $createDetailOrderWithValue,
                    'priceAllProduct' => $priceAllProduct,
                    'priceAfterSale' => $priceAfterSale,
                    'prices' => $prices,
                    'quantities' => $quantities
                ]);
            } else {
                return response()->json(['status' => 0, 'message' => 'Failed to update detail orders']);
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'Invalid idProduct']);
        }
    }
    public function createOrderWithValue($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        $idVoucherCodeFromOrder = $order ? $order->idVoucherCode : null;

        $valueVoucherCode = 0;
        if ($idVoucherCodeFromOrder) {
            $valueCode = VoucherCodeValue::where('id', $idVoucherCodeFromOrder)->value('value');
            if ($valueCode) {
                $cleanedValueVoucherCode = str_replace([',', '.'], '', $valueCode);
                $valueVoucherCode = (float) $cleanedValueVoucherCode;
            }
        }

        $voucherPromotions = Voucher::where('idOrder', $orderId)
            ->pluck('idVoucherPromotionValue');

        $sumValueVoucherPromotion = VoucherPromotionValue::whereIn('id', $voucherPromotions)
            ->pluck('value')
            ->map(function ($valuePromotion) {
                $cleanedValueVoucherPromotion = str_replace([',', '.'], '', $valuePromotion);
                return (float) $cleanedValueVoucherPromotion;
            })
            ->sum();

        $priceDetailOrder = DetailOrder::where('idOrder', $orderId)->value('price');
        $totalVoucherValue = $valueVoucherCode + $sumValueVoucherPromotion;
        $updatedRows = Order::where('id', $orderId)
            ->update([
                'valueVoucher' => $totalVoucherValue,
                'valueOrder' => $priceDetailOrder
            ]);
        $createOrderWithValue = Order::find($orderId);
        if ($updatedRows > 0) {
            return response()->json([
                'status' => 1,
                'createOrderWithValue' => $createOrderWithValue,
                'totalVoucherValue' => $totalVoucherValue,
                'message' => 'Tính toán thành công'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'totalVoucherValue' => $totalVoucherValue,
                'message' => 'Tính toán thất bại'
            ]);
        }
    }

    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'idAddress' => 'required|exists:Address,id',
            'idVoucherCode' => 'nullable|exists:VoucherCodeValue,id',
            'idVoucherPromotionValue' => 'nullable|array',
            'idVoucherPromotionValue.*' => 'exists:VoucherPromotionValue,id',
            'dataProduct' => 'required|array',
            'dataProduct*.id' => 'required|integer|exists:Product,id',
            'dataProduct*.selectedQuantity' => 'required|integer|min:1',
            'idDetailProduct' => 'required|exists:DetailProduct,id',
            'valueSale' => 'nullable|integer',
        ]);

        $idAddress = $validated['idAddress'];
        $idVoucherCode = $validated['idVoucherCode'] ?? null;
        $idVoucherPromotions = $validated['idVoucherPromotionValue'] ?? [];
        $dataProduct = $validated['dataProduct'];
        $idDetailProduct = $validated['idDetailProduct'];
        $valueSale = $validated['valueSale'];

        DB::beginTransaction();

        try {
            $createOrderWithoutValueResponse = $this->createOrderWithoutValue($idAddress, $idVoucherCode);
            $createOrderWithoutValueData = json_decode($createOrderWithoutValueResponse->getContent(), true);

            if ($createOrderWithoutValueData['status'] === 1) {
                $orderId = $createOrderWithoutValueData['orderId'];

                $createVoucherResponse = $this->createVoucher($orderId, $idVoucherPromotions);
                $createVoucherData = json_decode($createVoucherResponse->getContent(), true);

                if ($createVoucherData['status'] === 1) {
                    $createDetailOrderWithoutValueResponse = $this->createDetailOrderWithoutValue($orderId);
                    $createDetailOrderWithoutValueData = json_decode($createDetailOrderWithoutValueResponse->getContent(), true);
                    if ($createDetailOrderWithoutValueData['status'] === 1) {
                        $idDetailOrder = $createDetailOrderWithoutValueData['idDetailOrder'];
                        $createProductResponse = $this->createProduct($dataProduct, $idDetailOrder);
                        $createProductData = json_decode($createProductResponse->getContent(), true);

                        if ($createProductData['status'] === 1) {
                            $idProduct = $createProductData['productIds'];
                            $createDetailOrderWithValueResponse = $this->createDetailOrderWithValue($idProduct, $valueSale);
                            $detailOrderWithValueData = json_decode($createDetailOrderWithValueResponse->getContent(), true);

                            if ($detailOrderWithValueData['status'] === 1) {
                                $createOrderWithValueResponse = $this->createOrderWithValue($orderId);
                                $createOrderWithValueData = json_decode($createOrderWithValueResponse->getContent(), true);

                                if ($createOrderWithValueData['status'] === 1) {
                                    DB::commit();
                                    return response()->json([
                                        'status' => 1,
                                        'order' => $createOrderWithoutValueData['createOrderWithoutValue'],
                                        'voucher' => $createVoucherData['createVoucher'],
                                        'detailOrderWithoutValue' => $createDetailOrderWithoutValueData['createDetailOrderWithoutValue'],
                                        'productData' => $createProductData['createProduct'],
                                        'detailOrderWithValueData' => $detailOrderWithValueData['createDetailOrderWithValue'],
                                        'createOrderWithValueData' => $createOrderWithValueData['createOrderWithValue'],
                                        'Message' => 'Order created successfully'
                                    ]);
                                } else {
                                    DB::rollBack();
                                    return response()->json(['status' => 0, 'Message' => 'createOrderWithValue faile']);
                                }
                            } else {
                                DB::rollBack();
                                return response()->json(['status' => 0, 'Message' => 'createDetailOrderWithValue faile']);
                            }
                        } else {
                            DB::rollBack();
                            return response()->json(['status' => 0, 'Message' => 'createProduct faile']);
                        }
                    } else {
                        DB::rollBack();
                        return response()->json(['status' => 0, 'Message' => 'createDetailorder faile']);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['status' => 0, 'Message' => 'createVoucher faile']);
                }
            } else {
                DB::rollBack();
                return response()->json([
                    'status' => 0,
                    'message' => 'Failed to create order'
                ], 500);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 0,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
