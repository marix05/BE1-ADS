<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'noInduk' => $this->noInduk,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tglLahir' => $this->tglLahir,
            'tglBergabung' => $this->tglBergabung,
        ];
    }
}
