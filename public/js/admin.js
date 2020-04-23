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
        linkAtual: "movieadd",
        links: [
            {
                "name": "movieadd",
                "icon": "fas fa-plus-circle",
            },
            {
                "name": "movie",
                "icon": "fas fa-film",
            },
            {
                "name": "logout",
                "icon": "fas fa-sign-out-alt",
            },
        ],
        sonsAtivo: true,
        movieID: "",
        reproducaoAuto: true,
        abaAtivaSettings: 'sons',
        darkMode: true,
        me: {},
        movieAdd: {
            "original_title": "",
            "overview": "",
            "poster_path": "",
            "popularity": 0,
            "backdrop_path": ""
        },
        buscou: false
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
        },
        buscarFilme() {
            $.ajax({
                method: 'post',
                url: '/themovieDB/' + this.movieID,
                dataType: 'json',
                success: function (data) {
                    movieName = data.original_title;
                    overview = data.overview;
                    popularity = data.popularity;
                    backdrop_path = data.backdrop_path;
                    poster_path = data.poster_path;
                    $("#nome").html(movieName);
                    $("#desc").html(overview);
                    $("form .poster").attr('src', `https://image.tmdb.org/t/p/w500/${poster_path}`);
                    $(".viewFilme button").css("display", "block");
                },
                error: function (argument) {

                }
            });
        },
        nothing() {

        }
    }
})