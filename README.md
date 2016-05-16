# taskmanager
1. php artisan session:table

2. composer dump-autoload

3. php artisan migrate

4. cd to taskmanager root folder,run this command

'sudo npm install express ioredis socket.io --save'

5. Then create /etc/init/taskmanager.conf with the following script

####################################################################################################
'''
description "taskmanager nodejs app server"
author      "Marlon Dizon"

start on started mountall
stop on shutdown
respawn
respawn limit 99 5

script
    
    export HOME="/root"
    exec /usr//bin/nodejs /vagrant/testsite1/socket.js >> /var/log/node.log 2>&1

end script

post-start script
 
end script
'''
####################################################################################################

6. Then create /etc/init/redis-server.conf with the following script:

####################################################################################################

description "redis server"

start on runlevel [23]
stop on shutdown

exec sudo -u redis /usr/bin/redis-server /etc/redis/redis.conf

respawn

####################################################################################################



7. Adding port to firewall

sudo ufw allow 6379/tcp
sudo ufw allow 3001/tcp
sudo ufw allow 3000/tcp



Troubleshoot:

1. If you cant access login page, execute this in terminal
	
	sudo a2enmod rewrite && sudo service apache2 restart
