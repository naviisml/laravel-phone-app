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
        $logs = $type ? Log::where('action', $type)->orderBy('id', 'DESC')->paginate(25) : Log::orderBy('id', 'DESC')->paginate(25);

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
	 * @return  json
     */
    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $log = Log::find($id);

        // check if the log exists
        if (!$log->get()) {
            return response()->json(['code' => 404, 'error' => 'Log not found'], 404);
        }

        // log that the user deleted the log
        $user->log('log.delete', [], ['log' => $log]);

        // delete the log
        $log->delete();

        return response()->json(['code' => 200, 'error' => 'Deleted the log', 200]);
    }
}
