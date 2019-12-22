<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * @package App\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $patronymic
 * @property int $education_form
 * @property int $group_num
 */
class Student extends Model
{
    protected $table = 'students';
}
