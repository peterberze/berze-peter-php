<?php

namespace App\Http\Resources;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class VehicleResource extends JsonResource
{
    public $resource = Vehicle::class;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->resource->uuid,
            'rendszam' => $this->resource->rendszam,
            'tulajdonos' => $this->resource->tulajdonos,
            'forgalmi_ervenyes' => $this->resource->forgalmi_ervenyes->format('Y-m-d'),
            'adatok' => $this->resource->adatok,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        if ($response->status() === 201) {
            $response->header('Location', "/jarmuvek/{$this->resource->uuid}");
        }
    }
}
