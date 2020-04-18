import os
import json
import requests

if __name__ == '__main__':
    print('Setting frontend and backend urls')
    response = requests.get('http://127.0.0.1:4040/api/tunnels')

    data = response.json()

    frontend_url = data['tunnels'][0]['public_url']
    backend_url = data['tunnels'][1]['public_url']

    os.environ['FRONTEND_URL'] = frontend_url
    os.environ['BACKEND_URL'] = backend_url

    print('Done.')
