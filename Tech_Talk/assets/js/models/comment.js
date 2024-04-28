var Comment = Backbone.Model.extend({
    urlRoot: function() {
        return '/comments/create/' + this.get('post_id');
    }
});
