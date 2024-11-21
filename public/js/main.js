$(document).ready(function () {
    const isLoggedIn = localStorage.getItem('isLoggedIn');

    if (isLoggedIn === 'true') {
        $('#loginButton').hide();
        $('#logoutButton').show();
        $('.action-buttons').show();
    } else {
        $('#logoutButton').hide();
        $('#loginButton').show();
        $('.action-buttons').hide();
    }

    $('#loginButton').on('click', function (e) {
        localStorage.setItem('isLoggedIn', true);
        window.location.reload();
    });

    $('#logoutButton').on('click', function (e) {
        localStorage.setItem('isLoggedIn', false);
        window.location.reload();
    });

    $('#postComment').on('click', function (e) {
        e.preventDefault();

        $.post('/comment', {
            'text': $('#commentForm').find('#message').val(),
            'authorName': $('#commentForm').find('#authorName').val(),
            'newsId': $(e.currentTarget).data('newsId')
        }).done(function () {
            window.location.reload();
        });
    });

    $('#addNews').on('click', function (e) {
        $('#addNewsModal').modal('show');
    });

    $('#saveNews').on('click', function(e) {
        e.preventDefault();

        $.post('/news', {
            'authorName': $('#addNewsModal').find('#authorName').val(),
            'title': $('#addNewsModal').find('#title').val(),
            'description': $('#addNewsModal').find('#description').val(),
            'content': $('#addNewsModal').find('#content').val()
        }).done(function () {
            window.location.reload();
        });
    });

    $('#deleteNews').on('click', function (e) {
        $.ajax({
            type: 'DELETE',
            url: '/news/' + $(e.currentTarget).data('newsId'),
        });
    });
});