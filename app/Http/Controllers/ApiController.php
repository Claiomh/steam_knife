<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Faker\Factory as Faker;


class ApiController extends Controller
{
    public function index()
    {
        $faker = Faker::create();

        $responce = Http::get('https://swapi.dev/api/people')->json();
//        dd($responce);
foreach ($responce['results'] as  $people) {
//    dd($people);
    User::create([
        'name' => $people['name'],
        'email' => $faker->email(),
        'password' => $faker->password(),
    ]);
}

    }
}
