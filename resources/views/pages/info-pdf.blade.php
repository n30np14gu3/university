@extends('index')

@section('page-title', 'Информация о студенте')

@section('main-content')
    <h1 style="text-align: center">Информация о студенте: ({{@$student->first_name}} {{@$student->last_name}} {{@$student->patronymic}} гр. {{$student->group_num}})</h1>
    <table class="ui unstackable striped selectable table center aligned fluid green">
        <thead>
        <tr>
            <th>Специальность</th>
            <th>Дисциплина</th>
            <th>Год</th>
            <th>Семестр</th>
            <th>Тип оценки</th>
            <th>Оценка</th>
        </tr>
        </thead>
        <tbody>
        @foreach(@$marks as $m)
            <tr>
                <td>{{@$m->plan->specialty_name}}</td>
                <td>{{@$m->plan->discipline_name}}</td>
                <td>{{@$m->year}}</td>
                <td>{{@$m->semester}}</td>
                <td>{{@$m->form == 0 ? 'Оценка': 'Зачет'}}</td>
                <td>{{@$m->form == 0 ? $m->mark : ($m->mark == 1? 'Зачет': 'Незачет')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
