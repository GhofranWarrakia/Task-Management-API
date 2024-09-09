<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * عرض كل المهام مع الفلترة حسب الأولوية أو الحالة
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @queryParam priority string اختياري، الفلترة حسب الأولوية
     * @queryParam status string اختياري، الفلترة حسب الحالة
     */
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('priority')) {
            $tasks->priority($request->priority);
        }

        if ($request->has('status')) {
            $tasks->status($request->status);
        }

        return response()->json($tasks->get(), 200);
    }

    /**
     * إنشاء مهمة جديدة
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:pending,completed,in_progress',
            'assigned_to' => 'nullable|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            // إرجاع رسالة خطأ مفردة
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        // إنشاء المهمة
        $task = Task::create($request->all());

        return response()->json($task, 201);
    }

    /**
     * عرض مهمة محددة
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // التحقق من وجود المهمة
        $task = Task::find($id);

        if (!$task) {
            // إرجاع رسالة خطأ
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task, 200);
    }

    /**
     * تحديث مهمة
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        // التحقق من وجود المهمة
        $task = Task::find($id);

        if (!$task) {
            // إرجاع رسالة خطأ
            return response()->json(['message' => 'Task not found'], 404);
        }

        // التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:low,medium,high',
            'due_date' => 'nullable|date',
            'status' => 'required|string|in:pending,completed,in_progress',
            'assigned_to' => 'nullable|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            // إرجاع رسالة خطأ مفردة
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        // تحديث المهمة
        $task->update($request->all());

        return response()->json($task, 200);
    }

    /**
     * حذف مهمة باستخدام Soft Delete
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // التحقق من وجود المهمة
        $task = Task::find($id);

        if (!$task) {
            // إرجاع رسالة خطأ
            return response()->json(['message' => 'Task not found'], 404);
        }

        // حذف المهمة باستخدام Soft Delete
        $task->delete();

        return response()->json(null, 204);
    }

    /**
     * تعيين مهمة لمستخدم معين
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function assign(Request $request, $id)
    {
        // التحقق من وجود المهمة
        $task = Task::find($id);

        if (!$task) {
            // إرجاع رسالة خطأ
            return response()->json(['message' => 'Task not found'], 404);
        }

        // التحقق من صحة بيانات المستخدم المخصص
        $validator = Validator::make($request->all(), [
            'assigned_to' => 'required|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            // إرجاع رسالة خطأ مفردة
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        // تعيين المستخدم للمهمة
        $task->assigned_to = $request->assigned_to;
        $task->save();

        return response()->json($task, 200);
    }
}
