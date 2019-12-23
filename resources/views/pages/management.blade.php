@extends('index')

@section('main-content')
    <h1>@yield('page-title')</h1>
    <br>
    <div class="ui fluid container">
        <div class="ui stackable grid" style="margin-bottom: 15px">
            <div class="four wide column">
                <div class="ui vertical fluid tabular menu center aligned">
                    <div class="active item" data-tab="t-create">Создание</div>
                    <div class="item" data-tab="t-edit">Изменение</div>
                </div>
            </div>
            <div class="twelve wide stretched column">
                <div class="ui active tab" data-tab="t-create">
                    <div class="ui raised segment">
                        @yield('create-segment')
                    </div>
                </div>
                <div class="ui tab" data-tab="t-edit">
                    <div class="ui raised segment">
                        @yield('edit-segment')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
