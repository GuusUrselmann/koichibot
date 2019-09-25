var Chart = require('chart.js');

$(document).ready(function() {
    $('#userStand .select-current').on('click', function() {
        toggleStandSelect();
    });
    $('#userStand li').on('click', function(e) {
        selectNewStand(e);
    });
    $(document).mouseup(function (e) {
        if ($(e.target).closest(".select-list").length === 0) {
            $('#userStand .select-list').removeClass('toggled');
        }
    });
});
function toggleStandSelect() {
    if($('#userStand .select-list').hasClass('toggled')) {
        $('#userStand .select-list').removeClass('toggled');
    }
    else {
        $('#userStand .select-list').addClass('toggled');
    }
}
function selectNewStand(e) {
    var value = $(e.target).attr('data-id');
    var name = $(e.target).text();
    $('#userStandId').val(value);
    $('#userStand .select-current').text(name);
    toggleStandSelect();
    if(!value) {
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
}
