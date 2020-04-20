var enter = new Audio("./audio/cross-enter.mp3");
var light = new Audio("./audio/same-light.mp3");
var toggle = new Audio("./audio/same-toggle.mp3");
var block = new Audio("./audio/same-heavy.mp3");
var air = new Audio("./audio/airstream_move.mp3");

function getCookie(name) {
    function escape(s) { return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1'); };
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
}

const js = new Vue({
    el: "#app",
    data: {
        linkAtual: "home",
        links: [
            {
                "name": "search",
                "icon": "fas fa-search",
            },
            {
                "name": "home",
                "icon": "fas fa-home",
            },
            {
                "name": "user",
                "icon": "fas fa-user-circle",
            },
            {
                "name": "settings",
                "icon": "fas fa-cog",
            },
            {
                "name": "logout",
                "icon": "fas fa-sign-out-alt",
            },
        ],
        sonsAtivo: true,
        reproducaoAuto: true,
        abaAtivaSettings: 'sons',
        darkMode: true,
        me: {}
    },
    created() {
        $.ajax({
            method: 'post',
            url: '/api/movies/listarMovies',
            dataType: 'json',
            success: function (data) {
                console.log(data)
            },
            error: function (argument) {

            }
        });
        const sonsAti = localStorage.getItem('sonsAtivo');
        const reproducaoAut = localStorage.getItem('reproducaoAuto');
        const dark = localStorage.getItem('darkMode');
        if (sonsAti == 'true') {
            this.sonsAtivo = true;
        } else {
            this.sonsAtivo = false;
        }
        if (reproducaoAut == 'true') {
            this.reproducaoAuto = true;
        } else {
            this.reproducaoAuto = false;
        }
        if (dark == 'true') {
            this.darkMode = true;
        } else {
            this.darkMode = false;
        }
    },
    methods: {
        acess(link) {
            if (link.name == 'logout') {
                var d = new Date;
                d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * 2);
                document.cookie = "token" + "=" + "" + ";path=api/users;expires=" + d.toGMTString();
                document.location.reload(true);
            } else {
                if (this.sonsAtivo) {
                    air.play();
                }
                this.linkAtual = link.name;
            }
        },
        reproducaoAutoAtivar() {
            this.reproducaoAuto = true;
            localStorage.setItem("reproducaoAuto", "true");
        },
        reproducaoAutoDesativar() {
            this.reproducaoAuto = false;
            localStorage.setItem("reproducaoAuto", "false");
        },
        sonsAtivoAutoDesativar() {
            this.sonsAtivo = false;
            localStorage.setItem("sonsAtivo", "false");
        },
        sonsAtivoAtivar() {
            this.sonsAtivo = true;
            localStorage.setItem("sonsAtivo", "true");
        },
        ativarDarkMode() {
            this.darkMode = true;
            localStorage.setItem("darkMode", "true");
        },
        desativarDarkMode() {
            this.darkMode = false;
            localStorage.setItem("darkMode", "false");
        }
    }
})