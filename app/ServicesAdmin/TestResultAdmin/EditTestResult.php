<?php

namespace App\ServicesAdmin\TestResultAdmin;

use Illuminate\Support\Facades\DB;

class EditTestResult
{
    public function edit($id)
    {
        $test_result = DB::table('test_result')->where('id', $id)->first();

        return view('admin.test_result.edit', compact('test_result'));
    }

    public function update($request, $id)
    {
        DB::table('test_result')->where('id', $id)->update([
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
            'imageType' => $request->imageType,
        ]);

        return redirect()->route('test-result.index')->with('success', 'Cập nhật thành công');
    }
}
