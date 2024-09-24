<?php

namespace App\ServicesAdmin\TestResultAdmin;

use Illuminate\Support\Facades\DB;

class CreateTestResult
{
    public function create()
    {
        return view('admin.test_result.create');
    }

    public function store($request)
    {
        DB::table('test_result')->insert([
            'backgroundColor' => $request->backgroundColor,
            'imageUrl' => $request->imageUrl,
            'titleText' => $request->titleText,
            'subText' => $request->subText,
            'textColor' => $request->textColor,
            'progressColor' => $request->progressColor,
            'testEnum' => $request->testEnum,
            'phase' => $request->phase,
            'type' => $request->type,
            'isBefore' => $request->isBefore,
            'notification' => $request->notification,
            'titleNotification' => $request->titleNotification,
            'imageType' => $request->imageType,
        ]);

        return redirect()->route('test-result.index')->with('success', 'Thêm mới thành công');
    }
}
