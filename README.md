# Task Management Application

A simple task management application built with Laravel 11 (Backend) and Vue.js 3 (Frontend).

## Requirements

### Backend
- PHP 8.2 or higher
- Composer
- MySQL 8.0
- Laravel requirements ([See Laravel documentation](https://laravel.com/docs/11.x/deployment#server-requirements))

### Frontend
- Node.js 20.x or higher
- npm 10.x or higher

## Backend Setup

1. Clone the repository:
```bash
git clone https://github.com/araodomingosjoao/todo-app.git
cd todo-app
```

2. Install backend dependencies:
```bash
composer install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## Frontend Setup

1. Navigate to frontend directory:
```bash
cd frontend
```

2. Install dependencies:
```bash
npm install
```

3. Start development server:
```bash
npm run dev
```

The frontend will be available at `http://localhost:5173`

## API Documentation

The API documentation is available through Swagger UI at `/api/documentation` when running the backend server.

### Available Endpoints

- `GET /api/tasks` - List all tasks (paginated)
- `POST /api/tasks` - Create a new task
- `GET /api/tasks/{id}` - Get a specific task
- `PUT /api/tasks/{id}` - Update a task
- `DELETE /api/tasks/{id}` - Delete a task
- `PATCH /api/tasks/{id}/toggle-status` - Toggle task status

## Features

- Task management (CRUD operations)
- Task status toggle (pending/completed)
- Form validation
- Responsive design
- API pagination
- Error handling

## Technologies Used

### Backend
- Laravel 11
- MySQL
- L5-Swagger for API documentation
- Repository Pattern
- Service Layer
- Form Request Validation
- API Resources

### Frontend
- Vue.js 3
- Vue Router
- Pinia for state management
- Axios for API requests
- TailwindCSS for styling
- Vite as build tool

## Development

### Frontend Development
```bash
npm run dev
```

### Frontend Build
```bash
npm run build
```

## Project Structure

### Backend Structure
```
app/
├── Http/
│   ├── Controllers/
│   │       └── TaskController.php
│   ├── Requests/
│   │   └── TaskRequest.php
│   └── Resources/
│       └── TaskResource.php
│   └── Response/
│       └── ApiResponse.php
├── Models/
│   └── Task.php
├── Services/
│   └── TaskService.php
├── Repositories/
│   ├── Interfaces/
│   │   └── TaskRepositoryInterface.php
│   └── TaskRepository.php
└── Enums/
    └── TaskStatus.php
```

### Frontend Structure
```
src/
├── assets/
├── components/
│   └── tasks/
│       ├── TaskItem.vue
│       ├── TaskList.vue
│       ├── TaskModal.vue
├── services/
│   └── api/
│       └── tasks.js
├── stores/
│   └── tasks.js
├── views/
│   └── TaskView.vue
└── router/
    └── index.js
```

## Best Practices Used

- Repository Pattern for data abstraction
- Service Layer for business logic
- Form Request Validation
- API Resource Transformation
- Conventional Commits
- Component-based architecture in frontend
- State management with Pinia
- Responsive design
- Error handling
- API standardization
- Code organization and clean architecture

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

[MIT License](LICENSE)