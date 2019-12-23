@extends('pages.management')

@section('page-title', 'Управление планами')
@section('plan', 'active disabled')

@section('create-segment')
    <form class="ui form" id="create_mark_form">
        <div class="two fields">
            <div class="field">
                <label>Выберите студента</label>
                <div class="ui search selection dropdown">
                    <input type="hidden" name="student_id" required>
                    <i class="dropdown icon"></i>
                    <div class="default text">Студент</div>
                    <div class="menu">
                        @foreach(@$students as $s)
                            <div class="item" data-value="{{@$s->id}}">
                                {{@$s->first_name}} {{@$s->last_name}} {{@$s->patronymic}} гр. {{$s->group_num}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Название дисциплины</label>
                <div class="ui search selection dropdown">
                    <input type="hidden" name="discipline" required>
                    <i class="dropdown icon"></i>
                    <div class="default text">Дисциплина</div>
                    <div class="menu">
                        @foreach(@$plans as $p)
                            <div class="item" data-value="{{@$p->discipline_name}}">
                                {{@$p->discipline_name}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="four fields">
            <div class="field">
                <label>Год</label>
                <input type="number" name="year" required>
            </div>
            <div class="field">
                <label>Семестр</label>
                <input type="number" name="semester" required>
            </div>
            <div class="field">
                <label>Форма отчетности</label>
                <select name="form" required>
                    <option value="0">Оценка</option>
                    <option value="1">Зачет</option>
                </select>
            </div>
            <div class="field">
                <label>Оценка (для зачета ставить 1/0)</label>
                <input type="number" name="mark" required>
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Создать</button>
        </div>
    </form>
@endsection

@section('edit-segment')
    <form class="ui form" id="edit_mark_form">
        <div class="field">
            <label>Выберите дисциплину</label>
            <div class="ui search selection dropdown" id="edit_mark_name">
                <input type="hidden" name="mark_id" required>
                <i class="dropdown icon"></i>
                <div class="default text">Оценка</div>
                <div class="menu">
                    @foreach(@$marks as $m)
                        <div class="item" data-value="{{@$m->id}}">
                            {{@$m->student->first_name}} {{@$m->student->last_name}} {{@$m->student->patronymic}} гр. {{$m->student->group_num}}::{{@$m->plan->discipline_name}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="four fields">
            <div class="field">
                <label>Год</label>
                <input type="number" name="year" id="e_year" required>
            </div>
            <div class="field">
                <label>Семестр</label>
                <input type="number" name="semester" id="e_semester" required>
            </div>
            <div class="field">
                <label>Форма отчетности</label>
                <select name="form" id="e_form" required>
                    <option value="0">Оценка</option>
                    <option value="1">Зачет</option>
                </select>
            </div>
            <div class="field">
                <label>Оценка (для зачета ставить 1/0)</label>
                <input type="number" name="mark" id="e_mark" required>
            </div>
        </div>
        <div class="field">
            <button type="submit" class="ui fluid primary button">Изменить</button>
        </div>
    </form>
@endsection

