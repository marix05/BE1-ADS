<?php

namespace App\Http\Controllers;

use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all karyawan
        $karyawan = Karyawan::all();

        // Return karyawan as a resource
        return response()->json([
            'status' => 'success',
            'data' => KaryawanResource::collection($karyawan),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'noInduk' => ['required', 'string', 'unique:karyawans'],
                'nama' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'tglLahir' => ['required', 'date'],
                'tglBergabung' => ['required', 'date'],
            ]);

            // Store request data
            $karyawan = new Karyawan($request->all());

            if($karyawan->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Karyawan created successfully',
                    'data' => new KaryawanResource($karyawan)
                ], 201);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($noInduk)
    {
        // Get single karyawan by noInduk
        $karyawan = Karyawan::where('noInduk', $noInduk)->firstOrFail();

        // Return the karyawan as a resource
        return response()->json([
            'status' => 'success',
            'data' => new KaryawanResource($karyawan),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $noInduk)
    {
        $karyawan = Karyawan::where('noInduk', $noInduk)->firstOrFail();

        try {
            $request->validate([
                'noInduk' => ['required', 'string', Rule::unique('karyawans')->ignore($noInduk, 'noInduk')],
                'nama' => ['nullable', 'string'],
                'alamat' => ['nullable', 'string'],
                'tglLahir' => ['nullable', 'date'],
                'tglBergabung' => ['nullable', 'date'],
            ]);

            // Store request data
            $karyawan->update($request->all());

            if($karyawan->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Karyawan updated successfully',
                    'data' => new KaryawanResource($karyawan)
                ], 201);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($noInduk)
    {
        // Delete the karyawan
        $karyawan = Karyawan::where('noInduk', $noInduk)->firstOrFail();
        $karyawan->delete();

        // Return a response indicating successful deletion
        return response()->json([
            'status' => 'success',
            'message' => 'Karyawan deleted successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function karyawanFirstJoined(Request $request)
    {
        $amount = $request->amount ?? 3;

        // Get first karyawan who joined the company
        $karyawan = Karyawan::orderBy('tglBergabung')->take($amount)->get();


        // Return the karyawan as a resource
        return response()->json([
            'status' => 'success',
            'data' => KaryawanResource::collection($karyawan),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function karyawanWithCuti()
    {
        // Get the list of karyawan who have taken a cuti
        $karyawan = Karyawan::whereHas('cutis')->get();

        // Return the karyawan as a resource
        return response()->json([
            'status' => 'success',
            'data' => KaryawanResource::collection($karyawan),
        ], 200);
    }

    public function karyawanSisaCuti()
    {
        // Get all karyawan with their cutis data
        $karyawans = Karyawan::with('cutis')->get();

        // Calculate the remaining cuti quota
        $karyawanWithSisaCuti = $karyawans->map(function ($karyawan) {
            $totalCuti = $karyawan->cutis->sum('lamaCuti');
            $sisaCuti = 12 - $totalCuti;

            return [
                'noInduk' => $karyawan->noInduk,
                'nama' => $karyawan->nama,
                'sisaCuti' => $sisaCuti,
            ];
        });

        // Return the karyawan with sisa cuti as a resource collection
        return response()->json([
            'status' => 'success',
            'data' => $karyawanWithSisaCuti,
        ]);
    }
}
