# Local Host Setup Instructions

## Quick Start (For Testing)

1. **Install Dependencies**:
   ```bash
   # Install PHP (Mac/Linux)
   brew install php

   # Install Composer
   curl -sS https://getcomposer.org/installer | php
   mv composer.phar /usr/local/bin/composer

   # Install Node.js
   brew install node
   ```

2. **Setup Project**:
   ```bash
   # Install dependencies
   composer install
   npm install

   # Create environment file
   cp .env.example .env
   php artisan key:generate

   # Configure database (using SQLite for simplicity)
   touch database/database.sqlite
   echo "DB_CONNECTION=sqlite" >> .env
   echo "DB_DATABASE=$(pwd)/database/database.sqlite" >> .env
   ```

3. **Run Migrations & Seed Data**:
   ```bash
   php artisan migrate --seed
   ```

4. **Start Development Server**:
   ```bash
   php artisan serve
   ```

5. **Access Application**:
   Open browser to: http://localhost:8000

## Default Test Accounts
- Admin: admin@example.com / password
- User: user@example.com / password

## Testing Key Features
1. **User Registration**:
   - Visit /register
   - Create new account

2. **Business Profile**:
   - Login and visit /profile
   - Upload logo and set business info

3. **Review Page**:
   - Access /review/test-business
   - Submit test review

4. **Admin Dashboard**:
   - Login as admin
   - Visit /admin/dashboard