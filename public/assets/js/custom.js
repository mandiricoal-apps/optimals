

function modalUser(id) {
    $('#modal-md').modal();
    $.ajax({
        type: "get",
        url: "/modal-view-user/" + id,
        beforeSend: function () {
            html = `<div class="text-center"> <div class="spinner-border text-primary " role="status">
            <span class="sr-only">Loading...</span>
          </div></div>`;
            $('#modal-md-body').html(html);

        },
        success: function (response) {
            $('#modal-md-body').html(response);
        }
    });
}
