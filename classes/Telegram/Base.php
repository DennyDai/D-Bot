<?php
namespace DBot;
class Base
{
	protected $_fp;
	public function __construct($Socket)
	{
		$this->_fp = stream_socket_client($Socket);
		if ($this->_fp === false) {
			throw new ClientException('Could not connect to socket "' . $Socket . '"');
		}
		stream_set_timeout($this->_fp, 1);
	}
	public function __destruct()
	{
		fclose($this->_fp);
	}
	public function exec($command)
	{
		fwrite($this->_fp, str_replace("\n", '\n', $command) . PHP_EOL);
		$answer = fgets($this->_fp);
		if (is_string($answer)) {
			if (substr($answer, 0, 7) === 'ANSWER ') {
				$bytes = (int) substr($answer, 7);
				if ($bytes > 0) {
					$Response = trim(fread($this->_fp, $bytes + 1));
					return $Response;
				}
			}elseif ($answer === PHP_EOL) {
				return true;
			}
		}
		return false;
	}
	public function escapeStringArgument($argument)
    {
        return '"' . addslashes($argument) . '"';
    }
    public function escapePeer($peer)
    {
        return str_replace(' ', '_', $peer);
    }


    public function msg($peer, $msg)
    {
        $peer = $this->escapePeer($peer);
        $msg = $this->escapeStringArgument($msg);
        return $this->exec('msg ' . $peer . ' ' . $msg);
    }
}