<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\ExpenseCategoryResource;
use Carbon\Carbon;

class ExpenseResource extends JsonResource
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
            'amount' => $this->amount,
            'date' => Carbon::parse($this->date)->format('d F'),
            'category' => new ExpenseCategoryResource($this->category),
            'user' => new UserResource($this->user),
        ];
    }
}
