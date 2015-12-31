# DennyDai/D-Bot/Telegram-Bot

Based on [Telegram Bot API](https://core.telegram.org/bots)

## Step 1: Get Your Telegram Bot Token

[How do I create a bot?](https://core.telegram.org/bots#3-how-do-i-create-a-bot)

## Step 2: Set WebHook for Your bot

Run
```
cp Telegram-Bot.php VAR_BOT.php
```
The url of Webhook is https://YourHost/D-Bot/Telegram-Bot.php

Don't know how to set Webhook for Telegram Bot? See it --> [setWebhook](https://core.telegram.org/bots/api#setwebhook)

## Step 3: Add Your Telegram Bot Token to Config.php

```
define('TB_TOKEN', 'YOUR_TELEGRAM_BOT_TOKEN_HERE');
```

And then start your php server and enjoy your bot.

####Have fun :)