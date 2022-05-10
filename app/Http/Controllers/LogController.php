<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get the logs, or get a log by type
     *
	 * @param   \Illuminate\Http\Request  $request
	 * @param   string $type
     *
	 * @return  \App\Model\Log
     */
    public function list(Request $request, string $type = null)
    {
        $user = $request->user();
        $logs = $type ? Log::where('action', $type)->paginate(25) : Log::paginate(25);

        return response()->json($logs);
    }

    /**
     * Get a specific log
     *
	 * @param   \Illuminate\Http\Request  $request
	 * @param   boolean $id
     *
	 * @return  \App\Model\Log
     */
    public function get(Request $request, $id)
    {
        $user = $request->user();
        $log = Log::find($id)->get();

        // check if the log exists
        if (!$log) {
            return response()->json(['code' => 404, 'error' => 'Log not found'], 404);
        }

        return response()->json($log);
    }

    /**
     * Deleta a specific log
     *
	 * @param   \Illuminate\Http\Request  $request
	 * @param   boolean $id
     *
	 * @return  \App\Model\Log
     */
    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $log = Log::find($id);

        // check if the log exists
        if (!$log->get()) {
            return response()->json(['code' => 404, 'error' => 'Log not found'], 404);
        }

        // delete the log
        $log->delete();

        return response()->json(['code' => 200, 'error' => 'Deleted the log', 200]);
    }
}
