
## Backend API Blog
### Fitur
- Login
- Register
- Create Category
- Update Category
- Create News
- Update News
- Read News
- Show News By Name (Author)
- Show News By Category
- Error Handle if News, Category Not Found or Empty

### Cara Install
```bash
# install dependencies
$ composer install

# setting .env
$ php artisan cp .env.example .env

# generate key
$ php artisan key:generate

# migrate database
$ php artisan migrate

# install passport key
$ php artisan passport:install

# run server
$ php artisan serve
```

## Contoh Request

```bash
# Request Login
http://127.0.0.1:8000/api/login

Parameter : 
- email
- password

Method : 
- POST
```

```bash
# Request Register
http://127.0.0.1:8000/api/register

Parameter :
- name
- email
- password
- password_confirmation

Method :
- POST
```

```bash
# Request Account
http://127.0.0.1:8000/api/me

Headers :
- Authorzation => Bearer Token

Method
- GET
```

```bash
# Request Category
http://127.0.0.1:8000/api/category

Method :
- GET
```

```bash
# Request Category Store
http://127.0.0.1:8000/api/category

Parameter :
- name

Method :
- POST

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Category Update
http://127.0.0.1:8000/api/category/{slug}

Parameter :
- name
- status

Method :
- PUT

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Category Show
http://127.0.0.1:8000/api/category/{slug}

Method :
- GET
```

```bash
# Request News
http://127.0.0.1:8000/api/news/

Method :
- GET
```

```bash
# Request Store News
http://127.0.0.1:8000/api/news

Parameter :
- title
- content
- category_id

Method :
- POST

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Update News
http://127.0.0.1:8000/api/news/{slug}

Parameter :
- title
- content
- category_id

Method :
- PUT

Headers :
- Authorzation => Bearer Token
```

```bash
# Request Show News
http://127.0.0.1:8000/api/news/{slug}

Parameter :
- title
- content
- category_id

Method :
- GET
```

```bash
# Request News By User Name
http://127.0.0.1:8000/api/news-by-name/{name}

Method :
- GET

```
## Code for Frontend

Frontend dibagun dengan Nuxt Js, [clone repo](https://github.com/andes2912/frontend-blog).

