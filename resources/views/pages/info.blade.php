@extends('index')

@section('page-title', 'Информация о студенте')
@section('get-info', 'active disabled')

@section('main-content')
    <form class="ui form" action="{{url('/action/get_info')}}" method="get">
        <div class="field">
            <label>Выберите студента: </label>
            <div class="ui search selection dropdown">
                <input type="hidden" name="id" required>
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
            <button type="submit" class="ui primary fluid button">Получить информацию</button>
        </div>
    </form>
@endsection
