namespace :database do
    desc 'Run the database migrations'
    task :migrate do
        on roles(:app) do
            execute "cd #{ release_path } && vendor/bin/phinx migrate -e development"
        end
    end

    desc 'Rollback the latest database migration'
    task :rollback do
        on roles(:app) do
            execute "cd #{ release_path } && vendor/bin/phinx rollback -e development"
        end
    end
end