<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumeResource extends JsonResource
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
            'full_name' => $this->full_name,
            'job' => [
                'position' => $this->position,
                'category' => $this->category,
                'salary'   => $this->salary . ' AZN', // Добавляем валюту
            ],
            'contacts' => [
                'email' => $this->email,
                'phone' => $this->phone,
            ],
            'details' => [
                'description' => $this->description,
                'education'   => $this->education,
                'experience'  => $this->experience,
                'skills'      => $this->skills,
            ],
            'created_at' => $this->created_at->format('d.m.Y H:i'), // Красивая дата
        ];
    }
}
