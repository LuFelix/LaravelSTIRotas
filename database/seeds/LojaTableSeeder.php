<?php

use Illuminate\Database\Seeder;

class LojaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Loja::create([
            'nome' => str_random(15),
            'local' => 'Maceió',
            'detalhes' => str_random(10).'@hotmail.com',
        ]);
    }
}
