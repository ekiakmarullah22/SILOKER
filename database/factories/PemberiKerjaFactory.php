<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PemberiKerja;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PemberiKerja>
 */
class PemberiKerjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PemberiKerja::class;
    public function definition(): array
    {
        return [
            //
            'nama' => $this->faker->name(),
            'no_hp' => $this->faker->tollFreePhoneNumber(),
            'link' => null,
            'alamat' => $this->faker->address(),
            'deskripsi' => $this->faker->text($maxNbChars = 200),
            'email' => $this->faker->freeEmail(),
            'gambar' => $this->faker->imageUrl($width = 640, $height = 480),
            'slug' => Str::slug($this->faker->name())
        ];
    }
}
