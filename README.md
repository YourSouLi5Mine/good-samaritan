# Buen Samaritano

Un proyecto de ruby para tener una red de vigilantes en el vecindario.

## API

- PHP 7
- Lumen 1
- PostgreSQL 11

### Requerimientos

- [ ] Endpoints [documentacion](https://github.com/mpociot/laravel-apidoc-generator)
- [ ] [JWT](https://github.com/tymondesigns/jwt-auth)
- [ ] [Roles](https://medium.com/@cvallejo/autenticaci%C3%B3n-de-usuarios-y-roles-en-laravel-5-5-97ab59552d91)
- [x] Usuario
  - Index | Get | /users
  - Create | Post | /signup
  - Update | Put | /users/:id
  - Delete | Delete | /users/:id
- [x] Grupo CRUD
  - Index | Get | /groups
  - Create | Post | /groups
  - Show | Get | /groups/:id
  - Update | Put | /groups/:id
  - Delete | Delete | /groups/:id
- [x] Publicacion CRUD
  - Index | Get | /posts
  - Create | Post | /posts
  - Update | Put | /posts/:id
  - Delete | Delete | /posts/:id
- [ ] UsersGroup CRUD
  - Index | Get | /users_group
  - Create | Post | /users_group
  - Update | Put | /users_group/:id
  - Delete | Delete | /users_group/:id
- [x] Seeds y factories
- [ ] Test unitarios
- [ ] Lanzamiento

## Front-end

- React.js
- Ant Design

### Checklist

- [ ] Vista del crear cuenta
- [ ] Vista del iniciar sesion
- [ ] Configuracion de usuario
- [ ] Noticias (new feed)
- [ ] Noticias por grupos
- [ ] Notificaciones

## Mobile app

- React Native

### Checklist

- [ ] Vista del crear cuenta
- [ ] Vista del iniciar sesion
- [ ] Configuracion de usuario
- [ ] Noticias (new feed)
- [ ] Noticias por grupos
- [ ] Notificaciones
