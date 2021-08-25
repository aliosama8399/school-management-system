// Hide P.Messages After 5 second
setTimeout(function () {
    $('.content-wrapper p.all-messages').fadeOut();
}, 5000);

// Show Category Form with Ajax Request
$('.open-popup').on('click', function () {

    let btn = $(this);
    let url = btn.data('target');
    let modalTarget = btn.data('modal-target');
    
    // remove the target from the page
    $(modalTarget).remove();
    $.ajax({
        url: url,
        type: 'POST',
        success: function (html) {
            $('body').append(html);

            $(modalTarget).show();
            $(modalTarget).modal('show');
        },
    });

    return false;
});


// Send Data with Ajax Request
let flag = false;

$(document).on('click', '.submit-btn', function (e) {

    e.preventDefault();

    if (flag === true) {
        return false;
    }

    let btn = $(this);

    let form = btn.parents('.form');

    let url = form.attr('action');

    let data = new FormData(form[0]);

    let formResults = form.find('#form-results');

    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',

        beforeSend: function () {
            flag = true;
            $('button').attr('disabled' , true);
            formResults.removeClass().addClass('alert alert-info').html('جاري الطلب...');

        }, // End BeforeSend Method

        success: function(results) {

            if (results.errors) {
                formResults.removeClass().addClass('alert alert-danger').html(results.errors);
                $('button').removeAttr('disabled');
                flag = false;
            } else if (results.success) {
                formResults.removeClass().addClass('alert alert-success').html(results.success);
            }

            if (results.redirectTo) {
                window.location.href = results.redirectTo;
            }

        }, // End Success Method

        cache: false,
        processData: false,
        contentType: false,

    });   // End Ajax Request

}); // End Click the Submit Button

/* Deleting */

$('.delete').on('click', function (e) {

    e.preventDefault();

    let button = $(this);

    let c = confirm('هل انت متأكد من اتمام عملية الحذف ..؟');

    if (c === true) {
        // Start Deleting
        $.ajax({
            url: button.data('target'),
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function () {
                $('#results').removeClass().addClass('alert alert-info').html('جاري الحذف ...!');
            },
            success: function(results) {
                if (results.success) {
                    $('#results').removeClass().addClass('alert alert-success').html(results.success);
                    let tr = button.parents('tr');

                    tr.fadeOut(function () {
                        tr.remove();
                    });
                }
            }
        });
    } else {
        return false;
    }
});

// Close Popup
document.addEventListener('click',(e) =>{
    if(e.target.className === 'close-button'){
        // Remove the Current Popup
        e.target.parentNode.remove();
        // Remove the Overlay
        document.querySelector('.popup-overlay').remove();
    }
});