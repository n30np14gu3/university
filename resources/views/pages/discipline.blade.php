@extends('pages.management')

@section('page-title', 'Управление планами')
@section('plan', 'active disabled')

@section('create-segment')
    <form class="ui form" id="create_plan_form">
        <div class="two fields">
            <div class="field">
                <label>Название специальности</label>
                <input type="text" name="specialty_name" required>
            </div>
            <div class="field">
                <label>Название дисциплины</label>
                <input type="text" name="discipline_name" required>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>Семестр</label>
                <input type="number" name="semester" required>
            </div>
            <div class="field">
                <label>Кол-во часов на обучение</label>
                <input type="number" name="hours" required>
            </div>
            <div class="field">
                <label>Форма отчетности</label>
                <select name="form" required>
                    <option value="0">Оценка</option>
                    <option value="1">Зачет</option>
                </select>
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Создать</button>
        </div>
    </form>
@endsection

@section('edit-segment')
    <form class="ui form" id="edit_plan_form">
        <div class="field">
            <label>Выберите дисциплину</label>
            <div class="ui search selection dropdown" id="edit_plan_name">
                <input type="hidden" name="plan_id" required>
                <i class="dropdown icon"></i>
                <div class="default text">Название дисциплины</div>
                <div class="menu">
                    @foreach(@$disciplines as $d)
                        <div class="item" data-value="{{@$d->id}}">{{@$d->specialty_name}}::{{@$d->discipline_name}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Название специальности</label>
                <input type="text" name="specialty_name" id="e_specialty_name" required>
            </div>
            <div class="field">
                <label>Название дисциплины</label>
                <input type="text" name="discipline_name" id="e_discipline_name" required>
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>Семестр</label>
                <input type="number" name="semester" id="e_semester" required>
            </div>
            <div class="field">
                <label>Кол-во часов на обучение</label>
                <input type="number" name="hours" id="e_hours" required>
            </div>
            <div class="field">
                <label>Форма отчетности</label>
                <select name="form" id="e_form" required>
                    <option value="0">Оценка</option>
                    <option value="1">Зачет</option>
                </select>
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Изменить</button>
        </div>
    </form>
@endsection

