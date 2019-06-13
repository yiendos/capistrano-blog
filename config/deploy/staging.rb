set :stage, :staging
set :branch, "staging"
set :deploy_to, '/var/www/html/capistrano'

server '33.33.33.58', port: 22, user: 'deploy', roles: %w{app staging}