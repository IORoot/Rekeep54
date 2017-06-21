<?php namespace App\Http\Controllers\JWT;

use App\Http\Controllers\Controller;
use Response;

/**
 * Class JWTBaseController
 * @package App\Http\Controllers\JWT
 */
class JWTBaseController extends Controller {

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }


    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithConfirmation($message)
    {
        return $this->respond([
            'confirmed' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }





    /* --------------------------------------------------------------------------------- *\

       CUSTOM RESPONSE CODES

    \* --------------------------------------------------------------------------------- */


    /**
     * @param string $message
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad Request.')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNodeCreated($message = 'Request Accepted.')
    {
        return $this->setStatusCode(200)->respondWithConfirmation($message);
    }
}