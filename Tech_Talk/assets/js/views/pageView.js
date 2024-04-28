// assets/js/views/pageView.js
var PageView = Backbone.View.extend({
    el: '#app', // The DOM element to attach the view to

    initialize: function() {
        // Initialize your view here
    },

    render: function() {
        // Render your view content here
        this.$el.html('<h1>Welcome to Tech_Talk Application</h1><p>This is a sample text. You can replace it with your own content.</p>');
        return this;
    }
});

// Export the view
module.exports = PageView;
