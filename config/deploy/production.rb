set :stage, :production
set :branch, "master"
set :deploy_to, '/home/vagrant/capistrano'

server '33.33.33.58', port: 22, user: 'vagrant', roles: %w{app staging}, primary: true