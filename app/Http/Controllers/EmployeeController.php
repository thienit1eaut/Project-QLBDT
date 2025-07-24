<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Constants\ResponseCode;
use App\Models\Employee;
use App\Models\User;

class EmployeeController extends Controller
{
    public function view(Request $request) {

        $title_page = 'Quản lý nhân viên';

        $employees = Employee::orderBy('created_at', 'desc')->paginate(10);

        return view('employees.view', compact('employees', 'title_page'));
    }

    // Display form create
    public function create() {
        $listuser = User::orderBy('name')->get();

        return view('employees.add', compact('listuser'));
    }

    // Insert
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:employees,email',
            'sdt' => 'nullable|string|max:20|unique:employees,sdt',
            'address' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:100',
            'hire_date' => 'nullable|date',
            'note' => 'nullable|string|max:1000',
            'user_id' => 'nullable|integer|exists:users,id'
        ],[
            'name.required' => 'Vui lòng nhập tên nhân viên!',
            'email.unique' => 'Email đã tồn tại trong hệ thống!',
            'sdt.unique' => 'Số điện thoại đã tồn tại trong hệ thống!',
        ]);

        try {
            $code = $this->generateEmployeeCode();

            $employee = Employee::create([
                'name' => $validated['name'],
                'employee_code' => $code,
                'email' => $validated['email'] ?? null,
                'sdt' => $validated['sdt'] ?? null,
                'address' => $validated['address'] ?? null,
                'position' => $validated['position'] ?? null,
                'hire_date' => $validated['hire_date'] ?? null,
                'note' => $validated['note'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'status' => 1,
                'act' => 1,
            ]);

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Thêm mới thành công!',
                'url' => route('employee.view')
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm mới!: '.$e->getMessage());

            return response()->json([
                'code' => ResponseCode::ERROR,
                'message' => 'Thêm mới thất bại!',
                'url' => ''
            ]);
        }
    }

    // Display form edit
    public function edit($id) {
        $dataitem = Employee::findOrFail($id);
        $listuser = User::orderBy('name')->get();

        return view('employees.edit', compact('dataitem', 'listuser'));
    }

    // Edit
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:employees,email,' . $id,
            'sdt' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:100',
            'hire_date' => 'nullable|date',
            'note' => 'nullable|string|max:1000',
            'user_id' => 'nullable|integer|exists:users,id',
            'act' => 'nullable|boolean',
        ],[
            'name.required' => 'Vui lòng nhập tên nhân viên!',
            'email.unique' => 'Email đã tồn tại trong hệ thống!',
        ]);

        try {
            $employee = Employee::findOrFail($id);

            $employee->update([
                'name' => $validated['name'],
                'email' => $validated['email'] ?? null,
                'sdt' => $validated['sdt'] ?? null,
                'address' => $validated['address'] ?? null,
                'position' => $validated['position'] ?? null,
                'hire_date' => $validated['hire_date'] ?? null,
                'note' => $validated['note'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'act' => $validated['act'] ?? 1,
            ]);

            return response()->json([
                'code' => ResponseCode::SUCCESS,
                'message' => 'Cập nhật thành công!',
                'url' => ''
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return response()->json([
                'code' => ResponseCode::ERROR,
                'message' => 'Cập nhật thất bại!',
                'url' => ''
            ]);
        }
    }

    // delete data ID
    public function destroy($id) {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return redirect()->back()->with('success', 'Đã xoá nhân viên!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật!: '.$e->getMessage());

            return redirect()->back()->with('error', 'Lỗi xoá nhân viên!');
        }        
    }

    // get data table ID
    public function show($id) {
        $dataitem = Employee::findOrFail($id);

        return view('employees.detail', compact('dataitem'));
    }

    public function generateEmployeeCode() {
        $prefix = 'NV';
        $random = rand(100, 999); // 3 chữ số
        $date = now()->format('dmY'); // ddmmyyyy

        return $prefix . $random . $date;
    }
}
