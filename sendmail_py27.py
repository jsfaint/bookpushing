#!/usr/bin/env python
#-*- coding:utf-8 -*-

#Send to Kindle

import sys
import os
from email.mime.multipart import MIMEMultipart
from email.mime.base import MIMEBase
from email.mime.text import MIMEText
from email.utils import parsedate_tz
import smtplib

def sendmail(mail_to, data, filename):
    mail_host = "smtp.gmail.com"
    mail_port = "465"
    mail_from = "kindlepushing@gmail.com"
    mail_username = ""
    mail_password = ""

    if not mail_to:
        raise Exception("receiver is empty")

    msg = MIMEMultipart()
    msg['from'] = mail_from
    msg['to'] = mail_to
    msg['subject'] = 'Convert'
    htmlText = 'Pushed by jason'
    msg.preamble = htmlText
    msgText = MIMEText(htmlText, 'html', 'utf-8')
    msg.attach(msgText)

    att = MIMEText(data, 'base64', 'utf-8')
    att["Content-Type"] = 'application/octet-stream'
    att["Content-Disposition"] = 'attachment; filename="' + filename + '"'
    msg.attach(att)

    mail = smtplib.SMTP_SSL(timeout=60)

    mail.connect(mail_host, int(mail_port))
    mail.ehlo()

    if mail_username and mail_password:
        mail.login(mail_username, mail_password)

    mail.sendmail(msg['from'], msg['to'], msg.as_string())
    mail.close()

if __name__ == '__main__':
    mail_to = sys.argv[1]
    filename = sys.argv[2]

    fp = open(filename, 'rb')
    sendmail(mail_to, fp.read(),  os.path.basename(filename))
    fp.close()
