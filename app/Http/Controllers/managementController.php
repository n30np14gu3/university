<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudyPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'group.form' => 'Невалидная форма обучения',
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
}
