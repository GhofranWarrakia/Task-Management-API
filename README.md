# Task Management API

## Introduction
This project is a Task Management API built using Laravel. The goal of this project is to provide a comprehensive system for creating, updating, viewing, deleting, and assigning tasks to different users based on predefined roles and permissions.

## Features
- **Task Management**: Users can create tasks with details such as title, description, priority, due date, and status.
- **Role-Based Access Control**: Permissions are based on user roles. The main roles are:
  - **Admin**: Has full permissions to manage tasks and users.
  - **Manager**: Can assign and monitor tasks.
  - **User**: Can view and update tasks assigned to them.
- **Task Assignment**: Tasks can be assigned to different users.
- **Soft Deletes**: Supports soft deletion of tasks, allowing recovery later.
- **Advanced Model Properties**:
  - Uses `fillable` and `guarded` properties to protect against mass assignment.
  - Customizes primary keys (`primaryKey`) and table names (`table names`).
  - Handles date formatting and time management.
  - Soft deletes with timestamp customization.

## Requirements
- PHP >= 8.0
- Laravel >= 9.x
- MySQL or any compatible database
- Composer

## Installation

1. Clone the repository:

   git clone <repository-url>
   cd task-management-api

2. Install the required dependencies via Composer:

   composer install

3. Set up the environment file:
   Copy the `.env.example` file to `.env` and configure your database settings:

   cp .env.example .env


4. Generate the application key:
 
   php artisan key:generate
  

5. Set up the database:
   Create a new database and update the database settings in the `.env` file. Then run the migrations:

   php artisan migrate
   

6. (Optional) Seed the database with dummy data:

   php artisan db:seed

## Database Structure
- **Tasks**: Stores task details like title, description, priority, due date, status, and the assigned user.
- **Users**: Stores user information, including those who can be assigned tasks.
- **Roles**: Manages user permissions based on their role.

## Core Operations
- **Create a New Task**:
   - Endpoint: `POST /api/tasks`
   - Required fields: title, description, priority, due date, status, and assigned user.

- **Update a Task**:
   - Endpoint: `PUT /api/tasks/{id}`
   - You can update fields like title, status, priority, etc.

- **View Tasks**:
   - Endpoint: `GET /api/tasks`
   - Tasks can be filtered by priority or status using query scopes.

- **Delete a Task**:
   - Endpoint: `DELETE /api/tasks/{id}`
   - Tasks are soft deleted, meaning they can be recovered later if necessary.

## Project Customizations
- **Soft Deletes**: Tasks are soft deleted, meaning they are not permanently removed from the database and can be restored if needed.
- **User Assignment**: Tasks can be assigned to specific users, and the task status can be updated based on progress.

## References

1. **Official Laravel Documentation**:
   - The official Laravel site contains comprehensive documentation covering everything related to the framework, including project setup, database management, authentication, roles and permissions, and more.
   - Link: [https://laravel.com/docs](https://laravel.com/docs)

2. **Composer**:
   - Composer is the package manager used to install necessary libraries for your Laravel project.
   - Link: [https://getcomposer.org/](https://getcomposer.org/)

3. **PHP Documentation**:
   - Since the project is built using PHP, referring to the official PHP documentation can help in understanding how to work with various features of the language.
   - Link: [https://www.php.net/manual/en/](https://www.php.net/manual/en/)

4. **MySQL Documentation**:
   - If you are using MySQL as the database, the official MySQL documentation will be helpful for understanding queries, indexes, and transactions.
   - Link: [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)

5. **JWT Authentication**:
   - To implement authentication using JWT, refer to the JWT documentation to understand how to generate and validate tokens.
   - Link: [https://jwt.io/introduction](https://jwt.io/introduction)

6. **Soft Deletes in Laravel**:
   - For more information about implementing soft deletes and how to restore them in Laravel.
   - Link: [Soft Deletes in Laravel Documentation](https://laravel.com/docs/9.x/eloquent#soft-deleting)

7. **Role-Based Access Control (RBAC)**:
   - For an in-depth understanding of implementing role-based access control (RBAC) in Laravel.
   - Link: [https://spatie.be/docs/laravel-permission](https://spatie.be/docs/laravel-permission)

8. **GitHub**:
   - If you are using GitHub to manage repositories, GitHub documentation will help you understand how to push your source code, manage branches, open issues, and pull requests.
   - Link: [https://docs.github.com/](https://docs.github.com/)

### Other Useful References:
- **Laravel Query Scopes**: [https://laravel.com/docs/9.x/eloquent#query-scopes](https://laravel.com/docs/9.x/eloquent#query-scopes)
- **Eloquent Relationships**: [https://laravel.com/docs/9.x/eloquent-relationships](https://laravel.com/docs/9.x/eloquent-relationships)

## Contribution
To contribute to this project, you can submit pull requests or open issues on the GitHub repository.

## Contributors

- [GHofran Warrakia] - Development and maintenance of the project.

## References

- [Laravel Documentation](https://laravel.com/docs)
- [JWT Documentation](https://jwt.io/)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## License

This project is licensed under the [[Focal X]].
