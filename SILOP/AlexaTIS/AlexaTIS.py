from flask import Flask
from flask import request
import linecache
from socket import *
import sys

app = Flask(__name__)

@app.route('/api/')
def Hello_World() :
    index = int(request.args.get('index'))
    action = request.args.get('action')

    i = index*2
    if action == 'turnOn' :
        i=i-1
    print i
    fo = open ("config.txt", 'rb')
    while(i!=1):
        fo.read(33)
        i=i-1
    msg= fo.read(32)
    msg = bytes(msg)
    return(UDPSEND(msg,getIP(index)))

def getIP(index):
    s=linecache.getline('inputFile.dat',index)
    l=s.split()
    return l[1]

def UDPSEND(arg,ip):
    s = socket(AF_INET, SOCK_DGRAM)
    s.bind(('', 6000))
    s.sendto(arg, (ip, 6000))
    s.close()
    return 'hey '

if __name__== '__main__':
    app.run(port = 599)
