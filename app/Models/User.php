<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * نموذج المستخدم
 *
 * يحتوي على معلومات المستخدم ويستخدم Soft Deletes
 * يتم التحكم في الأدوار وتشفير كلمات المرور هنا.
 */
class User extends Model
{
    use SoftDeletes;

    /**
     * الحقول المحمية من Mass Assignment
     *
     * @var array
     */
    protected $guarded = ['password'];

    /**
     * الحقول القابلة للتعبئة عبر النماذج أو طلبات API
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'role'];

    /**
     * Mutator لتشفير كلمة المرور تلقائيًا عند إدخالها
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * التحقق مما إذا كان المستخدم Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    /**
     * التحقق مما إذا كان المستخدم Manager
     *
     * @return bool
     */
    public function isManager()
    {
        return $this->role === 'Manager';
    }

    /**
     * علاقة المستخدم مع المهام المخصصة له
     *
     * يحدد العلاقة بين المستخدم والمهام التي تم تعيينها إليه
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * تخصيص أسماء الحقول الزمنية (timestamps)
     */
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_on';
}

