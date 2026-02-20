<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *    title="Resume",
 *    description="Модель резюме",
 *    @OA\Property(property="id", type="integer", example=1),
 *    @OA\Property(property="full_name", type="string", example="Ali Aliyev"),
 *    @OA\Property(property="position", type="string", example="PHP Developer"),
 *    @OA\Property(property="salary", type="number", format="float", example=1500.00),
 *    @OA\Property(property="category", type="string", example="IT"),
 *    @OA\Property(property="education", type="string", example="bachelor"),
 *    @OA\Property(property="experience", type="string", example="mid")
 * )
 */
class Resume extends Model
{
    protected $fillable = ['full_name', 'email', 'phone', 'position', 'category', 'description', 'skills', 'salary', 'education', 'experience'];

    protected $casts = [
        'skills' => 'array',
    ];
}
