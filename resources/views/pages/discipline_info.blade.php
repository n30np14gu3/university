@extends('index')

@section('page-title', 'Информация о дисциплине')
@section('get-info', 'active disabled')

@section('main-content')
    <form class="ui form" id="discipline_form">
        <div class="field">
            <label>Выберите студента: </label>
            <select name="stud_id" required>
                @foreach(@$students as $s)
                    <div class="item" data-value="{{@$s->id}}">
                        {{@$s->first_name}} {{@$s->last_name}} {{@$s->patronymic}} гр. {{$s->group_num}}
                    </div>
                @endforeach
            </select>
        </div>
        <div class="field">
            <button type="submit" class="ui primary fluid button">Получить информацию</button>
        </div>
        <h1>Кол-во часо: (<span id="hour_count">0</span>)</h1>
        <h1>Форма отчетности: (<span id="report_form"></span>)</h1>
    </form>
@endsection
