<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardel - Admin painel</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
</head>
<body>
   <div id="app" class="home_admin">
    <div class="left mama">
        <div @click="acess(link)" v-for="link in links">
            <li  :class="{ativo: link.name == linkAtual}">
                    <i :class="link.icon"></i>
            </li>
        </div>
    </div>

    <div class="center_b" style="top: 0% !important;">
        <div class="settings" v-if="linkAtual == 'movieadd'">
            <h1>Adicionar</h1>
            <div class="left_c">
                <li class="ativo">Filme</li>
                <li>Serie</li>
                <li>Anime</li>
                </div>
            <div class="center_c" v-if="abaAtivaSettings == 'sons'">
                <div class="icon">
                    <i class="fas fa-film"></i>
                </div>
                <h2>Adicionar filme no app</h2>
                <form v-on:submit.prevent="buscarFilme">
                <input v-model="movieID" type="text" placeholder="MovieID">
                <button style="left: 53%;">Buscar</button>
                </form>
                <h2>Os dados dos filmes preenchera automatico</h2>
                <form class="viewFilme" v-on:submit.prevent="nothing">
                    <img class="poster" src="poster.jpg" alt="">
                    <h1 id="nome">Nome filme</h1>
                    <p id="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur malesuada ipsum at cursus sodales. Curabitur nec nibh ac diam lobortis mollis. Ut id libero sodales erat vulputate rhoncus. Proin et odio a odio rutrum elementum non vitae ex. Suspendisse mollis dictum eros eu molestie. Morbi molestie consequat sagittis. Sed vel nulla faucibus, bibendum lacus a, hendrerit lorem. Aliquam porta, leo eu laoreet maximus, urna augue tempus tortor, quis feugiat massa eros nec neque. Quisque iaculis, arcu non cursus aliquam, risus diam aliquam libero, at lobortis massa sem vel metus.
                    </p>
                    <button style="display: none;">Adicionar filme</button>
                </form>
            </div>
             <div class="center_c" v-if="abaAtivaSettings == 'repro'">
                <div class="icon">
                    <i class="fas fa-backward"></i>
                </div>
    
            </div>
        </div>
    </div>

   </div>
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <script src="js/admin.js"></script>
</body>
</html>