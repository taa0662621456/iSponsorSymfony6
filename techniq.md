# iSponsor - it's easy

### Settings. Symfony settings

1. Main language is English
2. Admin is EasyAdmin
3. locales En|Ru|Uk
4. more detail in service.yaml
5.

## Admin panel structure

### Authorisation\Registration

1. by Phone number
2. by Google account
3. by GitHub account
4. by Facebook account
5. by e-mail and password
6. by login and password
7.

### Vendor. Vendor/user table

##### Functions

1. CRUD for admin
2. ***D for superadmin

##### Fields

1. ID
2. SLUG
3. Name
4. F Name
5. S Name
6. Detail (link to detail profile page)

#### Profile page

##### Fields

1. ID
2. SLUG
3. F Name
4. S Name
5. Image
6. Cover
7. Project count
8. Phone
9. Second phone
10. Adress
11. Second adress
12. City
13. State
14. Zip
15. Currency
16. Currencies

##### Functions

1. CRUD for admin
2. *RUD for vendor/user (manage your own/self data)
3. ***D for Superuser

### Commission. Commission table

#### Functions

1. CRUD for admin
2. Category
3. ***D for superadmin
4.

#### Commission page

Functions

1. RUD for vendor/user (manage your own/self data)

### Project

#### Functions

1. CRUD

### Product

#### Functions

1. CRUD

### Category

#### Functions

1. CRUD

### Order

#### Functions

1. CRUD

### Shipment

#### Functions

1. CRUD

### Payment

#### Functions

1. CRUD

### Message (use websockets)

### Review table

#### Functions

1. CRUD

#### ReviewProduct -

#### ReviewProject -
