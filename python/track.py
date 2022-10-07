from datetime import date
import json
import socket
import requests
import ipaddress

RESULT_PHP_FILE = f'db/{date.today()}.json'
GOOGLE_MAP_URL  = f'https://www.google.com/maps/place/var_lat+var_lon'
API_TOKEN       = { "IPStack": "caea5804cf60e36d8b0cf659c350dd2a" }

def is_ssh_enable():
    ...
def get_hostname(ip):
    try:
        name, _, t = socket.gethostbyaddr(ip)
    except Exception as e:
        name = 'unkwon'
    return name


def get_gps_position(ip):
    try:
        if ipaddress.IPv4Address(ip).is_private != True:
            api_ipstack = f"http://api.ipstack.com/{ip}?access_key={API_TOKEN['IPStack']}"
            response    = requests.get(api_ipstack).json()
            gps_position = f'{GOOGLE_MAP_URL}/{response["latitude"]}+{response["longitude"]}'
    except Exception as e:
        gps_position = 'unkwon'

    return gps_position

def open_result_file():
    response = None
    try:
        with open(RESULT_PHP_FILE, 'r') as result:
            data = json.load(result)
        response = data[-1]
    except FileNotFoundError as e:
        ...
    return response