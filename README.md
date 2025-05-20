# Paakwaan - Thai Novel Platform

Paakwaan is a web application platform for reading and publishing Thai novels. It provides a space for authors to share their stories and readers to discover and enjoy Thai literature.

## Features

- 📚 Novel Management System
  - Categories (Fantasy, Romance, etc.)
  - Series and Short Story support
  - Chapter organization
  - Cover image support
  - View counting

- 👥 User System
  - Author profiles
  - Admin dashboard
  - Authentication system

- 📱 Modern UI
  - Responsive design
  - Built with Tailwind CSS
  - Laravel Blade templates

## Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and npm
- SQLite 3

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/paakwaan.git
cd paakwaan
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Storage:
```bash
php artisan storage:link
```

7. Run the migrations and seeders:
```bash
php artisan migrate --seed
```

## Development

1. Start the Vite development server:
```bash
npm run dev
```

2. Start the Laravel development server:
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Admin Account

After seeding the database, you can login with these credentials:
- Email: admin@example.com
- Password: password

## Database Structure

### Novel Categories
- Categories for organizing novels (e.g., Fantasy, Romance)
- Each category has a name, slug, description, and optional icon

### Novels
- Title
- Description
- Cover image
- Status (ongoing/completed)
- Category association
- Author (User) association

### Chapters
- Title
- Content
- Chapter number
- View count
- Publication status

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

[MIT License](LICENSE.md)

## Support

For support, please open an issue in the GitHub repository.
