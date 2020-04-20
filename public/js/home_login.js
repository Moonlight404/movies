const app = new Vue({
    el: "#app",
    data: {
        maxBackground: 20,
        randomBack: 0,
        paginaAtual: { 'pagina': 'home' },
        authOptions: [
            {
                'pagina': 'login',
                'icon': 'fas fa-sign-in-alt',
                'name': 'Fazer login'
            },
            {
                'pagina': 'register',
                'icon': 'fas fa-sign-out-alt',
                'name': 'Fazer um registro'
            },
        ],
        login: {
            "email": "",
            "password": ""
        },
        register: {
            "email": "",
            "password": ""
        }
    },
    created() {
        this.randomBack = Math.floor(Math.random() * this.maxBackground) + 1;
    },
    methods: {
        mudarPagina(pagina) {
            this.paginaAtual = pagina;
            $("input").removeClass("error");
        },
        registrar() {
            if (this.register.email.length > 0 && this.register.password.length > 0) {
                $.ajax({
                    method: 'post',
                    url: '/api/users/newUser',
                    data: `email=${this.register.email}&password=${this.register.password}`,
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'error' || data == 'email_found') {
                            $("input").addClass("error");
                        } else {
                            var d = new Date;
                            d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * 2);
                            document.cookie = "token" + "=" + data + ";path=api/users;expires=" + d.toGMTString();
                            document.location.reload(true);
                        }
                    },
                    error: function (argument) {

                    }
                });
            } else {
                $("input").addClass("error");
            }
        },
        logar() {
            if (this.login.email.length > 0 && this.login.password.length > 0) {
                $.ajax({
                    method: 'post',
                    url: '/api/users/login',
                    data: `email=${this.login.email}&password=${this.login.password}`,
                    dataType: 'json',
                    success: function (data) {
                        if (data == 'error') {
                            $("input").addClass("error");
                        } else {
                            var d = new Date;
                            d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * 2);
                            document.cookie = "token" + "=" + data + ";path=api/users;expires=" + d.toGMTString();
                            document.location.reload(true);
                        }
                    },
                    error: function (argument) {

                    }
                });
            } else {
                $("input").addClass("error");
            }
        }
    }
})