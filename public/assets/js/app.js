$(document).ready(function () {
    $('#image', '#create-task-form').on('change', function () {
        var data = new FormData();
        var file = $('#create-task-form').find('#image')[0].files[0];
        data.append('image', file);

        $.ajax({
            type: 'POST',
            url: '/image/upload',
            data: data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response) {
            $('#preview-modal').find('.card-img-top').attr('src', response.url);
        }).fail(function (XHR) {
            alert(XHR.responseText);
            console.log(XHR);
        });
    });

    $('#preview-modal').on('show.bs.modal', function (e) {
        $modal = $(e.target);
        var $form = $('#create-task-form');

        var text = $form.find('#content').val();
        $modal.find('.card-text').text(text);

        var username = $form.find('#username').val();
        $modal.find('.card-footer .username').text(username);

        var email = $form.find('#email').val();
        $modal.find('.card-footer .email').text(email);
    });

    $('#preview-save-btn').on('click', function () {
        $('#create-task-form').submit();
    });

    $('#view-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var data = button.data();
        var $modal = $(this);
        var badgeHtml;

        if (data.status === 1) {
            badgeHtml = '<span class="badge badge-success">done</span>';
        } else {
            badgeHtml = '<span class="badge badge-warning">pending</span>';
        }

        $modal.find('.modal-title .status').html(badgeHtml);

        $modal.find('.card-img-top').attr('src', data.img);
        $modal.find('.card-text').text(data.text);
        $modal.find('.card-footer .username').text(data.user);
        $modal.find('.card-footer .email').text(data.email);
    })
});