<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardel - Dashboard </title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
</head>
<body>
   <div id="app" 
   class="home_logged"
   :class="{lightMode : !darkMode}">
    <div class="left">
        <div @click="acess(link)" v-for="link in links">
            <li  :class="{ativo: link.name == linkAtual}">
                    <i :class="link.icon"></i>
            </li>
        </div>
    </div>

    <div class="center_b">
        <div class="settings" v-if="linkAtual == 'settings'">
            <h1>Configurações</h1>
            <div class="left_c">
                <li :class="{ativo: abaAtivaSettings == 'sons'}" @click="abaAtivaSettings = 'sons'">Sons</li>
                <li :class="{ativo: abaAtivaSettings == 'repro'}" @click="abaAtivaSettings = 'repro'">Reprodução automática</li>
            </div>
            <div class="center_c" v-if="abaAtivaSettings == 'sons'">
                <div class="icon">
                    <i class="fas fa-volume-up"></i>
                </div>
                <h2>Ativar e desativar sons do app</h2>
                <button @click="sonsAtivoAtivar" :class="{iconAtivoSom: sonsAtivo}">
                    Ativar <div v-if="sonsAtivo" class="icon"><i class="fas fa-check"></i></div> </button>
                <button @click="sonsAtivoAutoDesativar" :class="{iconAtivoSom: !sonsAtivo}">
                    Desativar <div v-if="!sonsAtivo" class="icon"><i class="fas fa-check"></i></div> </button>
            </div>
             <div class="center_c" v-if="abaAtivaSettings == 'repro'">
                <div class="icon">
                    <i class="fas fa-backward"></i>
                </div>
                <h2>Ativar reprodução automática</h2>
                <button @click="reproducaoAutoAtivar" :class="{iconAtivoSom: reproducaoAuto}">
                    Ativar <div v-if="reproducaoAuto" class="icon"><i class="fas fa-check"></i></div> </button>
                <button @click="reproducaoAutoDesativar" :class="{iconAtivoSom: !reproducaoAuto}">
                    Desativar <div v-if="!reproducaoAuto" class="icon"><i class="fas fa-check"></i></div> </button>
            </div>
        </div>
        <div class="settings" v-if="linkAtual == 'user'">
            <h1>Meu perfil</h1>
            <div class="left_c">
                <li class="ativo">Configurações</li>
            </div>
            <div class="center_c">
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
                <h2>Aivar e desativar Night mode</h2>
                <button @click="ativarDarkMode" :class="{iconAtivoSom: darkMode}">
                    Ativar <div v-if="darkMode" class="icon"><i class="fas fa-check"></i></div> </button>
                    <button @click="desativarDarkMode" :class="{iconAtivoSom: !darkMode}">
                    Desativar <div v-if="!darkMode" class="icon"><i class="fas fa-check"></i></div> </button>
            </div>
        </div>
    </div>

   </div>
   <script src="https://cdn.jsdelivr.net/npm/vue"></script>
   <script src="js/dashboard.js"></script>
</body>
</html>