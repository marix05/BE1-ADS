<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete the user
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        // Return a response indicating successful deletion
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully'
        ]);
    }
}
