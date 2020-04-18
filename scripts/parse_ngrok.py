import os
import json
import requests

if __name__ == '__main__':
    response = requests.get('http://127.0.0.1:4040/api/tunnels')

    data = response.json()
#     поправить нахождение корретных url, массив data['tunnels'] оказывается не детерминированный
    frontend_url = data['tunnels'][1]['public_url'].replace('https', 'http')
    backend_url = data['tunnels'][0]['public_url'].replace('https', 'http')

    print("{};{}".format(frontend_url,backend_url))
