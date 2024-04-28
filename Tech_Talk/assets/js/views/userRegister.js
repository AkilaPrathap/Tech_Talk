var UserRegisterView = Backbone.View.extend({
    el: '#register-form',
    events: {
        'submit': 'submitRegister'
    },
    submitRegister: function(e) {
        e.preventDefault();
        var userData = {
            name: this.$('#name').val(),
            username: this.$('#username').val(),
            email: this.$('#email').val(),
            password: this.$('#password').val(),
            password2: this.$('#password2').val()
        };
        var user = new User(userData);
        user.save(null, {
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
    var userRegisterView = new UserRegisterView();
});

var UserRegisterView = Backbone.View.extend({
    el: '#register-form',
    events: {
        'submit': 'submitRegister'
    },
    submitRegister: function(e) {
        e.preventDefault();
        var userData = {
            name: this.$('#name').val(),
            username: this.$('#username').val(),
            email: this.$('#email').val(),
            password: this.$('#password').val(),
            zipcode: this.$('#zipcode').val()
        };
        var user = new User(userData);
        user.save(null, {
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
    var userRegisterView = new UserRegisterView();
});
