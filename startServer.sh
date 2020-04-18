#!/bin/sh
cd /var/www/library/
nohup ./ngrok start --all --config ./ngrok.yml &
cd frontend/
sudo yarn install
nohup yarn start &
echo 'FRONTEND URL: $PATH'
echo 'BACKEND URL: $HOME'


