@extends('pages.management')

@section('page-title', 'Управление студентами')
@section('students', 'active disabled')

@section('create-segment')
    <form class="ui form" id="create_student_form">
        <div class="three fields">
            <div class="field">
                <label>Фамилия</label>
                <input type="text" name="last_name" required>
            </div>
            <div class="field">
                <label>Имя</label>
                <input type="text" name="first_name" required>
            </div>
            <div class="field">
                <label>Отчество</label>
                <input type="text" name="patronymic" required>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Форма обучения</label>
                <select name="form" required>
                    <option value="0">Очная</option>
                    <option value="1">Заочная</option>
                </select>
            </div>
            <div class="field">
                <label>Группа для обучения</label>
                <input type="number" name="group" min="1000" max="9999">
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Создать</button>
        </div>
    </form>
@endsection

@section('edit-segment')
    <form class="ui form" id="edit_student_form">
        <div class="field">
            <label>Выберите студента</label>
            <div class="ui search selection dropdown" id="edit_student_name">
                <input type="hidden" name="stud_id" required>
                <i class="dropdown icon"></i>
                <div class="default text">Студент</div>
                <div class="menu">
                    @foreach($students as $s)
                        <div class="item" data-value="{{@$s->id}}">{{@$s->first_name}} {{@$s->last_name}} {{$s->patronymic}} гр.{{@$s->group_num}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>Фамилия</label>
                <input type="text" name="last_name" id="e_last_name" required>
            </div>
            <div class="field">
                <label>Имя</label>
                <input type="text" name="first_name" id="e_first_name" required>
            </div>
            <div class="field">
                <label>Отчество</label>
                <input type="text" name="patronymic" id="e_patronymic" required>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Форма обучения</label>
                <select name="form" id="e_form" required>
                    <option value="0">Очная</option>
                    <option value="1">Заочная</option>
                </select>
            </div>
            <div class="field">
                <label>Группа для обучения</label>
                <input type="number" name="group" id="e_group" min="1000" max="9999">
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Изменить</button>
        </div>
    </form>
@endsection

