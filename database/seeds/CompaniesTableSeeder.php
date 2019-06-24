<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'name', 'email', 'logo', 'description', 'url'
        /*
        $c1 = new Company;
        $c1->name = 'Roam.Africa';
        $c1->email = 'roam@roam.com';
        $c1->logo = 'http://images.thenorthface.com/is/image/TheNorthFace/236x204_CLR/mens-better-than-naked-jacket-AVMH_LC9_hero.png';
        $c1->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua consequat.';
        $c1->url = 'https://roam.africa/';

        $c1->save();*/

        factory(App\Company::class, 20)->create();

    }
}
