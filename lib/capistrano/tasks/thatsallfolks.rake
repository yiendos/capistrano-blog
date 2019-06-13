namespace :thatsallfolks do

  task :symlink do
    on roles(:app) do
        execute "mkdir -p  /var/www/#{ fetch(:application) }"
        execute "ln -sfn /home/vagrant/capistrano/current/code/index.html /var/www/#{ fetch(:application) }"
    end
  end

  task :finish do
      warn(File.read(File.join(File.dirname(__FILE__), 'ascii')))
  end
end