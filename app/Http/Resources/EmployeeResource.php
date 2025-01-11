<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request);

        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'phone' => $this->phone,
            'division' => [
                'id' => $this->division->id,
                'name' => $this->division->name,
            ],
            'position' => $this->position,
        ];
    }
}
