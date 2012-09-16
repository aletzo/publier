#publier

A simple CMS written in Symfony2 using Sqlite.



## Installation

1. cd PATH_TO_WEB_ROOT
2. git clone http://github.com/aletzo/publier.git publier
3. cd publier
4. php composer update
5. mkdir app/db
6. php app/console doctrine
7. chmod -R 777 app/db app/db/DATABASE_FILE app/cache app/logs
8. go to http://localhost/publier in a web browser

### Installation requirements

1. https://github.com/composer/composer


## how to clear cache
==================

1. rm -rf app/cache app/logs
2. mkdir app/cache app/cache/dev app/cache/prod
3. chmod -R 777 app/cache app/cache/dev app/cache/prod

