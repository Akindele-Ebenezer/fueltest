# API Documentation

## Overview

FuelTest includes a basic API using Laravel Sanctum for authentication. The API is currently minimal and primarily used for user authentication and basic data access.

## Authentication

The API uses Laravel Sanctum for token-based authentication.

### Sanctum Setup

- Sanctum is configured in `config/sanctum.php`
- Uses personal access tokens for API authentication
- CSRF protection for web routes, token auth for API

## Endpoints

### GET /api/user

**Authentication:** Required (Sanctum token)

**Description:** Returns the authenticated user's information.

**Response:**
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "email_verified_at": null,
  "created_at": "2022-01-01T00:00:00.000000Z",
  "updated_at": "2022-01-01T00:00:00.000000Z"
}
```

**Status Codes:**
- 200: Success
- 401: Unauthenticated

## Future API Expansion

The current API is basic. Potential future endpoints:

### Fuel Test Records API

```
GET    /api/fuel-tests          # List fuel test records
POST   /api/fuel-tests          # Create new fuel test
GET    /api/fuel-tests/{id}     # Get specific fuel test
PUT    /api/fuel-tests/{id}     # Update fuel test
DELETE /api/fuel-tests/{id}     # Delete fuel test
```

### Vendor API

```
GET    /api/vendors             # List vendors
POST   /api/vendors             # Create vendor
GET    /api/vendors/{id}        # Get vendor
PUT    /api/vendors/{id}        # Update vendor
DELETE /api/vendors/{id}        # Delete vendor
```

### User Management API

```
GET    /api/users               # List users (admin only)
POST   /api/users               # Create user (admin only)
GET    /api/users/{id}          # Get user
PUT    /api/users/{id}          # Update user
DELETE /api/users/{id}          # Delete user (admin only)
```

## API Standards

When expanding the API:

- Use RESTful conventions
- Include proper HTTP status codes
- Implement validation and error handling
- Add API versioning (e.g., `/api/v1/`)
- Include pagination for list endpoints
- Use consistent JSON response formats
- Document with OpenAPI/Swagger

## Testing API Endpoints

Use tools like Postman or Insomnia for API testing:

1. Obtain authentication token
2. Include token in Authorization header: `Bearer {token}`
3. Make requests to protected endpoints

## Security

- All API routes protected by `auth:sanctum` middleware
- Input validation on all endpoints
- Rate limiting considerations for production
- CORS configuration in `config/cors.php`