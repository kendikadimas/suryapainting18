<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;

class TrackController extends Controller
{
    // Render public landing page
    public function index()
    {
        return view('welcome');
    }

    // Search and return order progress timeline (AJAX)
    public function search(Request $request)
    {
        $code = trim($request->input('order_code'));
        
        if (empty($code)) {
            return response()->json([
                'success' => false,
                'message' => 'Masukkan kode pesanan terlebih dahulu.'
            ], 400);
        }

        // Normalize input and match order code case-insensitively
        $code = strtoupper($code);

        $order = Order::with(['timeline' => function($q) {
            $q->orderBy('created_at', 'asc'); // Chronological order
        }])->whereRaw('UPPER(order_code) = ?', [$code])->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Kode pesanan tidak ditemukan. Silakan periksa kembali kode Anda.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }
}
