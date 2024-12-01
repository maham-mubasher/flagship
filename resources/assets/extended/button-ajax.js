$(document).on('click', '.button-ajax', function (e) {
    e.preventDefault();
    var action = $(this).data('action');
    var method = $(this).data('method');
    var csrf = $(this).data('csrf');
    var reload = $(this).data('reload');

    axios.request({
        url: action,
        method: method,
        data: {
            _token: csrf
        },
    })
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        })
        .then(function () {
            if (reload) {
                window.location.reload();
            }
        });
});


$(document).on('click', '.ajax-modal', function (e) {
    e.preventDefault();
    var action = $(this).data('action');

    axios.request({
        url: action,
        method: "get",
        data: {},
    })
        .then(function (response) {

            console.log(response);
            $("#kt_update_address_group_modal").html(response.data)
            const modalEl = document.getElementById("kt_update_address_group_modal");
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(function (error) {
            console.log(error);
        });
});
