#coding:utf-8
import tgl
import urllib
import urllib2

def on_msg_receive(msg):
    get="from="+urllib.quote(msg.dest.name)+"&text="+urllib.quote(msg.text)
    url="http://1.vps.dennx.com/onmessage.php?"
    req=urllib2.Request(url+get)
    res=urllib2.urlopen(req).read()
    print res