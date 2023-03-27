var app = new Vue({
    el: '#validate',
    data:{
        forValidation: {username: '', password: '', firstname:'', lastname:'', email:'', website:''},
        errorUsername: "",
        errorPassword: "",
        errorFirstname: "",
        errorLastname: "",
        errorEmail: "",
        errorWebsite: "",
        successMessage: ""
    },

    methods:{
        validateInput: function(){
            var valForm = app.toFormData(app.forValidation);
            axios.post('test.php', valForm)
                .then(function(response){
                    //console.log(response);
                    if(response.data.username){
                        app.errorUsername = response.data.message;
                        app.focusUsername();
                    }
                    else if(response.data.password){
                        app.errorPassword = response.data.message;
                        app.errorUsername = '';
                        app.focusPassword();
                    }
                    else if(response.data.firstname){
                        app.errorFirstname = response.data.message;
                        app.errorUsername = '';
                        app.errorPassword = '';
                        app.focuFirstname();
                    }
                    else if(response.data.lastname){
                        app.errorLastname = response.data.message;
                        app.errorUsername = '';
                        app.errorPassword = '';
                        app.errorFirstname = '';
                        app.focusLastname();
                    }
                    else if(response.data.email){
                        app.errorEmail = response.data.message;
                        app.errorUsername = '';
                        app.errorPassword = '';
                        app.errorFirstname = '';
                        app.errorLastname = '';
                        app.focusEmail();
                    }
                    else if(response.data.website){
                        app.errorWebsite = response.data.message;
                        app.errorEmail = response.data.message;
                        app.errorUsername = '';
                        app.errorPassword = '';
                        app.errorFirstname = '';
                        app.errorLastname = '';
                        app.errorEmail = '';
                        app.focusWebsite();
                    }
                    else{
                        app.successMessage = response.data.message;
                        app.errorUsername = '';
                        app.errorPassword = '';
                        app.errorFirstname = '';
                        app.errorLastname = '';
                        app.errorEmail = '';
                        app.errorWebsite = '';
                    }
                });
        },

        focusUsername: function(){
            this.$refs.username.focus();
        },

        focusPassword: function(){
            this.$refs.password.focus();
        },

        focusFirstname: function(){
            this.$refs.firstname.focus();
        },

        focusLastname: function(){
            this.$refs.lastname.focus();
        },

        focusEmail: function(){
            this.$refs.email.focus();
        },

        focusWebsite: function(){
            this.$refs.website.focus();
        },

        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },

        clearMessage: function(){
            app.successMessage = '';
        }

    }
});