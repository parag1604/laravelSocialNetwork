$(document).ready(function() {

    var postId = 0,
        isLike = true,
        postBodyElement = null;

    $('.post').find('.interaction').find('.edit').on('click', function(event) {
        event.preventDefault();

        postBodyElement = event.target.parentNode.parentNode.childNodes[1];
        var postBody = postBodyElement.textContent;
        postId = event.target.parentNode.parentNode.dataset['postid'];
        $('#post-body').val(postBody);

        $('#edit-modal').modal();
    });

    $('#modal-save').on('click', function() {
        $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {
                body: $('#post-body').val(),
                postId: postId,
                _token: token
            }
        }).done(function(msg) {
            if(msg['status'] == "success") {
                $(postBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide');
            } else {
                alert(msg['message']);
            }
        }).catch(function(err) {
            alert('Something went wrong, please try again!')
        });
    });

    $('.post').find('.interaction').find('.delete').on('click', function(event) {
        event.preventDefault();
        var answer = confirm("Are you sure you want to delete this post permanently?");
        if(answer == true) {
            window.location = event.target.href;
        }
    });

    $('.like').on('click', function(event) {
        event.preventDefault();
        postId = event.target.parentNode.parentNode.dataset['postid'];
        isLike = event.target.previousElementSibling == null;
        $.ajax({
            method: 'POST',
            url: urlLike,
            data: {
                isLike: isLike,
                postId: postId,
                _token: token
            }
        }).done(function() {
            var temp = null;
            // checking if like or dislike link pressed
            if (isLike) {
                // if like pressed and not previously liked
                if (event.target.innerText == 'Like') {
                    event.target.innerText = 'Liked';
                    event.target.classList.add('like-bold');
                } 
                // if like pressed and previously liked
                else {
                    event.target.innerText = 'Like';
                    event.target.classList.remove('like-bold');
                }
                // boundary condition
                temp = event.target.nextElementSibling;
                temp.innerText = 'Dislike';
                if (temp.classList.contains('like-bold')) {
                    temp.classList.remove('like-bold');
                }
            } else {
                // if dislike pressed and not previously disliked
                if (event.target.innerText == 'Dislike') {
                    event.target.innerText = 'Disliked';
                    event.target.classList.add('like-bold');
                } 
                // if dislike pressed and previously disliked
                else {
                    event.target.innerText = 'Dislike';
                    event.target.classList.remove('like-bold');
                }
                // boundary condition
                temp = event.target.previousElementSibling;
                temp.innerText = 'Like';
                if (temp.classList.contains('like-bold')) {
                    temp.classList.remove('like-bold');
                }
            }
        }).catch(function(err) {
            alert('Something went wrong, please try again!')
        });
    })

});