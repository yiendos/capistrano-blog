set :stage, :production
set :branch, "master"
set :deploy_to, '/var/www/html/capistrano'

server '33.33.33.71', port: 22, user: 'vagrant', roles: %w{app production}, primary: true