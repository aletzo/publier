#publier

publier: French word for publish ( O tempora o mores! )

A ~~simple CMS~~ blog engine written in Symfony2 using Sqlite.

Sorry world, but I had to do it:

> Every programmer should have a blog, created by one's own blog engine.
>
> The Internet



## Installation

 1. cd PATH_TO_WEB_ROOT
 2. git clone http://github.com/aletzo/publier.git publier
 3. cd publier
 4. php composer update
 5. cp app/config/parameters.yml.tpl app/config/parameters.yml
 6. edit app/config/parameters.yml
 7. mkdir app/db
 8. php app/console doctrine:database:create
 9. chmod -R 777 app/db app/db/DATABASE_FILE app/cache app/logs
10. go to http://localhost/publier in a web browser

### Installation requirements

1. https://github.com/composer/composer


## how to clear cache
==================

1. rm -rf app/cache
2. mkdir app/cache app/cache/dev app/cache/prod
3. chmod -R 777 app/cache app/cache/dev app/cache/prod

