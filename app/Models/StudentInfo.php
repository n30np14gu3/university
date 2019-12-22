<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentInfo
 * @package App\Models
 * @property int $id
 * @property int $student_id
 * @property string $discipline
 * @property int $year
 * @property int $semester
 * @property int $mark
 */
class StudentInfo extends Model
{
    protected $table = 'student_info';
}
