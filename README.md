# capistrano-blog

This repository is designed to be used in conjunction with the associated blog post [https://www.joomlatools.com/blog/developer/deploying-a-joomla-site-with-capistrano](https://www.joomlatools.com/blog/developer/deploying-a-joomla-site-with-capistrano) and makes use of the [Joomlatools Vagrant](https://github.com/joomlatools/joomlatools-vagrant/) box 

You should have this already configured and have the box running via `vagrant up` and the box accessible from `http://joomla.box` 

### Why would you use joomlatools-vagrant for capistrano? 

Well you've heard about deploying web applications with capistrano, and you want to jump right in there. But you don't have either a staging or production server set up with the minimum requirements for the project or Capistrano: 

* Ruby version 2.0 or higher on your local machine (MRI or Rubinius)
* A project that uses source control (Git, Mercurial, and Subversion support is built-in)
* The SCM binaries (e.g. git, hg) are needed to check out your project and must be installed on the server(s) you are deploying to
* PHP and composer support
* SSH connectivity to the server via SSH key

Well thankfully the [Joomlatools Vagrant](https://github.com/joomlatools/joomlatools-vagrant/) box is a complete development environment of your dreams! With support for every conceivable add-on or extension you might need for your php project.

The only thing you will have to change on the `joomlatools-vagrant` box is add the ability for you to ssh directly into the box with:
`ssh vagrant@33.33.33.58`

To this end you will have to append the contents of your `~/.ssh/id_rsa.pub` to `/home/vagrant/.ssh/authorized_keys`. 

```
#first copy your public key 
cat ~/.ssh/id_rsa.pub

#login in normally to the vagrant box
vagrant ssh 

#edit ssh authorized keys 
nano /home/vagrant/.ssh/authorized_keys
```


### What is [Capistrano](https://capistranorb.com/): 

    “A remote server automation and deployment tool written in Ruby”.

It can help you with the process of shipping changes from your development environment to staging before releasing them into the live service.

By having automated steps you can be assured of consistent results every time, no more finger trouble. However in the event of problems with your changes you can rollback with ease. 

This repo in conjunction will with the [https://www.joomlatools.com/blog/developer/deploying-a-joomla-site-with-capistrano](https://www.joomlatools.com/blog/developer/deploying-a-joomla-site-with-capistrano) will guide you through many of things required for a modern day web app to deployed successfully: 

* Your site files
* Your database schema and or information
* Updates to project dependencies

With Capistrano you can automate the deployment of all three of changes to your site and result in zero downtime!

### Getting started 

You should clone this repository to the `Projects` folder of your [Joomlatools Vagrant](https://github.com/joomlatools/joomlatools-vagrant/) box. `Projects` is a handy folder on the box because it's contents are mapped to the box `home/vagrant/Projects` meaning they are also available within the box. 

`git clone https://github.com/yiendos/capistrano-blog.git [path/to/your/joomlatools-vagrant/Projects]`

Install the project dependencies:

`cd [path/to/your/joomlatools-vagrant/Projects]/capistrano-blog` 

`composer install`

Install the Capistrano project dependencies:

`bundle install`

Next all we need to do is create a default location for the site files and create the supporting database: 

`vagrant ssh` 

`mkdir /var/www/capistrano-blog` 

`joomla database:install capistrano-blog --sql-dumps=/home/vagrant/Projects/capistrano-blog/db/install.sql`

### Running deploys to the box 

Okie so we jump back out of the vagrant box to the host machine and we are ready to deploy:

`bundle exec cap production deploy`

This will serve up a live version of the website:
`http://joomla.box/capistrano-blog/`

To see the staging version of the website:

`git checkout staging`

`bundle exec cap staging deploy`

Refresh your browser page.

#### So how do you go about rolling back:

* A database migration:

    `bundle exec cap staging database:rollback`

* Changes to the code base and dependencies: 

    `bundle exec cap staging deploy:rollback`

Use both of these commands to return your website back to the initial production ready state.
