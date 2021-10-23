# Change to the project directory
cd /var/www/cobtainlife

# use nvm
# nvm use node

# Turn on maintenance mode
php artisan down || true

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull origin master

# Install/update composer dependecies
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
php artisan migrate --force

# Run database seed
# php artisan db:seed

# Clear caches
php artisan cache:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache routes
php artisan route:clear
php artisan route:cache

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Clear and cache views
php artisan view:cache

# Install node modules
# npm ci
yarn install --frozen-lockfile

# Build assets using Laravel Mix
npm run production

# Turn off maintenance mode
php artisan up
