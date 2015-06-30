<?php
namespace DBot;
class Base
{
	public function exec($command, $data = null)
	{
	    $context = array();
	    if (is_array($data))
	    {
			$opts = array (
			     'http' => array (
			        'method' => 'POST',
			        'header' => "Content-type: application/x-www-form-urlencoded",
			        'content' => http_build_query($data)
			         )
			     );
			$context = stream_context_create($opts);
		}
	    return file_get_contents(TB_API_URL.$command, false, $context);
	}
    public function msg($id, $msg)
    {
        return $this->exec('sendMessage', array('chat_id' =>  $id, 'text' => $msg, 'disable_web_page_preview' => 1));
    }
}

