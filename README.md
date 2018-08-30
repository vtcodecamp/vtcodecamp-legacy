# Vermont Code Camp

This is the source code for the vtcodecamp.org website.

## Developing

Development of this web application is done using [VirtualBox](https://www.virtualbox.org/) 
and [Vagrant](http://vagrantup.com/). To set up your own local development environment:

1. Install [VirtualBox](https://www.virtualbox.org/)
2. Install [Vagrant](http://vagrantup.com/)
3. Add the [puphpet/centos65-x64](https://app.vagrantup.com/puphpet/boxes/centos65-x64) box with `virtualbox` as the provider (if not already on your system):  
`vagrant box add puphpet/centos65-x64`
4. Bring up the virtual machine (from the root of this project):  
`vagrant up`
5. The project should now be available on `localhost` port `2611`:  
`http://localhost:2611/`

If localhost says "Site Can't be Reached", check that Apache is running
1. ssh into vagrant 
`vagrant ssh`
2. Check httpd status
`sudo service httpd status`
3. If httpd is stopped, start it:
`sudo service httpd start`

To run a build manually (with the virtual machine already running):

1. SSH in to the virtual machine:  
`vagrant ssh`
2. Change to the vagrant directory:  
`cd /vagrant`
3. Run the build command:  
`/usr/bin/php /vagrant/admin.php events:build`

## Deploying

This web application is configured for deployment on [Heroku](https://www.heroku.com/).

Based on the current configuration, deployment is simply a matter of pushing the `master` branch of your clone of the Git repository for this project to the GitHub repository. 

When the application is set up on Heroku, the following environment variables must be created:

* `TWIG_CACHE`: `var/twig`
* `DATA_CACHE`: `var/data`
