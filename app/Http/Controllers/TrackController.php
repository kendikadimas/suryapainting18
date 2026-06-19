<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class TrackController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $query = trim($request->input('order_code'));

        if (empty($query)) {
            return response()->json([
                'success' => false,
                'message' => 'Masukkan nomor surat atau nomor HP terlebih dahulu.'
            ], 400);
        }

        $order = Order::with(['timeline' => function($q) {
            $q->orderBy('created_at', 'asc');
        }])->where(function($q) use ($query) {
            $q->where('nomor_surat', 'LIKE', $query)
              ->orWhere('customer_phone', 'LIKE', $query);
        })->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan. Periksa kembali nomor surat atau nomor HP Anda.'
            ], 404);
        }

        // Hide sensitive fields from public response
        $order->makeHidden(['customer_phone']);

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }
}
