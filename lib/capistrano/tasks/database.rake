namespace :database do
    desc 'Run the database migrations'
    task :migrate do
        on roles(:app) do

        end
    end

    desc 'Rollback the latest database migration'
    task :rollback do
        on roles(:app) do

        end
    end
end