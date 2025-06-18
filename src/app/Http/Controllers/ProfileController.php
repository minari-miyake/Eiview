<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        // アイコンファイルのアップロード処理
        if ($request->hasFile('icon')) {
            // アップロードディレクトリを作成
            $uploadDir = public_path('uploads/icons');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // 古いアイコンファイルを削除
            if ($user->icon_url && file_exists(public_path($user->icon_url))) {
                unlink(public_path($user->icon_url));
            }

            // 新しいアイコンファイルを保存
            $iconFile = $request->file('icon');
            $iconName = time() . '_' . $iconFile->getClientOriginalName();
            $iconFile->move($uploadDir, $iconName);
            $validated['icon_url'] = '/uploads/icons/' . $iconName;
        }

        // iconフィールドを除外（ファイルなので）
        unset($validated['icon']);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}