set :application, 'capistrano-blog'
set :repo_url, 'git@github.com:yiendos/capistrano-blog.git'
set :keep_releases, 5

set :log_level, (ENV['LOG_LEVEL'] || :info)
set :pty, false

set :composer_install_flags, '--no-dev --no-interaction --optimize-autoloader'
set :composer_working_dir, -> { fetch(:release_path) }

namespace :deploy do
    before :finishing,  'database:migrate'
    before :finishing_rollback, 'database:migrate'
    after  :deploy,     'thatsallfolks:symlink'
    after  :deploy,     'thatsallfolks:finish'
end
