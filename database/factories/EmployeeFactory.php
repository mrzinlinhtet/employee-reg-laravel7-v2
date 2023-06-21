<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'employee_id'=>rand(10001,19999),
        'employee_code'=>rand(1,100),
        'employee_name'=>$faker->name(),
        'nrc_number'=>$faker->creditCardNumber(),
        'password'=>Hash::make("asdf"),
        'email_address'=>$faker->email(),
        'gender'=>rand(1,2),
        'date_of_birth'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'marital_status'=>rand(1,3),
        'address'=>$faker->address(),
    ];
});
