import os
import time

import requests

from data import url, username
from commands import *

commands_list_1 = [
    install_plugins,
    clear_cache, copy_beefree_bundle, clear_cache, reload_plugins, copy_email_type_form,
    copy_page_type_form
]

for command in commands_list_1:
    print(f'command is executed: "{command}"')
    os.system(command)
    time.sleep(1)


with open(f'script_template.sql', 'r') as f:
    text = f.read()
    text = text.replace('user_example', username)
    text = text.replace('username_length', str(len(username)))
with open(f'script.sql', 'w') as f:
    f.write(text)


status_code = requests.get(url).status_code
print(f"RESPONSE STATUS CODE: {status_code}")
if status_code != 200:
    print('enter the correct url')


commands_list_2 = [
    sql_query_config_beefree_bundle, clear_cache, schema_update, chown
]

for command in commands_list_2:
    print(f'command is executed: "{command}"')
    os.system(command)
    time.sleep(1)
