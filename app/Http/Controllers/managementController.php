<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\StudyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use PDF;

class managementController extends Controller
{

    public function formCount(Request $request){
        if(@$request['form'] != 0 && @$request['form'] != 1){
            $this->response['message'] = 'Не все поля заполнены!';
            return response()->json($this->response);
        }

        $this->response['status'] = 'OK';
        $this->response['data'] = [
            'count' => Student::query()->where('education_form', @$request['form'])->get()->count(),
        ];

        return response($this->response);
    }

    public function disciplinePrepare(){
        return view('pages.discipline_info')->with([
           'disciplines' => StudyPlan::all()
        ]);
    }

    public function studentsPrepare(){
        return view('pages.students')->with([
            'students' => Student::all()
        ]);
    }

    public function getStudentInfo(Request $request){
        $student = @Student::query()->where('id', @$request['id'])->get()->first();
        if(!$student){
            $this->response['message'] = 'Студент не найден!';
            return response()->json($this->response);
        }

        $this->response['status'] = 'OK';
        $this->response['data'] = $student;
        return response()->json($this->response);
    }

    public function disciplineInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'discipline' => 'required|exists:study_plan,id'
        ], [
           'required'=>'Не все поля заполнены',
           'exists' => 'Данной дисциплины не существует',
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        $plan = StudyPlan::query()->where('id', $request['discipline'])->get()->first();

        $this->response['status'] = 'OK';
        $this->response['data'] = [
            'hours' => $plan->hours,
            'form' => $plan->form ? "Очная" : "Заочная"
        ];
        return response()->json($this->response);
    }

    public function createStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'patronymic' => 'required|alpha',
            'group' => 'required|numeric|between:1000,9999',
            'form' => 'required|numeric|between:0,1',
        ], [
            'required' => 'Не все поля заполнены!',
            'first_name.alpha' => 'Неверный формат имени',
            'last_name.alpha' => 'Неверный формат фамилии',
            'patronymic.alpha' => 'Неверный формат отчества',
            'numeric' => 'Неверный формат группы',
            'group.between' => 'Невалидная группа',
            'group.form' => 'Невалидная форма обучения'
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        $student = new Student();
        $student->first_name = $request['first_name'];
        $student->last_name = $request['last_name'];
        $student->patronymic = $request['patronymic'];
        $student->group_num = $request['group'];
        $student->education_form = $request['form'];
        $student->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function planPrepare(){
        return view('pages.discipline')->with([
           'disciplines' => StudyPlan::all()
        ]);
    }

    public function editStudent(Request $request){
        $validator = Validator::make($request->all(), [
            'stud_id' => 'exists:students,id',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'patronymic' => 'required|alpha',
            'group' => 'required|numeric|between:1000,9999',
            'form' => 'required|numeric|between:0,1',
        ], [
            'required' => 'Не все поля заполнены!',
            'first_name.alpha' => 'Неверный формат имени',
            'last_name.alpha' => 'Неверный формат фамилии',
            'patronymic.alpha' => 'Неверный формат отчества',
            'numeric' => 'Неверный формат группы',
            'group.between' => 'Невалидная группа',
            'form.between' => 'Невалидная форма обучения',
            'exists' => 'Такого студента не существует!'
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        $student = Student::query()->where('id', $request['stud_id'])->get()->first();
        $student->first_name = $request['first_name'];
        $student->last_name = $request['last_name'];
        $student->patronymic = $request['patronymic'];
        $student->group_num = $request['group'];
        $student->education_form = $request['form'];
        $student->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function createPlan(Request $request){
        $validator = Validator::make($request->all(), [
            'specialty_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'discipline_name' => 'required|regex:/^[\pL\s\-]+$/u|unique:study_plan,discipline_name',
            'semester' => 'required|numeric|between:1,12',
            'hours' => 'required|numeric|between:1,40',
            'form' => 'required|numeric|between:0,1',
        ], [
            'required' => 'Не все поля заполнены!',
            'specialty_name.regex' => 'Неверный формат специальности',
            'discipline_name.regex' => 'Неверный формат дисциплины',
            'numeric' => 'Неверный формат числовых полей',
            'semester.between' => 'Невалидный семетр',
            'form.between' => 'Невалидная форма отчетности',
            'hours.between' => 'Невалидное кол-во часов',
            'unique' => 'Дисциплина должна быть уникальной!'
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        $plan = new StudyPlan();
        $plan->specialty_name = $request['specialty_name'];
        $plan->discipline_name = $request['discipline_name'];
        $plan->semester = $request['semester'];
        $plan->hours = $request['hours'];
        $plan->form = $request['form'];
        $plan->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function getPlanInfo(Request $request){
        $plan = @StudyPlan::query()->where('id', @$request['id'])->get()->first();
        if(!$plan){
            $this->response['message'] = 'План не найден!';
            return response()->json($this->response);
        }

        $this->response['status'] = 'OK';
        $this->response['data'] = $plan;
        return response()->json($this->response);
    }

    public function editPlan(Request $request){
        $validator = Validator::make($request->all(), [
            'plan_id' => 'exists:study_plan,id',
            'specialty_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'discipline_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'semester' => 'required|numeric|between:1,12',
            'hours' => 'required|numeric|between:1,40',
            'form' => 'required|numeric|between:0,1',
        ], [
            'required' => 'Не все поля заполнены!',
            'specialty_name.regex' => 'Неверный формат специальности',
            'discipline_name.regex' => 'Неверный формат дисциплины',
            'numeric' => 'Неверный формат числовых полей',
            'semester.between' => 'Невалидный семетр',
            'form.between' => 'Невалидная форма отчетности',
            'hours.between' => 'Невалидное кол-во часов',
            'exists' => 'Такого плана не существует'
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        $plan = StudyPlan::query()->where('id', $request['plan_id'])->get()->first();
        $plan->specialty_name = $request['specialty_name'];
        $plan->discipline_name = $request['discipline_name'];
        $plan->semester = $request['semester'];
        $plan->hours = $request['hours'];
        $plan->form = $request['form'];
        $plan->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function markPrepare(Request $request){
        return view('pages.marks')->with([
            'marks' => StudentInfo::all(),
            'students' => Student::all(),
            'plans' => StudyPlan::all()
        ]);
    }

    public function createMark(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'discipline' => 'required|exists:study_plan,discipline_name|regex:/^[\pL\s\-]+$/u',
            'year' => 'required|numeric|between:2000,'.date("Y"),
            'semester' => 'required|numeric|between:1,12',
            'form' => 'required|numeric|between:0,1',
            'mark' => 'required|numeric|between:0,5',
        ], [
            'required' => 'Не все поля заполнены!',
            'stud_id.exists' => 'Студента не существует!',
            'plan_id.exists' => 'Плана не существует!',
            'semester.numeric' => 'Неверный формат семестра',
            'numeric' => 'Неверный формат числовых данных',
            'form.between' => 'Неверный формат формы оценивания',
            'semester.between' => 'Неверный формат семестра',
            'mark.between' => 'Неверный формат оценки',
            'year.between' => 'Неверный формат года',
            'regex' => 'Неверный формат дисциплины',
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        if($request['form'] == 0 && ($request['mark'] < 2)){
            $this->response['message'] = 'Не верный формат оценки';
            return response()->json($this->response);
        }

        if($request['form'] == 1 && ($request['mark'] > 1)){
            $this->response['message'] = 'Не верный формат зачета';
            return response()->json($this->response);
        }

        $mark = StudentInfo::query()->
        where('student_id', $request['stud_id'])->
        where('discipline', $request['discipline'])->
        where('year', $request['year'])->
        where('semester', $request['semester'])->get();

        if(count($mark) != 0){
            $this->response['message'] = 'Оценка по этой специальности уже есть';
            return response()->json($this->response);
        }

        $info = new StudentInfo();
        $info->student_id = $request['student_id'];
        $info->discipline = $request['discipline'];
        $info->year = $request['year'];
        $info->semester = $request['semester'];
        $info->form = $request['form'];
        $info->mark = $request['mark'];
        $info->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function getMarkInfo(Request $request){
        $mark = @StudentInfo::query()->where('id', @$request['id'])->get()->first();
        if(!$mark){
            $this->response['message'] = 'Оценка не найдеа!';
            return response()->json($this->response);
        }

        $this->response['status'] = 'OK';
        $this->response['data'] = $mark;
        return response()->json($this->response);
    }

    public function editMarkInfo(Request $request){
        $validator = Validator::make($request->all(), [
            'mark_id' => 'required|exists:student_info,id',
            'year' => 'required|numeric|between:2000,'.date("Y"),
            'semester' => 'required|numeric|between:1,12',
            'form' => 'required|numeric|between:0,1',
            'mark' => 'required|numeric|between:0,5',
        ], [
            'required' => 'Не все поля заполнены!',
            'stud_id.exists' => 'Студента не существует!',
            'plan_id.exists' => 'Плана не существует!',
            'semester.numeric' => 'Неверный формат семестра',
            'numeric' => 'Неверный формат числовых данных',
            'form.between' => 'Неверный формат формы оценивания',
            'semester.between' => 'Неверный формат семестра',
            'mark.between' => 'Неверный формат оценки',
            'year.between' => 'Неверный формат года',
            'regex' => 'Неверный формат дисциплины',
        ]);

        if($validator->fails()){
            $this->response['message'] = $validator->errors()->first();
            return response()->json($this->response);
        }

        if($request['form'] == 0 && ($request['mark'] < 2)){
            $this->response['message'] = 'Не верный формат оценки';
            return response()->json($this->response);
        }

        if($request['form'] == 1 && ($request['mark'] > 1)){
            $this->response['message'] = 'Не верный формат зачета';
            return response()->json($this->response);
        }

        $info = StudentInfo::query()->where('id', $request['mark_id'])->get()->first();
        $info->year = $request['year'];
        $info->semester = $request['semester'];
        $info->form = $request['form'];
        $info->mark = $request['mark'];
        $info->save();

        $this->response['status'] = 'OK';
        return response()->json($this->response);
    }

    public function getInfoPrepare(){
        return view('pages.info')->with([
           'students' => Student::all()
        ]);
    }

    public function getInfo(Request $request){
        $student = @Student::query()->where('id', @$request['id'])->get()->first();
        if(!$student)
            return back();

        return view('pages.info-pdf', [
            'student' => $student,
            'marks' => StudentInfo::query()->where('student_id', $student->id)->get()
        ]);
    }
}
