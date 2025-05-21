### docker-lamp-phalcon
Docker instalation with apache + php + mysql + phalcon PHP

### Commands for docker 
> enter shell
<br>
docker exec -it apache_phalcon bash 

> exec command in terminal
docker exec -it apache_phalcon cat  /usr/local/etc/php

> Docker image stop 
<br>
docker-compose down --volumes

> Docker image start 
<br>
docker-compose up --build -d
