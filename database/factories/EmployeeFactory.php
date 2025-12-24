<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'employee_id'    => $this->faker->unique()->numberBetween(10001, 19999),
            'employee_code'  => $this->faker->bothify('EMP###'),
            'employee_name'  => $this->faker->name(),
            'nrc_number'     => $this->faker->numerify('##########'),
            'password'       => Hash::make('asdf@123'),
            'email_address'  => $this->faker->unique()->safeEmail(),
            'gender'         => $this->faker->randomElement([1, 2]),
            'date_of_birth'  => $this->faker->date('Y-m-d'),
            'marital_status' => $this->faker->randomElement([1, 2, 3]),
            'address'        => $this->faker->address(),
        ];
    }
}
