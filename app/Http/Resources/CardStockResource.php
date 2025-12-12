<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CardStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = Carbon::parse($this->created_at)->locale('id')->translatedFormat('l, d F Y');
        return [
            'no_transaction' => $this->no_transaction,
            'type_transaction' => $this->type_transaction,
            'date' => $date,
            'total_in' => $this->total_in,
            'total_out' => $this->total_out,
            'last_stock' => $this->last_stock,
            'officer' => $this->officer,
        ];
    }
}
