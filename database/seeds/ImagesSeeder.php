<?php

use App\Gallery;
use App\Image;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::all()->each(function(Gallery $gallery){
            $gallery->images()->saveMany(factory(Image::class, 10)->make());
        });
    }
}
