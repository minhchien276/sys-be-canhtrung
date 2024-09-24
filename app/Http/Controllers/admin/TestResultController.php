<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTestResultRequest;
use App\Models\test_result;
use App\ServicesAdmin\TestResultAdmin\CreateTestResult;
use App\ServicesAdmin\TestResultAdmin\EditTestResult;

class TestResultController extends Controller
{
    private $createTestResult;
    private $editTestResult;

    public function __construct(
        CreateTestResult $createTestResult,
        EditTestResult $editTestResult,
    ) {
        $this->createTestResult = $createTestResult;
        $this->editTestResult = $editTestResult;
    }

    public function index()
    {
        $test_result = test_result::all();

        return view('admin.test_result.index', compact('test_result'));
    }

    public function create()
    {
        return $this->createTestResult->create();
    }

    public function store(CreateTestResultRequest $request)
    {
        return $this->createTestResult->store($request);
    }

    public function edit($id)
    {
        return $this->editTestResult->edit($id);
    }

    public function update(CreateTestResultRequest $request, $id)
    {
        return $this->editTestResult->update($request, $id);
    }
}
