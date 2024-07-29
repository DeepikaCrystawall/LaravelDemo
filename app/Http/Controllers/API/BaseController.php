<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class BaseController extends Controller
{
      /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    // public function sendResponse($result, $message)
    // {
    //     $response = [
    //         'success' => true,
    //         'data'    => $result,
    //         'message' => $message,
    //     ];
  
    //     return response()->json($response, 200);
    // }

    public function sendResponse($result = null, $message = '', $statusCode = Response::HTTP_OK)
    {
        $response = [
            'success' => $statusCode === Response::HTTP_OK, // success is true for 200, false otherwise
            'data'    => $result,
            'message' => $message,
        ];

        // Return the response with the given status code
        return response()->json($response, $statusCode);
    }

  
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
  
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
  
        return response()->json($response, $code);
    }
}
