var Chart = require('chart.js');

$(document).ready(function(e) {
    $('.form-select .select-current').on('click', function(e) {
        toggleStandSelect(e);
    });
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".select-list").length === 0) {
            $('.form-select .select-list').removeClass('toggled');
        }
    });
    $('.form-select li').on('click', function(e) {
        selectNew(e);
    });
    $('#userStand .form-select li').on('click', function(e) {
        if(!$(e.target).attr('data-id')) {
            if($('#standStats').hasClass('toggled')) {
                $('#standStats').removeClass('toggled');
                $('#standStats input').each(function(i, v) {
                    $(v).val('');
                });
            }
        }
        else {
            if(!$('#standStats').hasClass('toggled')) {
                $('#standStats').addClass('toggled');
            }
        }
    });
    $('#userSkin.form-select li').on('click', function(e) {
        $('#skin').css('background-image', 'url('+$(e.target).attr('data-image')+')');
    });
    $('#level').on('change', function() {
        var val = $('#level').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: url()+'/admin/users/ajaxLevel',
            data: {
                level: val
            },
            cache: false,
            success: function(result) {
                var level = result;
                if(!level) {
                    $('#level').val('')
                    return;
                }
                $('#levelExpMax').text(level.experience);
                if($('#levelExpMin').val() > level.experience) {
                    $('#levelExpMin').val(level.experience);
                }
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
    });
});
function toggleStandSelect(e) {
    if($($(e.target).closest('.form-select').children('.select-list')[0]).hasClass('toggled')) {
        $($(e.target).closest('.form-select').children('.select-list')[0]).removeClass('toggled');
    }
    else {
        $($(e.target).closest('.form-select').children('.select-list')[0]).addClass('toggled');
    }
}
function selectNew(e) {
    var value = $(e.target).attr('data-id');
    var name = $(e.target).text();
    $($(e.target).closest('.form-select').children('.select-input')[0]).val(value);
    $($(e.target).closest('.form-select').children('.select-current')[0]).text(name);
    toggleStandSelect(e);

}
