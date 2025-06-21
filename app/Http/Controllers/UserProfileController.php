<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function editProfile($userId)
    {
        $userData = User::findOrFail($userId);

        return view('pages.user.editprofile', compact('userData'));
    }

    public function updateProfile(Request $request, $userId)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048', // Maksimal 2MB
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($userId);

            // Ambil data dasar
            $userData = $request->only(['name', 'email']);

            // Handle upload photo
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }
                // Simpan foto baru
                $userData['photo'] = $request->file('photo')->store('profile_photos', 'public');
            }

            // Update data user
            $user->update($userData);

            DB::commit();
            // Flash message berhasil
            toast('Profil berhasil diupdate!', 'success');

            return redirect()->route('user.profile.edit', ['userId' => $userId]);
        } catch (\Throwable $th) {
            DB::rollBack();
            //Toast error message
            toast('Gagal mengupdate profil: ' . $th->getMessage(), 'error');
            return redirect()->back()->withErrors([
                'error' => 'Failed to update profile: ' . $th->getMessage()
            ]);
        }
    }

    public function updatePassword(Request $request, $userId)
    {
        // Implement password update logic here
        $request->validate([
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|same:password',
        ]);

        

        DB::beginTransaction();

        try {
            $user = User::findOrFail($userId);

            // Update password
            $user->update([
                'password' => bcrypt($request->input('password')),
            ]);

            DB::commit();
            toast('Password berhasil diperbarui!', 'success');

            return redirect()->route('user.profile.edit', ['userId' => $userId])
                             ->with('success', 'Password updated successfully.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            toast('Gagal memperbarui password!: ' . $th->getMessage(), 'error');
            return redirect()->back()->withErrors([
                'error' => 'Failed to update password: ' . $th->getMessage()
            ]);
        }
    }
}
