<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudyPlan
 * @package App\Models
 * @property int $id
 * @property string $specialty_name
 * @property string $discipline_name
 * @property int $semester
 * @property int $hours
 * @property int $form
 */
class StudyPlan extends Model
{
    protected $table = 'study_plan';
}
