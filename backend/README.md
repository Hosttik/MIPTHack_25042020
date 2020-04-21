#First install php
    1. sudo docker-compose run --rm backend composer install
    2. sudo docker-compose run --rm backend php /app/init
    3. sudo docker-compose up -d
    4. sudo docker-compose run --rm backend yii migrate  

#After u install php run only this
     sudo docker-compose up -d
  

