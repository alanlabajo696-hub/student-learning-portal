<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        $student = Student::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name]
        );

        $userPhone = $user->userPhone;
        $phone = $userPhone?->phone;

        return view('student-profile.edit', compact(
            'user',
            'student',
            'userPhone',
            'phone'
        ));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
        ]);

        $user = $request->user();

        $user->update(['name' => $validated['name']]);

        Student::updateOrCreate(
            ['user_id' => $user->id],
            ['name' => $validated['name']]
        );

        if (!empty($validated['phone_number'])) {
            $userPhone = $user->userPhone()->updateOrCreate(
                ['user_id' => $user->id],
                ['name' => $validated['name']]
            );

            $userPhone->phone()->updateOrCreate(
                ['user_phone_id' => $userPhone->id],
                ['phone_number' => $validated['phone_number']]
            );
        } else {
            $user->userPhone?->phone?->delete();
            $user->userPhone?->delete();
        }

        return back()->with('success', 'Your profile has been updated.');
    }
}