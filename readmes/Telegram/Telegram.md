DennyDai/D-Bot
==============================
a php bot


Requirements
------------
 - a running [telegram-cli](https://github.com/vysheng/tg/) listening on a unix-socket (`-S`) or a port (`-P`). Needs to be configured already (phone-number, etc.).
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
