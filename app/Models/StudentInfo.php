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
 * @property int form
 * @property int $mark
 *
 * @property StudyPlan $plan
 * @property Student $student
 */
class StudentInfo extends Model
{
    protected $table = 'student_info';

    public function plan(){
        return $this->hasOne('App\Models\StudyPlan', 'discipline_name', 'discipline');
    }

    public function student(){
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }
}
