var CommentCreateView = Backbone.View.extend({
    el: '#comment-form',
    events: {
        'submit': 'submitComment'
    },
    submitComment: function(e) {
        e.preventDefault();
        var commentData = {
            name: this.$('#name').val(),
            email: this.$('#email').val(),
            body: this.$('#body').val(),
            post_id: this.$('#post_id').val()
        };
        var comment = new Comment(commentData);
        comment.save(null, {
            success: function(response) {
                // Handle success
            },
            error: function(response) {
                // Handle error
            }
        });
    }
});

$(function() {
    var commentCreateView = new CommentCreateView();
});
