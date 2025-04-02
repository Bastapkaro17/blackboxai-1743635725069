# Google Review System - Testing Instructions

## Local Development Setup

1. **Prerequisites**:
   - PHP 8.0+
   - Composer
   - MySQL/PostgreSQL
   - Node.js (for asset compilation)

2. **Installation**:
   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Running the Server**:
   ```bash
   php artisan serve
   ```

## Testing Checklist

### Authentication
- [ ] Email/password registration
- [ ] Email/password login
- [ ] Google OAuth login (requires setup)
- [ ] Password reset flow

### Business Profile
- [ ] Profile creation
- [ ] Logo upload
- [ ] Business information update
- [ ] Review page URL generation

### Review System
- [ ] Review submission (1-5 stars)
- [ ] Comment submission
- [ ] Google review redirection (for 4-5 stars)
- [ ] Negative review feedback form

### Admin Features
- [ ] Admin login
- [ ] User management
- [ ] Review moderation
- [ ] Dashboard statistics

## Google OAuth Setup
1. Create project in Google Cloud Console
2. Configure OAuth consent screen
3. Create credentials (OAuth client ID)
4. Add to `.env`:
   ```
   GOOGLE_CLIENT_ID=your_client_id
   GOOGLE_CLIENT_SECRET=your_secret
   GOOGLE_REDIRECT_URI=http://your-domain.com/login/google/callback
   ```

## Deployment
1. **Server Requirements**:
   - Web server (Nginx/Apache)
   - PHP 8.0+
   - Database server
   - Queue system (for jobs)

2. **Deployment Steps**:
   ```bash
   composer install --optimize-autoloader --no-dev
   npm run production
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Troubleshooting
- Storage permissions: `chmod -R 775 storage`
- Cache clearing: `php artisan cache:clear`
- Logs: check `storage/logs/laravel.log`