<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Server;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


    		//create admin
    		User::create([
    		'username' => 'admin',
            'email' => 'admin@metin2.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin'=>true,
    		]);

    		//create user
    		User::create([
    		'username' => 'user',
            'email' => 'user@metin2.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin'=>false,
    		]);


    		//create server 
    		Server::create([
    			'url'=>'https://www.fiverr.com/',
    			'title'=>'best server (:',
    			'banner'=>'uploads/images/1609968077.gif',
    			'category'=>'Oldschool Root',
    			'language'=>'Deutsch,English,Espanol,France,Roman,',
    			'maxlevel'=>'1000',
    			'youtube_id'=>'https://www.youtube.com/watch?v=vCkD9uMmotQ&list=RDKV2ssT8lzj8&index=27&ab_channel=NitinRandhawa',
    			'rates'=>'60',
    			'description'=>'best server (:best server (:best server (:best server (:best server (:best server (:best server (:best server (:',
    			'screen'=>null,
    			'user_id'=>2,
    			'difficulty'=>'Medium',
    			'hasBacklink'=>true,
    			'status'=>true,

    		]);

    }
}
