DennyDai/D-Bot
==============================
A PHP Chat Bot

Requirements
------------
 - A running [telegram-cli](https://github.com/vysheng/tg/) listening on a unix-socket (`-S`) or a port (`-P`). Needs to be configured (phone-number, etc.) before this progarm runs.
 - php >= 5.3.0

Usage
-----

###Setup telegram-cli
[telegram-cli](https://github.com/vysheng/tg/) needs to be installed.

Then

    ./bin/telegram-cli  -s [onmessage.lua Path Here] -dWS /tmp/tg.sck &

Finally,

    chmod 0777 /tmp/tg.sck

If you never started telegram-cli before, you need to start it first in normal mode, so you can type in your telegram-phone-number and register it, if needed (`./bin/telegram-cli`).

If you are using this program under root permission and the telegram-cli failed to switch to 'telegramd', you can use "-U root" as one of the arguments.
