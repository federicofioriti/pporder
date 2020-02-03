# pporder
Phillip Plein order example

required software:
- composer
- mysql

Installing instructions
- git pull from this repo
- go to root project dir and run "composer install"
- create a new mysql db named pporder
- modify .dev.env with your own db credentials
- from root project, execute ./bin/console doctrine:migrations:migrate
- (if you like mokups) from root project, execute ./bin/console doctrine:fixtures:load
- from root project, execute ./bin/console debug:router to see api endpoints
