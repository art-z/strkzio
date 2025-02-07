## STRKZ TRACK
### Установка
 
> git clone https://github.com/art-z/strkzio.git

#### В директории проекта:

> cp .env.example .env 

> docker compose up -d
 
> docker exec -it strkz_api_web bash 

> cd app && composer install  

> php yii migrate
 


Track CRUD: /track 
  
REST API: /api/tracks (доступ по User->accessToken)