var Categories = Backbone.Collection.extend({
    model: Category,
    url: '/categories/get_categories'
});
