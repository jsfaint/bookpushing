#!/usr/bin/env python3
#coding: utf-8
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from email.mime.image import MIMEImage
import sys, os

def sendmail(mail_to, data, filename):
    recipient = mail_to
    smtpserver = 'smtp.gmail.com'
    mail_port = '587'
    subject = 'Convert'

    msgRoot = MIMEMultipart('related')
    msgRoot['subject'] = subject
    msgRoot['from'] = sender
    msgRoot['to'] = recipient

    att = MIMEText(data, 'base64', 'utf-8')
    att["Content-Type"] = 'application/octet-stream'
    att["Content-Disposition"] = 'attachment; filename="' + filename + '"'
    msgRoot.attach(att)

    session = smtplib.SMTP(smtpserver, mail_port)
    session.ehlo()
    session.starttls()
    session.login(username, password)
    session.sendmail(sender, recipient, msgRoot.as_string())
    session.quit()

if __name__ == '__main__':
    mail_to = sys.argv[1]
    filename = sys.argv[2]

    sender = '@gmail.com' #Your gmail account
    username = '' #Gmail username
    password = '' #Gmail password


    fp = open(filename, 'rb')
    sendmail(mail_to, fp.read(), os.path.basename(filename), sender, username, password)
    fp.close()
