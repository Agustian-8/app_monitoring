<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Outlet;

class VisitController extends Controller
{
    public function getOutlets(Request $request)
    {
        // Sekarang kirim juga latitude, longitude, radius_meters
        // agar frontend bisa hitung jarak sebelum submit
        $outlets = Outlet::select(
            'id',
            'name',
            'address',
            'latitude',
            'longitude',
            'radius_meters'
        )->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data'    => $outlets
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'photo'     => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'notes'     => 'nullable|string|max:1000',
        ]);

        $outlet = Outlet::find($request->outlet_id);

        // Validasi koordinat outlet wajib ada
        if (!$outlet->latitude || !$outlet->longitude) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal: Koordinat GPS untuk toko ini belum diatur oleh Admin.',
            ], 400);
        }

        // Hitung jarak
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $outlet->latitude,
            $outlet->longitude
        );

        // ✅ Ambil radius dari DB, fallback ke 50
        $radius = $outlet->radius_meters ?? 50;

        if ($distance > $radius) {
            return response()->json([
                'success'  => false,
                'message'  => 'Gagal: Anda berada di luar radius toko. Jarak Anda saat ini: '
                              . round($distance) . ' meter (maksimal ' . $radius . 'm).',
                'distance' => round($distance),
                'radius'   => $radius,
            ], 400);
        }

        $photoPath = $request->file('photo')->store('visits', 'public');

        $visit = Visit::create([
            'user_id'    => $request->user()->id,
            'outlet_id'  => $request->outlet_id,
            'photo_path' => $photoPath,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
            'notes'      => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan kunjungan berhasil dikirim!',
            'data'    => $visit,
        ], 201);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;

        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }
}