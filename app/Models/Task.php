<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 *
 * Represents a task model with soft delete functionality for a task management system.
 * The model includes fields for task details like title, description, priority, due date, status, and assigned user.
 *
 * @package App\Models
 *
 * @property int $task_id The primary key for the tasks table
 * @property string $title The title of the task
 * @property string $description A brief description of the task
 * @property int $priority The priority of the task (e.g., low, medium, high)
 * @property \Carbon\Carbon $due_date The due date for the task completion
 * @property string $status The current status of the task (e.g., pending, in-progress, completed)
 * @property int $assigned_to The ID of the user to whom the task is assigned
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Task priority(int $priority) Scope to filter tasks by priority
 * @method static \Illuminate\Database\Eloquent\Builder|Task status(string $status) Scope to filter tasks by status
 */
class Task extends Model
{
    use SoftDeletes;

    /**
     * @var string $table The name of the tasks table in the database
     */
    protected $table = 'tasks';

    /**
     * @var string $primaryKey The custom primary key column name
     */
    protected $primaryKey = 'task_id';

    /**
     * @var array $fillable The attributes that are mass assignable
     */
    protected $fillable = ['title', 'description', 'priority', 'due_date', 'status', 'assigned_to'];

    /**
     * @var bool $timestamps Enable automatic management of created_at and updated_at columns
     */
    public $timestamps = true;

    /**
     * @var string The name of the column for the created timestamp
     */
    const CREATED_AT = 'created_on';

    /**
     * @var string The name of the column for the updated timestamp
     */
    const UPDATED_AT = 'updated_on';

    /**
     * Scope a query to filter tasks by priority.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $priority The priority level to filter by
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope a query to filter tasks by status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status The status to filter by
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
