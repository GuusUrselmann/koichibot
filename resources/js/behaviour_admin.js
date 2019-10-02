var Chart = require('chart.js');

$(document).ready(function(e) {
    //Select
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
                progressChart.config.data.datasets[0].data[0] = $('#levelExpMin').val();
                progressChart.config.data.datasets[0].data[1] = level.experience - $('#levelExpMin').val();
                progressChart.update();
            },
            error: function(xhr,status,error) {
                console.log(xhr+"///"+status+"///"+error)
            }
        });
    });
    $('#levelExpMin').on('change', function(e) {
        if(parseInt($('#levelExpMin').val()) > parseInt($('#levelExpMax').text())-1) {
            $('#levelExpMin').val($('#levelExpMax').text()-1);
        }
        progressChart.config.data.datasets[0].data[0] = $('#levelExpMin').val();
        progressChart.config.data.datasets[0].data[1] = $('#levelExpMax').text() - $('#levelExpMin').val();
        progressChart.update();
    });

    // Unlocks area
    $('.unlock .unlock-add').on('click', function(e) {
        toggleUnlockSelect(e);
    });
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".add-list").length === 0) {
            $('.unlock .add-list').removeClass('toggled');
        }
    });
    $('.unlock .add-list .selectable').on('click', function(e) {
        addUnlock(e);
    });
    $(".unlock").on('click', '.selectable .unlock-remove', function(e) {
        removeUnlock(e);
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

function toggleUnlockSelect(e) {
    if($($(e.target).closest('.unlock').find('.add-list')[0]).hasClass('toggled')) {
        $($(e.target).closest('.unlock').find('.add-list')[0]).removeClass('toggled');
    }
    else {
        $($(e.target).closest('.unlock').find('.add-list')[0]).addClass('toggled');
    }
}
function addUnlock(e) {
    var unlockBlock = $(e.target).closest('.unlock');

    $(e.target).addClass('hidden');
    var id = $(e.target).attr('data-id');
    var name = $($(e.target).children('.unlock-name')).text();
    var image = $(e.target).attr('data-image');
    var html = `
        <li data-id="`+id+`" class="selectable">
            <div class="unlock-image background-cover" style="background-image: url(`+image+`)"></div>
            <span class="unlock-name">`+name+`</span>
            <span class="unlock-remove"><i class="fa fas far fal fab fa-times"></i></span>
        </li>`;
    $($(e.target).closest('.unlock').find('.unlock-list ul')[0]).append(html);
    compileUnlocks(unlockBlock);
}
function removeUnlock(e) {
    var unlockBlock = $(e.target).closest('.unlock');
    var id = $(e.target).closest('.selectable').attr('data-id');
    $($(e.target).closest('.unlock').find('.add-list [data-id = '+id+']')[0]).removeClass('hidden');
    $(e.target).closest('.selectable').remove();
    compileUnlocks(unlockBlock);
}

function compileUnlocks(unlockBlock) {
    var value = '';
    $($(unlockBlock).closest('.unlock').find('.unlock-list li.selectable')).each(function(i, v) {
        value += $(v).attr('data-id')+',';
    });
    value = value.substring(0, value.length - 1);
    $(unlockBlock).find('.unlock-input').val(value);
}
