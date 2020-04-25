#How to run vagrant
    1. vagrant up
    2. vagrant ssh

#Starting server to public network
    1. go to scripts/ dir
    2. run command "source startPublicServers.sh"
#How stop public network server
    run command `source stopPublicServers.sh`
    
#First install php
     1. cd /var/www/library/backend/
     2. docker-compose run --rm backend composer install
     3. docker-compose run --rm backend php /app/init 
     4. choose develop
     5. say yes
     6. say no x3 
     7. docker-compose up -d
     8. docker-compose run --rm backend yii migrate   
     
#After u install php run only this
     docker-compose up -d  
