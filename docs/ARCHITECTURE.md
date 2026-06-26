# Architecture Overview

## Application Structure

FuelTest follows the standard Laravel MVC (Model-View-Controller) architecture with additional service layers.

### Directory Structure

```
app/
├── Charts/           # Chart classes for statistics
├── Console/          # Artisan commands
├── Exceptions/       # Custom exception handlers
├── Exports/          # Excel export classes
├── Http/
│   ├── Controllers/  # Request handling logic
│   └── Middleware/   # HTTP middleware
├── Models/           # Eloquent models
└── Providers/        # Service providers

config/               # Configuration files
database/
├── factories/        # Model factories
├── migrations/       # Database schema definitions
└── seeders/          # Database seeders

public/               # Public assets (CSS, JS, images)
resources/
├── css/             # Stylesheets
├── js/              # JavaScript files
├── sass/            # Sass source files
└── views/           # Blade templates

routes/               # Route definitions
storage/              # File storage
tests/                # Test files
```

## Key Components

### Models

#### FuelTest
- Basic fuel test data model
- Fields: SampleNo, dates, test results, etc.

#### FuelTestRecord
- Extended fuel test record with additional fields
- Includes vendor information and approval status

#### FuelTestUser
- User management for the application
- Fields: Name, Email, Password, Status, Role

#### Vendor
- Vendor information management
- Links to fuel test records

#### DynamicExport
- Handles dynamic data export configurations

### Controllers

#### FuelTestController
Main controller handling:
- Record creation, viewing, editing
- Data export functionality
- Statistics and filtering
- PDF generation

#### AuthController
- User authentication (login/logout)

#### PdfController
- PDF certificate generation using FPDF

#### VendorController
- Vendor CRUD operations

#### FuelTestUserController
- User management operations

### Routes

#### Web Routes (`routes/web.php`)
- Main application routes
- Authentication routes
- CRUD operations for records, vendors, users
- Export and PDF generation routes

#### API Routes (`routes/api.php`)
- Sanctum authenticated API endpoints
- Currently minimal, only user info endpoint

### Views

Located in `resources/views/`
- Blade templates for all pages
- Login, dashboard, forms, reports

### Assets

#### Frontend Build Process
- Uses Laravel Mix for asset compilation
- Source files in `resources/`
- Compiled assets in `public/`

#### JavaScript
- Axios for API calls
- Custom scripts for UI interactions
- Loading overlays for better UX

#### Styles
- Sass for advanced styling
- Custom CSS for application-specific designs

### Database Design

See [DATABASE.md](DATABASE.md) for detailed schema information.

### Authentication

- Custom authentication system
- Session-based login
- Role-based access control
- Uses Laravel's built-in session management

### Export Features

- Excel export using Maatwebsite Excel
- PDF generation using Codedge Laravel FPDF
- Dynamic export configurations

### Charts and Statistics

- Uses Laravel Charts package
- Dashboard with fuel test insights
- Vendor performance metrics

## Data Flow

1. **User Request**: Routes direct to appropriate controllers
2. **Controller Logic**: Handles business logic, database queries
3. **Model Interaction**: Eloquent ORM for database operations
4. **View Rendering**: Blade templates with data
5. **Response**: HTML/JSON returned to user

## Security Considerations

- CSRF protection on forms
- Input validation and sanitization
- Session management
- Role-based permissions
- Secure password hashing

## Performance

- Pagination on large datasets
- Eager loading where appropriate
- Database indexing on key fields
- Asset optimization via Laravel Mix