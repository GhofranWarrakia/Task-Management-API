<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/**
 * Route for user registration.
 *
 * @api POST /register
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
Route::post('/register', [AuthController::class, 'register']);

/**
 * Route for user login.
 *
 * @api POST /login
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\Response
 */
Route::post('/login', [AuthController::class, 'login']);

/**
 * Grouped routes that require user authentication.
 */
Route::middleware('auth:sanctum')->group(function () {

    /**
     * Route for logging out the authenticated user.
     *
     * @api POST /logout
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    Route::post('/logout', [AuthController::class, 'logout']);
});

/**
 * Group of routes accessible to authenticated users (auth:sanctum).
 */
Route::group(['middleware' => 'auth:sanctum'], function () {

    /**
     * Fetch the list of tasks.
     *
     * @api GET /tasks
     * @return \Illuminate\Http\Response
     */
    Route::get('/tasks', [TaskController::class, 'index']);

    /**
     * Create a new task.
     *
     * @api POST /tasks
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    Route::post('/tasks', [TaskController::class, 'store']);

    /**
     * Fetch a specific task by its ID.
     *
     * @api GET /tasks/{id}
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::get('/tasks/{id}', [TaskController::class, 'show']);

    /**
     * Update a specific task by its ID.
     *
     * @api PUT /tasks/{id}
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::put('/tasks/{id}', [TaskController::class, 'update']);

    /**
     * Delete a specific task by its ID.
     *
     * @api DELETE /tasks/{id}
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    /**
     * Assign a task to a user by task ID.
     *
     * @api POST /tasks/{id}/assign
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::post('/tasks/{id}/assign', [TaskController::class, 'assign']);

    /**
     * Create a new user.
     *
     * @api POST /users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    Route::post('/users', [UserController::class, 'store']);

    /**
     * Fetch the list of users.
     *
     * @api GET /users
     * @return \Illuminate\Http\Response
     */
    Route::get('/users', [UserController::class, 'index']);

    /**
     * Update a user by their ID.
     *
     * @api PUT /users/{id}
     * @param \Illuminate\Http\Request $request
     * @param int $id User ID
     * @return \Illuminate\Http\Response
     */
    Route::put('/users/{id}', [UserController::class, 'update']);

    /**
     * Delete a user by their ID.
     *
     * @api DELETE /users/{id}
     * @param int $id User ID
     * @return \Illuminate\Http\Response
     */
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

/**
 * Group of routes accessible to Admin role.
 */
Route::group(['middleware' => ['auth:sanctum', 'role:Admin']], function () {

    /**
     * Admin route to create a new task.
     *
     * @api POST /tasks
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    Route::post('/tasks', [TaskController::class, 'store']);

    /**
     * Admin route to update a task.
     *
     * @api PUT /tasks/{id}
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::put('/tasks/{id}', [TaskController::class, 'update']);

    /**
     * Admin route to delete a task.
     *
     * @api DELETE /tasks/{id}
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    /**
     * Admin route to assign a task.
     *
     * @api POST /tasks/{id}/assign
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::post('/tasks/{id}/assign', [TaskController::class, 'assign']);

    /**
     * Admin route to create a new user.
     *
     * @api POST /users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    Route::post('/users', [UserController::class, 'store']);

    /**
     * Admin route to update a user.
     *
     * @api PUT /users/{id}
     * @param \Illuminate\Http\Request $request
     * @param int $id User ID
     * @return \Illuminate\Http\Response
     */
    Route::put('/users/{id}', [UserController::class, 'update']);

    /**
     * Admin route to delete a user.
     *
     * @api DELETE /users/{id}
     * @param int $id User ID
     * @return \Illuminate\Http\Response
     */
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

/**
 * Group of routes accessible to Manager role.
 */
Route::group(['middleware' => ['auth:sanctum', 'role:Manager']], function () {

    /**
     * Manager route to assign a task.
     *
     * @api POST /tasks/{id}/assign
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::post('/tasks/{id}/assign', [TaskController::class, 'assign']);
});

/**
 * Group of routes accessible to User role.
 */
Route::group(['middleware' => ['auth:sanctum', 'role:User']], function () {

    /**
     * User route to update a task.
     *
     * @api PUT /tasks/{id}
     * @param \Illuminate\Http\Request $request
     * @param int $id Task ID
     * @return \Illuminate\Http\Response
     */
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
});
