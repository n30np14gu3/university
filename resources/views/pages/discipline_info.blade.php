@extends('index')

@section('page-title', 'Информация о дисциплине')
@section('discipline_info', 'active disabled')

@section('main-content')
    <form class="ui form" id="discipline_form">
        <div class="field">
            <label>Выберите дисциплину: </label>
            <select name="discipline" required>
                @foreach($disciplines as $d)
                    <option value="{{@$d->id}}">{{@$d->discipline_name}}</option>
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
