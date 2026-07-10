# EduMarket

**EduMarket** is an educational e-commerce platform built with Laravel 13, designed for digital and educational products. It features a customer-facing store, a full shopping cart and checkout system, customer and admin dashboards, and complete back-office CRUD management for products, categories, and orders.

## Stack

| Layer       | Technology |
|-------------|------------|
| Backend     | Laravel 13.8.0 (PHP ^8.3) |
| Frontend    | Blade + Bootstrap 5 + Chart.js |
| Assets      | Vite + Laravel Breeze |
| Database    | MySQL (configurable via `.env`) |
| Auth        | Laravel Breeze (Blade stack) |
| Locale      | French (`fr`) |

## Folder Architecture

```
EduMarket/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── AdminController.php        # Admin dashboard
│   │   │   │   ├── CategoryController.php     # Category CRUD
│   │   │   │   ├── OrderController.php        # Order management + invoice
│   │   │   │   └── ProductController.php      # Product CRUD with image
│   │   │   ├── CartController.php             # Session-based cart
│   │   │   ├── CategoryController.php         # Public category listing
│   │   │   ├── CheckoutController.php         # Checkout flow
│   │   │   ├── DashboardController.php        # Customer dashboard
│   │   │   ├── OrderController.php            # Customer order history
│   │   │   ├── PageController.php             # Home, About, Contact
│   │   │   ├── ProductController.php          # Shop listing + detail
│   │   │   └── ProfileController.php          # Breeze profile
│   │   └── Middleware/
│   │       └── AdminMiddleware.php            # Admin guard (403)
│   ├── Models/
│   │   ├── Category.php                       # Has many products
│   │   ├── Order.php                          # Belongs to user, has items
│   │   ├── OrderItem.php                      # Belongs to order + product
│   │   ├── Product.php                        # Belongs to category
│   │   └── User.php                           # is_admin flag, has orders
│   └── Services/
│       └── CartService.php                    # Cart logic (session)
├── database/
│   ├── factories/                             # Model factories
│   ├── migrations/                            # Schema definitions
│   └── seeders/
│       └── DatabaseSeeder.php                 # Seeds admin + 19 users + 12 categories + 100 products + 30 orders
├── resources/views/
│   ├── admin/                                 # Admin views
│   │   ├── categories/                        # Index, create, edit, form
│   │   ├── dashboard/                         # Stats, charts, tables
│   │   ├── orders/                            # Index, show, invoice
│   │   └── products/                          # Index, create, edit, form
│   ├── cart/                                  # Cart page
│   ├── checkout/                              # Checkout form + confirmation
│   ├── components/                            # Blade components
│   ├── dashboard/                             # Customer dashboard
│   ├── layouts/                               # app, admin, customer-nav, guest
│   ├── orders/                                # Customer order list + detail
│   ├── profile/                               # Breeze profile pages
│   ├── shop/                                  # Product listing + detail
│   └── vendor/                                # Pagination overrides
└── routes/
    └── web.php                                # All routes
```

## Database Schema

```
users
├── id, name, email, password, is_admin (boolean), timestamps
└── has many → orders

categories
├── id, name, slug, description, timestamps
└── has many → products

products
├── id, name, slug, description, price, stock, image, category_id (FK), timestamps
└── belongs to → category

orders
├── id, user_id (FK), order_number (unique), total, status (enum: pending|processing|completed|cancelled), full_name, city, notes, timestamps
└── belongs to → user
    └── has many → order_items

order_items
├── id, order_id (FK), product_id (FK), price, quantity, subtotal, timestamps
└── belongs to → order, product
```

## Installation

1. **Clone the project:**
   ```bash
   git clone <repository-url> edumarket
   cd edumarket
   ```

2. **Set up environment:**
   ```bash
   copy .env.example .env
   ```
   Edit `.env` and configure your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

3. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

6. **Build frontend assets:**
   ```bash
   npm run build
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   # In another terminal (optional):
   npm run dev
   ```

8. **Access the application:**
   - Site: http://localhost:8000
   - Admin credentials: `admin@edumarket.com` / `password`
   - Customer credentials: `client@edumarket.com` / `password`

## Features

### Public
- Home page, About, Contact form
- Product shop with filtering (category, search, price range, in-stock)
- Product detail page with image
- Category listing

### Cart
- Session-based cart (works for guests and authenticated users)
- Add/update/remove items with stock validation
- Quantity adjustment via AJAX
- Cart badge in navigation

### Checkout
- Order form with name, city, notes
- Duplicate order prevention (5-minute window)
- Stock deduction within database transaction
- Order confirmation page

### Customer Dashboard
- Stats cards: total orders, pending, processing, completed, cancelled
- Recent 5 orders table with status badges
- Profile card with avatar initial + member date

### Admin Panel
- **Dashboard:** products, categories, customers, orders counts; revenue; 5 recent orders; low-stock products; Chart.js bar chart (monthly revenue + orders over 12 months); most-sold products table (top 10)
- **Products CRUD:** list with search/filter/paginate + stock badge, create/edit with image upload, slug auto-generation, image remove
- **Categories CRUD:** list with product count, create/edit with auto-slug, delete blocked if products exist
- **Orders management:** list with search/filter by status and date range, detail with customer info + purchased products, status update, printable invoice via `@media print`
- **Responsive sidebar:** collapsible on mobile via Bootstrap collapse

### Technical
- Admin middleware (`auth` + `admin` guard with 403 on failure)
- French locale throughout
- Bootstrap 5 pagination via `AppServiceProvider`
- Image storage in `storage/app/public/products/`
- Order number auto-generation (`EDU-YYYYMMDD-XXXX`)
- Monthly sales aggregation via MySQL `DATE_FORMAT`

## Known Limitations

- PHP 8.3+ is required; the project cannot run with PHP 8.2 or below
- No automated tests are implemented
- Product images are stored locally; no CDN integration
- No email notifications (order confirmation, status changes)
- No payment gateway integration (orders are manual-tracked)
- No multi-language support (French only)

## Future Improvements

- Payment gateway integration (Stripe, PayPal)
- Email notifications (order confirmation, shipping updates)
- Product reviews and ratings
- Wishlist functionality
- Coupon / discount system
- PDF invoice download (beyond print-to-PDF)
- Product image gallery (multiple images per product)
- REST API for mobile or third-party access
- Automated test suite (Pest / PHPUnit)
- Docker / Sail configuration for easier setup
