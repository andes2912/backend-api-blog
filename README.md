
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

# install passport key
$ php artisan passport:install

# run server
$ php artisan serve
```

## Code for Frontend

Frontend dibagun dengan Nuxt Js, [clone repo](https://github.com/andes2912/frontend-blog).

