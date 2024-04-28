var Category = Backbone.Model.extend({
    urlRoot: '/categories/index'
});

var CategoriesCollection = Backbone.Collection.extend({
    model: Category,
    url: '/categories/index'
});

var CategoryView = Backbone.View.extend({
    // Your code for single category view
});

var CategoriesView = Backbone.View.extend({
    // Your code for categories view
});

var Category = Backbone.Model.extend({
    urlRoot: '/categories'
});

var CategoryCollection = Backbone.Collection.extend({
    model: Category,
    url: '/categories'
});


// Instantiate your collection and views here
var categories = new CategoriesCollection();
var categoriesView = new CategoriesView({ collection: categories });
