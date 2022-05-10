<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use PhoneParser;

class ParserController extends Controller
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

        // prepare the log data
        $data = [
			'ip_address' => $this->getIpAddress(),
			'action' => 'translation',
			'data' => [
                'input' => $input ?? null,
                'output' => $output ?? null
            ],
		];

        // add the user_id if there is a authenticated user
        if (($user_id = $request->user()->id ?? null)) {
            $data['user_id'] = $user_id;
        }

        // log the action
		$log = Log::create($data);

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

        // prepare the log data
        $data = [
			'ip_address' => $this->getIpAddress(),
			'action' => 'translation',
			'data' => [
                'input' => $input ?? null,
                'output' => $output ?? null
            ],
		];

        // add the user_id if there is a authenticated user
        if (($user_id = $request->user()->id ?? null)) {
            $data['user_id'] = $user_id;
        }

        // log the action
		$log = Log::create($data);

        // return the output
        return response()->json($log);
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
