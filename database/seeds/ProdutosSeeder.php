<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produto = [
            0 => [
                'name' => 'Computador',
                'description' => 'Otima configurações',
                'amount' => 5,
                'user_id' => 1,
            ],
            1 => [
                'name' => 'Monitor',
                'description' => 'Full hd',
                'amount' => 10,
                'user_id' => 1,
            ],

        ];
        DB::table('produtos')->insert($produto);
    }
}
