namespace :thatsallfolks do

  task :symlink do
    on roles(:app) do
        execute "ln -sfn /var/www/html/capistrano/current/code/index.html /var/www/html/index.html"
    end
  end

  task :finish do
      warn(File.read(File.join(File.dirname(__FILE__), 'ascii')));
  end
end