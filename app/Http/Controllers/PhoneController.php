<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use PhoneParser;

class PhoneController extends Controller
{
    /**
     * Handle a text request
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  App\Facades\PhoneParser
     */
    public function text(Request $request)
    {
        $input = $request->get('text');
        $output = PhoneParser::text($input);
        $user_id = $request->user()->id ?? false;

        // log the action
		$log = Log::create([
			'user_id' => $user_id,
			'ip_address' => $this->getIpAddress(),
			'action' => 'translation',
			'data' => [
                'input' => $input ?? null,
                'output' => $output ?? null
            ],
		]);

        // return the output
        return response()->json($log);
    }

    /**
     * Handle a number request
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  App\Facades\PhoneParser
     */
    public function number(Request $request)
    {
        $input = $request->get('number');
        $output = PhoneParser::number($input);
        $user_id = $request->user()->id ?? false;

        // log the action
		$log = Log::create([
			'user_id' => $user_id,
			'ip_address' => $this->getIpAddress(),
			'action' => 'translation',
			'data' => [
                'input' => $input ?? null,
                'output' => $output ?? null
            ],
		]);

        return response()->json([
            'input' => $input,
            'output' => $output
        ]);
    }

    /**
     * Return the translated logs
     *
     * @return  array
     */
    public function get()
    {
        $user = $request->user();

        // check if the user is logged in
        if (!$user) {
            return response()->json(['Not authenticated.', 404]);
        }

        // retrieve the logs
        $logs = Logs::type('translations')->get();

        return response()->json($logs);
    }

	/**
	 * Return the client's REAL ip
	 *
	 * @return  $ip_address
	 */
	protected function getIpAddress()
	{
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
			if (array_key_exists($key, $_SERVER) === true){
				foreach (explode(',', $_SERVER[$key]) as $ip){
					$ip = trim($ip); // just to be safe
					if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
						return $ip;
					}
				}
			}
		}

		return request()->ip();
	}
}
