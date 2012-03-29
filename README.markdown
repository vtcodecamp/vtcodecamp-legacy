# Vermont Code Camp

This is the source code for the vtcodecamp.org website.

## Developing

Development of this web application is done using [VirtualBox](https://www.virtualbox.org/) 
and [Vagrant](http://vagrantup.com/). To set up your own local development environment:

1. Install [VirtualBox](https://www.virtualbox.org/)
2. Install [Vagrant](http://vagrantup.com/)
3. Add the [Minimal CentOS 6.0](http://vagrantbox.es/55/) box (if not already on your system):  
`vagrant box add minimal-centos-60 http://dl.dropbox.com/u/9227672/CentOS-6.0-x86_64-netboot-4.1.6.box`
4. Bring up the virtual machine (from the root of this project):  
`vagrant up`
5. The project should now be available on `localhost` port `2611`:  
`http://localhost:2611/`

## Deploying

This web application is configured for deployment on [Pagoda Box](http://pagodabox.com/). 
This is configured through the file named `Boxfile`. See Pagoda Box's help documentation on 
[Understanding the Boxfile](http://help.pagodabox.com/customer/portal/articles/175475-understanding-the-boxfile).

If you are an application collaborator, then deploying is simply a matter of pushing
your clone of the Git repository for this project. For example, add 
`git@git.pagodabox.com:vtcodecamp-dev.git` as a remote repository and push the 
`master` branch to this repository in order to deploy to the `vtcodecamp-dev.pagodabox.com` 
environment. Again, this will only work of your are a collaborator on this application.
