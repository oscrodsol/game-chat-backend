


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

Página de bienvenida: `api/` <br/><br/>


Registro de usuario: `api/register`<br/>
Login de usuario: `api/login`<br/>
Ver el titulo y description de todos los juegos: `api/games`<br/>
Busca un juego por su titulo: `api/game_by_title/{title}`<br/><br/>

<h4>Rutas con auth:</h4>

Ver tus propios datos de perfil: `api/profile`<br/>
Desloguearte de la página: `api/logout` <br/>
Modifica tu nick de usuario: `api/modify`<br/>
Crea un canal con el id del juego: `api/create_channel`<br/>
Unete a un canal conociendo su id: `api/join_channel/{id}`<br/>
Deja a un canal al que perteneces conociendo su id: `api/leave_channel/{id}`<br/>
Manda un mensaje al canal al que perteneces conociendo su id: `api/message_by_channel_id/{id}`<br/><br/>

<h4>Rutas con auth y super admin:</h4>

Añade el rol super admin a un usuario conociendo su id: `api/user/add_super_admin/{id}`<br/>
Retira el rol super admin a un usuario conociendo su id: `api/user/remove_super_admin/{id}`<br/>
Añade el rol admin a un usuario conociendo su id: `api/user/add_admin/{id}`<br/>
Retira el rol admin a un usuario conociendo su id: `api/user/remove_admin/{id}`<br/>
Crea una categoria de juego: `api/create_game`<br/>
Borra una categoria de juego: `api/delete_game/{id}`<br/>
Modifica una categoria de juego: `api/update_game/{id}`<br/>
Borra a un usuario conociendo su id: `api/delete_user_by_id/{id}`<br/>

# Base de datos:

Ingenieria inversa de las relaciones entre las tablas:

![Diagrama entidad relacion game_chat](https://user-images.githubusercontent.com/66917963/182230679-9b4b1958-4c5e-4d7a-8da5-2d1fcf535896.png)

# Tareas pendientes:
  - [ ] Completar el crud en la parte de usuario.
  - [ ] Completar el crud en la parte de mensajes.
  - [ ] Completar el crud en la parte de canales.
  - [ ] Crear seeder de usuario, canal y juegos.
  - [ ] Añadir ruta donde se filtran los mensajes, canales y juegos a los que pertenece un usuario.
  - [ ] Añadir middleware de admin.
  - [ ] Añadir rutas donde se emplee el middleware admin.
  - [ ] Mejorar la sintaxis y comprension de codigo.
      
