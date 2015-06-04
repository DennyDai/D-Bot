#coding:utf-8
import tgl
import urllib
import urllib2

def on_msg_receive(msg):
	params = urllib.urlencode({'from': msg.src.name.encode("UTF-8"), 'text': msg.text.encode("UTF-8"), 'to': msg.dest.name.encode("UTF-8")})
	f = urllib.urlopen("[your BOT.php Url Here]?%s" % params)
	print f.read()

tgl.set_on_msg_receive(on_msg_receive)