<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Employee
 * Create employee model for databese.
 *
 * @author Zin Lin Htet
 * @created 21/06/2023
 */
class Employee extends Model
{
    use SoftDeletes;
}
