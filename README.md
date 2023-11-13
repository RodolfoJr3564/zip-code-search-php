# zip-code-search-php

Execultar sem utilizar o docker-compose 

docker build -t custom_postgres ./database

e 

docker run -d -p 5432:5432 custom_postgres







...

docker-compose up -d


docker-compose up -d --build


docker-compose build --no-cache && docker-compose up
