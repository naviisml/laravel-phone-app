<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StarWars\Character;

class CharacterController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['get']);
    }

    /**
     * Get the characters, or character by id
     *
	 * @param   \Illuminate\Http\Request  $request
	 * @param   string $id
     *
	 * @return  \App\Model\Character
     */
    public function get(Request $request, string $id = null)
    {
        $result = $id ? Character::where('id', $id)->first() : Character::paginate(15);

        return response()->json($result);
    }

    /**
     * Deleta a specific character
     *
	 * @param   \Illuminate\Http\Request  $request
	 * @param   boolean $id
     *
	 * @return  json
     */
    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $result = Character::find($id);

        // check if the log exists
        if (!$result->get()) {
            return response()->json(['code' => 404, 'error' => 'Log not found'], 404);
        }

        // log that the user deleted the log
        $user->log('character.delete', [], ['character' => $result]);

        // delete the log
        $result->delete();

        return response()->json(['code' => 200, 'error' => 'Deleted the character', 200]);
    }
}
