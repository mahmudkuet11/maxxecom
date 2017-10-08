Configuration
===

* make `.env` and set all variables defined in `.env.example` file.
* set `upload_max_filesize = 32M` in php.ini
* run `composer update`
* copy file of ebay categories in `/public/upload/category` directory
* run `php artisan migrate:refresh --seed`
