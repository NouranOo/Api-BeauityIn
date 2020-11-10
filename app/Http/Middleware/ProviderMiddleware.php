<?php

namespace App\Http\Middleware;

use Closure;
use App\Provider;
use Illuminate\Http\Request;
use validator;
use App\Helpers\GeneralHelper;
use App\Helpers\ApiResponse;
class ProviderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rules = [
            'ApiToken'=>'required',
            'apiKey' => 'required',

        ];

        $validation=Validator::make($request->all(),$rules);

        if($validation->fails()){
            return $this->apiResponse->setError($validation->errors()->first())->send();

        }
        $api_key = env('APP_KEY');
        if ($api_key != $request->apiKey) {
            return $this->apiResponse->setError("Unauthorized (invalid apiKey)!")->send();
        }
        $provider=Provider::where('ApiToken',$request->ApiToken)->first();
 
        if(empty($provider)){
            return $this->apiResponse->setError('UnAutharized (invalid ApiToken)')->send();
        }
        GeneralHelper::SetCurrentProvider($request->ApiToken);

        return $next($request);
    }
}
