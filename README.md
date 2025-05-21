# docker-lamp-phalcon
Docker instalation with apache + php + mysql + phalcon PHP


# Commands for docker 
> enter shell
docker exec -it apache_phalcon bash 

> exec command in terminal
docker exec -it apache_phalcon cat  /usr/local/etc/php

> Docker image stop 
docker-compose down --volumes
> Docker image start 
docker-compose up --build -d