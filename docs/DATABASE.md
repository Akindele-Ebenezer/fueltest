# Database Design

## Overview

The FuelTest application uses MySQL as its database backend with Laravel's Eloquent ORM for data access. The schema is defined through migrations and includes tables for users, fuel test records, vendors, and system data.

## Schema Diagram

```
fuel_test_users
├── id (PK)
├── Name
├── Email (unique)
├── Password (hashed)
├── Status
├── Role
└── timestamps

fuel_test_records
├── id (PK)
├── SampleNo
├── SampleCollectionDate
├── TruckPlateNo
├── TankNo
├── AppearanceResult
├── Color
├── Density
├── FlashPoint
├── Temp
├── WaterSediment
├── Cleanliness
├── DateOfTest
├── uid (FK to fuel_test_users)
├── MadeBy
├── DeliveredTo
├── Remarks
├── VendorName
├── VendorNo
├── ApprovalForUse
└── timestamps

vendors
├── id (PK)
├── VendorNo
├── RecordId (FK to fuel_test_records)
├── VendorName
└── timestamps

dynamic_exports
├── id (PK)
├── (dynamic fields based on export needs)
└── timestamps

users (Laravel default)
├── id (PK)
├── name
├── email
├── email_verified_at
├── password
├── remember_token
└── timestamps

cache, jobs, password_resets (Laravel defaults)
```

## Tables Description

### fuel_test_users

Custom user table for application-specific authentication.

| Field | Type | Description |
|-------|------|-------------|
| id | INT (AUTO_INCREMENT) | Primary key |
| Name | VARCHAR | User's full name |
| Email | VARCHAR | Unique email address |
| Password | VARCHAR | Hashed password |
| Status | INT | User status (active/inactive) |
| Role | VARCHAR | User role (admin/user/etc.) |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Update timestamp |

### fuel_test_records

Main table storing fuel test data.

| Field | Type | Description |
|-------|------|-------------|
| id | INT (AUTO_INCREMENT) | Primary key |
| SampleNo | VARCHAR | Unique sample number |
| SampleCollectionDate | VARCHAR | Date sample was collected |
| TruckPlateNo | VARCHAR | Truck license plate |
| TankNo | VARCHAR | Tank identifier |
| AppearanceResult | VARCHAR | Visual appearance result |
| Color | VARCHAR | Fuel color measurement |
| Density | VARCHAR | Fuel density |
| FlashPoint | VARCHAR | Flash point temperature |
| Temp | VARCHAR | Test temperature |
| WaterSediment | VARCHAR | Water and sediment content |
| Cleanliness | VARCHAR | Cleanliness rating |
| DateOfTest | VARCHAR | Date test was performed |
| uid | VARCHAR | User ID who created record |
| MadeBy | VARCHAR | Person who performed test |
| DeliveredTo | VARCHAR | Delivery recipient |
| Remarks | VARCHAR | Additional notes |
| VendorName | VARCHAR | Associated vendor name |
| VendorNo | VARCHAR | Vendor identifier |
| ApprovalForUse | VARCHAR | Approval status |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Update timestamp |

### vendors

Vendor information linked to fuel test records.

| Field | Type | Description |
|-------|------|-------------|
| id | INT (AUTO_INCREMENT) | Primary key |
| VendorNo | VARCHAR | Unique vendor number |
| RecordId | INT | Foreign key to fuel_test_records |
| VendorName | VARCHAR | Vendor name |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Update timestamp |

### dynamic_exports

Table for handling dynamic export configurations.

| Field | Type | Description |
|-------|------|-------------|
| id | INT (AUTO_INCREMENT) | Primary key |
| (dynamic fields) | Various | Based on export requirements |
| created_at | TIMESTAMP | Creation timestamp |
| updated_at | TIMESTAMP | Update timestamp |

## Relationships

- `fuel_test_records.uid` references `fuel_test_users.id` (many-to-one)
- `vendors.RecordId` references `fuel_test_records.id` (many-to-one)

## Indexes

### Recommended Indexes

```sql
-- For fuel_test_records
CREATE INDEX idx_sample_no ON fuel_test_records (SampleNo);
CREATE INDEX idx_uid ON fuel_test_records (uid);
CREATE INDEX idx_vendor_name ON fuel_test_records (VendorName);
CREATE INDEX idx_sample_collection_date ON fuel_test_records (SampleCollectionDate);

-- For fuel_test_users
CREATE INDEX idx_email ON fuel_test_users (Email);

-- For vendors
CREATE INDEX idx_vendor_no ON vendors (VendorNo);
CREATE INDEX idx_record_id ON vendors (RecordId);
```

## Data Types and Constraints

- All string fields use VARCHAR with appropriate lengths
- Dates are stored as VARCHAR (consider changing to DATE/DATETIME types)
- Numeric fields (Color, Density, etc.) stored as VARCHAR (consider DECIMAL types)
- Foreign key constraints not explicitly defined in migrations
- No unique constraints beyond Email in users table

## Migration Files

Key migration files in `database/migrations/`:

- `2022_05_21_201109_create_fuel_test_users_table.php`
- `2022_05_23_104330_add_columns_to_fuel_test_users.php`
- `2022_07_19_132114_create_vendors_table.php`
- `2022_11_30_074001_create_dynamic_exports_table.php`

## Seeders

Located in `database/seeders/` - check for initial data setup.

## Performance Considerations

- Large datasets: Implement pagination (already done in controllers)
- Frequent queries: Add appropriate indexes
- Data types: Consider using proper numeric types for measurements
- Archiving: Implement data archiving for old records

## Backup Strategy

- Regular database backups
- Export functionality for data migration
- Version control for schema changes

## Future Improvements

1. **Data Type Optimization**:
   - Change date fields to DATE/DATETIME
   - Use DECIMAL for numeric measurements
   - Add proper foreign key constraints

2. **Indexing Strategy**:
   - Add composite indexes for common query patterns
   - Consider full-text search for remarks

3. **Data Integrity**:
   - Add check constraints for valid ranges
   - Implement soft deletes for audit trails

4. **Normalization**:
   - Extract common vendor data to separate normalized table
   - Create lookup tables for status/enum fields