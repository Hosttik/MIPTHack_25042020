#Starting server to public network
    1. go to scripts/ dir
    2. run command "source startPublicServers.sh"
#How stop public network server
    run command `source stopPublicServers.sh`
    
#How intsall php
     1. cd /var/www/library/backend/
     2. sudo docker-compose run --rm backend composer install
     3. sudo docker-compose run --rm backend php /app/init
     4. sudo docker-compose up -d
     5. sudo docker-compose run --rm backend yii migrate     
