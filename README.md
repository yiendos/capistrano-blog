# capistrano-blog

This repository is designed to be used in conjunction with the associated blog post {{enter blog post}} and make use of the `Joomlatools Vagrant` box: 

You should have this already configured and have running `vagrant up` 

You will need to be able to `ssh vagrant@33.33.33.58` as well as set up a port forwarding to the vagrant box mysql service: 


`ssh -f vagrant@33.33.33.58 -L 3306:127.0.0.1:3306 -N` 


Capistrano is {{}} and this repo in conjunction will with the {{blog post}} will guide you through many of things required for a modern day web app: 

* Ensure that you latest code is deployed
* Along with Database Migration(s)  
* And the ability to install your project dependancies 
