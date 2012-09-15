#publier

A simple CMS written in Symfony2 using Sqlite.



## Installation

1. cd PATH_TO_WEB_ROOT
2. git clone http://github.com/aletzo/publier.git publier
3. chmod -R 777 app/db app/db/DATABASE_FILE app/cache app/logs
4. go to http://localhost/publier in a web browser



## how to clear cache
==================

1. rm -rf app/cache app/logs
2. mkdir app/cache app/cache/dev app/cache/prod
3. chmod -R 777 app/cache app/cache/dev app/cache/prod

