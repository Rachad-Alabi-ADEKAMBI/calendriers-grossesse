var app = new Vue({
    el: '#validate',
    data:{
        forValidation: {username: '', password: ''},
        successMessage: "",
        errorMsg: ""
    },
    methods:{
        validateInput: function(){
            if (!this.forValidation.username && !this.forValidation.password) {
                // If neither input is filled, show an error message
                this.errorMsg = "Veuillez definir la date des dernières règles ou celle de conception";
                return;
            }
            var valForm = app.toFormData(app.forValidation);
            axios.post('action.php', valForm)
                .then(function(response){
                        app.successMessage = response.data.message;
                        app.errorMsg = '';
                });
        }
    }
});
