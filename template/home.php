<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardel</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
</head>
<body>
   <div id="app" class="home_notlogged">
    <div class="background" :style="{backgroundImage: `url(img/back/${randomBack}.png)`}">
    <div class="center">
        <h1>Hardel</h1>
        <h2>Bem-vindo <br> Faça o login. É gratuito.</h2>
        <h2>Veja filmes e séries online.</h2>
        <div class="right none" :class="{centralizar  : paginaAtual.pagina == 'home'}">
            <button v-for="auth in authOptions" @click="mudarPagina(auth)"> <div class="icon"><i :class="auth.icon"></i></div> 
            {{ auth.name }}
        </button>
        </div>
        <div class="right auth none" :class="{centralizar  : paginaAtual.pagina == 'login'}">
             <div @click="paginaAtual= { 'pagina': 'home' }" class="back"><i class="fas fa-long-arrow-alt-left"></i></div>
            <form v-on:submit.prevent="logar">
            <h1>Faça login</h1>
           <div class="input">
                <label for="email">E-mail</label>
                <input v-model="login.email" name="email" type="email">
           </div>
            <div class="input">
            <label for="pass">Senha</label>
            <input v-model="login.password" name="pass" type="password">
            </div>
            <div class="input">
                <button><div class="icon"><i class="fas fa-sign-in-alt"></i></div> Entrar</button>
            </div>
            </form>
        </div>
         <div class="right auth none" :class="{centralizar  : paginaAtual.pagina == 'register'}">
             <div @click="paginaAtual= { 'pagina': 'home' }" class="back"><i class="fas fa-long-arrow-alt-left"></i></div>
            <form v-on:submit.prevent="registrar">
            <h1>Faça registro</h1>
           <div class="input">
                <label for="email">E-mail</label>
                <input v-model="register.email" name="email" type="email">
           </div>
            <div class="input">
            <label for="pass">Senha</label>
            <input v-model="register.password" name="pass" type="password">
            </div>
            <div class="input">
                <button><div class="icon"><i class="fas fa-sign-out-alt"></i></div> Registrar</button>
            </div>
            </form>
        </div>
    </div>
    </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <script src="js/home_login.js"></script>
</body>
</html>