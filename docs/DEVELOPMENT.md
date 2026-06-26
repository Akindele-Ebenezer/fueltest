# Development Guide

## Code Standards

### PHP/Laravel Standards

- Follow PSR-4 autoloading standards
- Use Laravel naming conventions
- Maintain consistent code formatting
- Use meaningful variable and method names
- Add PHPDoc comments for classes and methods

### JavaScript Standards

- Use modern ES6+ syntax where possible
- Consistent indentation (spaces, not tabs)
- Meaningful variable names
- Add comments for complex logic

### CSS/Sass Standards

- Use BEM methodology for class naming
- Organize styles logically
- Use variables for colors, fonts, spacing
- Maintain consistent formatting

## Development Workflow

### Local Development Setup

1. Clone repository
2. Run `composer install`
3. Run `npm install`
4. Copy `.env.example` to `.env`
5. Configure database settings
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `npm run dev` for asset compilation
9. Start development server: `php artisan serve`

### Git Workflow

- Use feature branches for new development
- Write descriptive commit messages
- Pull latest changes before starting work
- Push regularly to avoid conflicts

### Code Reviews

- All changes should be reviewed
- Check for security vulnerabilities
- Ensure code follows standards
- Test functionality thoroughly

## Key Files and Directories

### Controllers

Located in `app/Http/Controllers/`

- **FuelTestController.php**: Main application logic
- **AuthController.php**: Authentication handling
- **PdfController.php**: PDF generation
- **VendorController.php**: Vendor management
- **FuelTestUserController.php**: User management

### Models

Located in `app/Models/`

- **FuelTest.php**: Basic fuel test model
- **FuelTestRecord.php**: Extended fuel test record
- **FuelTestUser.php**: User model
- **Vendor.php**: Vendor model
- **DynamicExport.php**: Export configuration

### Views

Located in `resources/views/`

- Use Blade templating
- Maintain consistent structure
- Include proper escaping

### Routes

- Web routes in `routes/web.php`
- API routes in `routes/api.php`
- Keep routes organized and documented

### Assets

- JavaScript in `resources/js/`
- Sass/CSS in `resources/sass/`
- Compile with Laravel Mix

## Database Operations

### Migrations

- Create migrations for schema changes
- Use descriptive names
- Include rollback functionality
- Test migrations on fresh database

### Seeders

- Use for initial/test data
- Keep separate from migrations
- Document seeder purposes

### Queries

- Use Eloquent when possible
- Raw queries only when necessary
- Include proper error handling
- Consider performance implications

## Testing

### Unit Tests

- Test individual components
- Located in `tests/Unit/`
- Mock external dependencies

### Feature Tests

- Test complete workflows
- Located in `tests/Feature/`
- Test user interactions

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test tests/Unit/ExampleTest.php

# Run with coverage
php artisan test --coverage
```

## Security Best Practices

### Authentication

- Use Laravel's built-in authentication
- Hash passwords properly
- Implement proper session management
- Add rate limiting for login attempts

### Authorization

- Use middleware for route protection
- Implement role-based access control
- Validate user permissions

### Data Validation

- Validate all user inputs
- Use Laravel's validation rules
- Sanitize data before storage
- Prevent SQL injection with Eloquent/Prepared statements

### File Uploads

- Validate file types and sizes
- Store uploads securely
- Prevent directory traversal
- Scan for malware if necessary

## Performance Optimization

### Database

- Use eager loading to prevent N+1 queries
- Add appropriate indexes
- Use pagination for large datasets
- Cache frequently accessed data

### Assets

- Minify and compress assets
- Use CDN for static files
- Implement lazy loading for images
- Bundle and cache assets

### Code

- Avoid unnecessary computations
- Use caching where appropriate
- Optimize database queries
- Profile performance bottlenecks

## Deployment

### Environment Configuration

- Use environment variables for sensitive data
- Different configs for dev/staging/production
- Never commit secrets to version control

### Build Process

```bash
# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run prod

# Run migrations
php artisan migrate --force

# Clear and cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Server Configuration

- Set proper file permissions
- Configure web server (Apache/Nginx)
- Set up SSL certificates
- Configure backup systems

## Troubleshooting

### Common Issues

1. **Permission Errors**
   - Check storage/ and bootstrap/cache/ permissions
   - Use `chmod 755` for directories, `644` for files

2. **Database Connection Issues**
   - Verify .env database settings
   - Check database server status
   - Run `php artisan migrate:status`

3. **Asset Compilation Issues**
   - Clear node_modules and reinstall
   - Check Node.js and npm versions
   - Run `npm run dev` with verbose output

4. **Route/Model Binding Issues**
   - Clear route cache: `php artisan route:clear`
   - Check route definitions
   - Verify model relationships

### Debugging Tools

- Laravel Debugbar for development
- Laravel Telescope for monitoring
- PHP error logs
- Database query logs

## Contributing Guidelines

1. **Issue Tracking**
   - Use GitHub issues for bug reports
   - Include steps to reproduce
   - Provide environment details

2. **Pull Requests**
   - Create feature branch from main
   - Write clear PR description
   - Include tests for new features
   - Update documentation

3. **Code Style**
   - Run PHP CS Fixer if configured
   - Follow established patterns
   - Add comments for complex logic

4. **Documentation**
   - Update docs for API changes
   - Include inline code comments
   - Maintain changelog