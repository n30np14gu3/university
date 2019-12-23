@extends('index')

@section('page-title', 'Форма обучения')
@section('form_count', 'active disabled')

@section('main-content')
    <form class="ui form" id="form_count_form">
        <div class="field">
            <label>Выберите форму обучения: </label>
            <select name="form" required>
                <option value="0">Очная</option>
                <option value="1">Заочная</option>
            </select>
        </div>
        <div class="field">
            <button type="submit" class="ui primary fluid button">Подсчитать кол-во</button>
        </div>
        <h1>Студентов: (<span id="form_count">0</span>)</h1>
    </form>
@endsection
