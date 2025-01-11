<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\DivisionResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function create(EmployeeCreateRequest $request)
    {   
        $data = $request->validated();

        $employee = new Employee($data);
        $employee->id = (string) Str::uuid();
        $employee->save();
        
        return ResponseHelper::buildResponse(201, 'success', 'create employee success');
    }

    public function get()
    {
        $employee = Employee::all();

        $response = [
            'employees' => employeeResource::collection($employee)->resolve()
        ];
        
        return ResponseHelper::buildResponse(200, 'success', 'get employees success', $response);
    }

    public function update(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $employee = Employee::find($id);
        $employee->update($data);

        return ResponseHelper::buildResponse(200, 'success', 'update employee success');
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return ResponseHelper::buildResponse(200, 'success', 'delete employee success');
    }
}
