<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Root',
            'description' => 'Esta é a raiz das categorias, não a remova',
            'parent_id' => null,
            'menu' => 0,
        ]);
        factory(Category::class, 10)->create();
    }
}
