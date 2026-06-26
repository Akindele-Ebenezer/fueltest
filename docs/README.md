# FuelTest Web Application Documentation

## Overview

FuelTest is a Laravel-based web application designed for managing fuel testing records. It allows users to create, view, edit, and export fuel test data, manage vendors and users, and generate PDF certificates.

## Technologies Used

- **Backend**: Laravel 9.x, PHP 8.0+
- **Frontend**: JavaScript, CSS/Sass, Laravel Mix
- **Database**: MySQL (via Laravel migrations)
- **Libraries**:
  - Laravel Sanctum for API authentication
  - Maatwebsite Excel for data export
  - Codedge Laravel FPDF for PDF generation
  - Axios for HTTP requests
  - JS Loading Overlay for UI feedback

## Features

- User authentication and role management
- Fuel test record creation and management
- Vendor management
- Data export to Excel
- PDF certificate generation
- Statistics and insights dashboard
- Filtering and searching capabilities

## Setup Instructions

### Prerequisites

- PHP 8.0 or higher
- Composer
- Node.js and npm
- MySQL database
- XAMPP or similar web server (since it's in htdocs)

### Installation

1. **Clone or copy the project** to your web server directory (e.g., `C:\xampp\htdocs\Fueltest`)

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Environment Configuration**:
   - Copy `.env.example` to `.env`
   - Update database credentials in `.env`:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=fueltest
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Seed Database (if seeders exist)**:
   ```bash
   php artisan db:seed
   ```

8. **Build Frontend Assets**:
   ```bash
   npm run dev
   ```
   Or for production:
   ```bash
   npm run prod
   ```

9. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
   Or access via your web server (e.g., `http://localhost/Fueltest`)

### Additional Setup Notes

- Ensure your web server has write permissions to `storage/` and `bootstrap/cache/`
- For PDF generation, ensure the `fpdf` library is properly configured
- Timezone is set to 'Africa/Lagos' in the application

## Usage

### User Roles

- **Admin**: Full access to all features
- **User**: Limited access based on permissions

### Main Features

1. **Login**: Access the application via the home page
2. **Create Fuel Test**: Add new fuel test records
3. **View Records**: Browse previous and all records
4. **Edit Records**: Modify existing test data
5. **Manage Vendors**: Add and update vendor information
6. **Manage Users**: Admin functionality for user management
7. **Export Data**: Download records as Excel files
8. **Generate Certificates**: Create PDF certificates for tests
9. **Statistics**: View insights and charts

## Development

### Running Tests

```bash
php artisan test
```

### Building Assets

For development:
```bash
npm run dev
```

For production:
```bash
npm run prod
```

Watch for changes:
```bash
npm run watch
```

### Code Style

Follow Laravel coding standards and PSR-4 autoloading.

## Deployment

1. Ensure all dependencies are installed
2. Run migrations on production database
3. Build production assets
4. Set proper file permissions
5. Configure web server (Apache/Nginx) to point to `public/` directory

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make changes following the existing code style
4. Add tests if applicable
5. Submit a pull request

## License

This project is licensed under the MIT License.