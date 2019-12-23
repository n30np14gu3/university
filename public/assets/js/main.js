$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.tabular.menu .item').tab();
    $('.ui.checkbox').checkbox();
    $('.ui.dropdown').dropdown({ maxSelections: 3 });

    $('#edit_student_name').dropdown({
        onChange: function (a) {
            $.ajax({
                method: "GET",
                url: "/action/get_student_info",
                data: {"id": a},
                success: function (data) {
                    if(data.status !== "OK"){
                        showToast(data.message, 'error', 3000, 'microchip');
                    }
                    else{
                        $('#e_first_name').val(data.data.first_name);
                        $('#e_last_name').val(data.data.last_name);
                        $('#e_patronymic').val(data.data.patronymic);
                        $('#e_form').val(data.data.education_form);
                        $('#e_group').val(data.data.group_num);
                    }
                }
            });
        }
    });

    $('#edit_plan_name').dropdown({
        onChange: function (a) {
            $.ajax({
                method: "GET",
                url: "/action/get_plan_info",
                data: {"id": a},
                success: function (data) {
                    if(data.status !== "OK"){
                        showToast(data.message, 'error', 3000, 'microchip');
                    }
                    else{
                        $('#e_specialty_name').val(data.data.specialty_name);
                        $('#e_discipline_name').val(data.data.discipline_name);
                        $('#e_semester').val(data.data.semester);
                        $('#e_hours').val(data.data.hours);
                        $('#e_form').val(data.data.form);
                    }
                }
            });
        }
    });

    $('#edit_mark_name').dropdown({
        onChange: function (a) {
            $.ajax({
                method: "GET",
                url: "/action/get_mark_info",
                data: {"id": a},
                success: function (data) {
                    if(data.status !== "OK"){
                        showToast(data.message, 'error', 3000, 'microchip');
                    }
                    else{
                        $('#e_mark').val(data.data.mark);
                        $('#e_year').val(data.data.year);
                        $('#e_semester').val(data.data.semester);
                        $('#e_form').val(data.data.form);
                    }
                }
            });
        }
    });
});

function showToast(text, type, duration) {
    $('body')
        .toast({
            class: type.toString(),
            displayTime: duration,
            closeIcon: true,
            message: text,
            showIcon: 'microchip'
        });
}

$('#form_count_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "GET",
        url: "/action/form_count",
        data: $('#form_count_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                $('#form_count').text(data.data.count);
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#create_student_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/create_student",
        data: $('#create_student_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('Студент успешно создан!', 'success', 1000);
                $('#create_student_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#edit_student_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/edit_student",
        data: $('#edit_student_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('Студент успешно обновлен!', 'success', 1000);
                $('#edit_student_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});


$('#discipline_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "GET",
        url: "/action/discipline_info",
        data: $('#discipline_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                $('#hour_count').text(data.data.hours);
                $('#report_form').text(data.data.form);
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#create_plan_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/create_plan",
        data: $('#create_plan_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('План успешно создан!', 'success', 1000);
                $('#create_plan_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#edit_plan_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/edit_plan",
        data: $('#edit_plan_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('План успешно обновлен!', 'success', 1000);
                $('#edit_plan_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#create_mark_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/create_mark",
        data: $('#create_mark_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('Оценка успешно создана!', 'success', 1000);
                $('#create_mark_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});

$('#edit_mark_form').submit(function (e) {
    e.preventDefault();
    $.ajax({
        method: "POST",
        url: "/action/edit_mark",
        data: $('#edit_mark_form').serialize(),
        success: function (data) {
            if(data.status === "OK"){
                showToast('Оценка успешно обновлена!', 'success', 1000);
                $('#edit_mark_form')[0].reset();
            }
            else{
                showToast(data.message, 'error', 1000);
            }
        }
    });
});
