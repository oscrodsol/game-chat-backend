


<h1 align="center">Chat Videojuegos</h1>

<h4 align="center">Aplicacion web en la que podremos chatear con compañeros en diferentes salas de videojuegos.<h4>

---
# Tech Stack:

Se han utilizado las siguientes tecnologías: <br/><br/>
 <code><img height="50" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain-wordmark.svg" /></code> <code><img  height="50"  src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/heroku/heroku-plain-wordmark.svg"></code> <code><img  height="50"  src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg"></code> 
</a></code> <br/>


## Acerca del proyecto:

Proyecto realizado para el Bootcamp Full Stack Developer de GeeksHubs, donde se pedia realizar una aplicacion web para que compañeros de una misma empresa pudieran contactarse y hacer grupos para jugar a videojuegos.

Puedes acceder a la pagina web desde este link: https://immense-castle-69938.herokuapp.com/api/

## Rutas de backend:

Página de bienvenida: `/` <br/><br/>


Registro de usuario: `/register`<br/>
Login de usuario: `/login`<br/>
Ver el titulo y description de todos los juegos: `/games`<br/>
Busca un juego por su titulo: `/game_by_title/{title}`<br/><br/>

<h4>Rutas con auth:</h4>

Ver tus propios datos de perfil: `/profile`<br/>
Desloguearte de la página: `/logout` <br/>
Modifica tu nick de usuario: `/modify`<br/>
Crea un canal con el id del juego: `/create_channel`<br/>
Unete a un canal conociendo su id: `/join_channel/{id}`<br/>
Deja a un canal al que perteneces conociendo su id: `/leave_channel/{id}`<br/>
Manda un mensaje al canal al que perteneces conociendo su id`/message_by_channel_id/{id}`<br/><br/>

<h4>Rutas con auth y super admin:</h4>

Añade el rol super admin a un usuario conociendo su id: `/user/add_super_admin/{id}`<br/>
Retira el rol super admin a un usuario conociendo su id: `/user/remove_super_admin/{id}`<br/>
Añade el rol admin a un usuario conociendo su id: `/user/add_admin/{id}`<br/>
Retira el rol admin a un usuario conociendo su id: `/user/remove_admin/{id}`<br/>
Crea una categoria de juego: `/create_game`<br/>
Borra una categoria de juego: `/delete_game/{id}`<br/>
Modifica una categoria de juego: `/update_game/{id}`<br/>
Borra a un usuario conociendo su id: `/delete_user_by_id/{id}`<br/>

# Base de datos:

# Tareas pendientes:
  - [ ] 
  - [ ] 
  - [ ] 
  - [ ] 