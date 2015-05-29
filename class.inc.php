<?php
namespace Telegram;

class Client extends Base
{
    public function __construct($remoteSocket)
    {
        $this->_fp = stream_socket_client($remoteSocket);
        if ($this->_fp === false) {
            throw new ClientException('Could not connect to socket "' . $remoteSocket . '"');
        }
        stream_set_timeout($this->_fp, 1); //This way fgets() returns false if telegram-cli gives us no response.
    }

    public function __destruct()
    {
        fclose($this->_fp);
    }

    public function exec($command)
    {
        fwrite($this->_fp, str_replace("\n", '\n', $command) . PHP_EOL);

        $answer = fgets($this->_fp); //"ANSWER $bytes" if there is a return value or \n if not
        if (is_string($answer)) {
            if (substr($answer, 0, 7) === 'ANSWER ') {
                $bytes = (int) substr($answer, 7);
                if ($bytes > 0) {
                    $string = trim(fread($this->_fp, $bytes + 1));

                    if ($string === 'SUCCESS') { //For "status_online" and "status_offline"
                        return true;
                    }

                    return $string;
                }
            } else if ($answer === PHP_EOL) { //For commands like "msg"
                return true;
            }
        }

        return false;
    }

    public function encodeUri($var){
        return iconv("gb2312", "UTF-8", $var);
    }


    public function escapeString($var){
        return '"' . addslashes($var) . '"';
    }

    public function escapePeer($peer){
        return str_replace(' ', '_', $peer);
    }


    public function escape($var){
        return escapeString(encodeUri($var));
    }

    public function PluginList($commands, $name){
        global $plugins;
        $plugins[] .= TAG.$commands." ".$name;
    }
}