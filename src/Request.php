<?php
/**
 *
 * @author  qiangjian@staff.sina.com.cn sunsky303@gmail.com
 * Date: 2017/6/16
 * Time: 10:02
 * @version $Id: $
 * @since 1.0
 * @copyright Sina Corp.
 */

namespace MultiHttp;

use MultiHttp\Exception\InvalidArgumentException;

class Request extends Http
{
<<<<<<< HEAD
    const MAX_REDIRECTS_DEFAULT = 10;
=======
    /**
     * you can implement more traits
     */
    use JsonTrait;

>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    protected static $curlAlias = array(
        'url' => 'CURLOPT_URL',
        'uri' => 'CURLOPT_URL',
        'debug' => 'CURLOPT_VERBOSE',//for debug verbose
        'method' => 'CURLOPT_CUSTOMREQUEST',
        'data' => 'CURLOPT_POSTFIELDS', // array or string , file begin with '@'
        'ua' => 'CURLOPT_USERAGENT',
        'timeout' => 'CURLOPT_TIMEOUT', // (secs) 0 means indefinitely
        'connect_timeout' => 'CURLOPT_CONNECTTIMEOUT',
        'referer' => 'CURLOPT_REFERER',
        'binary' => 'CURLOPT_BINARYTRANSFER',
        'port' => 'CURLOPT_PORT',
        'header' => 'CURLOPT_HEADER', // TRUE:include header
        'headers' => 'CURLOPT_HTTPHEADER', // array
        'download' => 'CURLOPT_FILE', // writing file stream (using fopen()), default is STDOUT
        'upload' => 'CURLOPT_INFILE', // reading file stream
        'transfer' => 'CURLOPT_RETURNTRANSFER', // TRUE:return string; FALSE:output directly (curl_exec)
        'follow_location' => 'CURLOPT_FOLLOWLOCATION',
        'timeout_ms' => 'CURLOPT_TIMEOUT_MS', // milliseconds,  libcurl version > 7.36.0 ,
<<<<<<< HEAD
=======
        'expects_mime' => null, //expected mime
        'send_mime' => null, //send mime
        'ip' => null,//specify ip to send request
        'callback' => null,//callback on end

>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    );
    protected static $logger;
    public $curlHandle;
    public
        $uri,
<<<<<<< HEAD
        $timeout,
        $maxRedirects,
        $followRedirects;
    public $cert;
    public $key;
    public $passphrase;
    public $encoding;
    public $payload;
    public $retryTimes;

    /**
     * @var int seconds
     */
    public $retryDuration;
    protected $options = array(
        'CURLOPT_MAXREDIRS' => 10,
        'header' => true,
        'method' => self::GET,
        'transfer' => true,
        'follow_location' => true,
        'timeout' => 0,
//        'ip' => null, //host, in string, .e.g: 172.16.1.1:888
        'retry_times' => 1,//redo task when failed
        'retry_duration' => 0,//in seconds
    );
    protected $endCallback;
    protected $withURIQuery;
    protected $hasInitialized = false;
=======
        $sendMime,
        $expectedMime,
        $timeout,
        $maxRedirects,
        $encoding,
        $payload,
        $retryTimes,
        /**
         * @var int seconds
         */
        $retryDuration,
        $followRedirects;

    protected
        $body,
        $endCallback,
        $withURIQuery,
        $hasInitialized = false,
        /**
         * @var array
         */
        $options = array(
            'CURLOPT_MAXREDIRS' => 10,
            'CURLOPT_SSL_VERIFYPEER' => false,//for https
            'CURLOPT_SSL_VERIFYHOST' => 0,//for https
            'CURLOPT_IPRESOLVE' => CURL_IPRESOLVE_V4,//ipv4 first
//            'CURLOPT_SAFE_UPLOAD' => false,// compatible with PHP 5.6.0
            'header' => true,
            'method' => self::GET,
            'transfer' => true,
            'headers' => array(),
            'follow_location' => true,
            'timeout' => 0,
            //        'ip' => null, //host, in string, .e.g: 172.16.1.1:888
            'retry_times' => 1,//redo task when failed
            'retry_duration' => 0,//in seconds
        );

>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6

    protected function __construct()
    {

    }

    public static function create()
    {
        return new self;
    }

    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }
    /**
     * Specify   timeout
     * @param float|int $timeout seconds to timeout the HTTP call
     * @return Request
     */
    public function timeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return Request
     */
    public function noFollow()
    {
        return $this->follow(0);
    }

    /**
     * If the response is a 301 or 302 redirect, automatically
     * send off another request to that location
     * @param int $follow follow or not to follow or maximal number of redirects
     * @return Request
     */
    public function follow($follow)
    {
        $this->maxRedirects = abs($follow);
        $this->followRedirects = $follow > 0;
        return $this;
    }

    /**
     * Specify   timeout
     * @param float|int $timeout seconds to timeout the HTTP call
     * @return Request
     */
    public function timeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function noFollow()
    {
        return $this->follow(0);
    }

    /**
     * If the response is a 301 or 302 redirect, automatically
     * send off another request to that location
     * @param int $follow follow or not to follow or maximal number of redirects
     * @return Request
     */
    public function follow($follow)
    {
<<<<<<< HEAD
        $this->maxRedirects = abs($follow);
        $this->followRedirects = $follow > 0;
=======
        $this->sendMime = $mime;
//        $this->addHeader('Content-type', Mime::getFullMime($mime));
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
        return $this;
    }

    public function endCallback()
    {
        return $this->endCallback;
    }

    public function hasEndCallback()
    {
        return isset($this->endCallback);
    }

    public function uri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

<<<<<<< HEAD
    public function hasCert()
    {
        return isset($this->cert) && isset($this->key);
    }

    /**
     * Use Client Side Cert Authentication
     * @param string $key file path to client key
     * @param string $cert file path to client cert
     * @param string $passphrase for client key
     * @param string $encoding default PEM
     * @return Request
     */
    public function cert($cert, $key, $passphrase = null, $encoding = 'PEM')
    {
        $this->cert = $cert;
        $this->key = $key;
        $this->passphrase = $passphrase;
        $this->encoding = $encoding;
        return $this;
    }

    public function body($payload, $mimeType = null)
    {
        $this->mime($mimeType);
        $this->payload = $payload;
        // Iserntentially don't call _serializePayload yet.  Wait until
        // we actually send off the request to convert payload to string.
        // At that time, the `serialized_payload` is set accordingly.
        return $this;
    }
    public function mime($mime)
    {
        if (empty($mime)) return $this;
        $this->content_type = $this->expected_type = Mime::getFullMime($mime);
        if ($this->isUpload()) {
            $this->neverSerializePayload();
        }
        return $this;
    }
    public function addHeader($header_name, $value)
    {
        $this->headers[$header_name] = $value;
        return $this;
    }
=======

>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6

    public function addHeaders(array $headers)
    {
        foreach ($headers as $header => $value) {
            $this->addHeader($header, $value);
        }
        return $this;
    }
    public function expectsType($mime)
<<<<<<< HEAD
=======
    {
        return $this->expects($mime);
    }
    public function sendType($mime)
    {
        return $this->contentType = $mime;
    }
    public function expects($mime)
    {
        if (empty($mime)) return $this;
        $this->expected_type = Mime::getFullMime($mime);
        return $this;
    }

    /**
     * @return mixed
     */
    public function endCallback()
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    {
        return $this->expects($mime);
    }
    public function sendType($mime)
    {
        return $this->contentType = $mime;
    }
    public function expects($mime)
    {
        if (empty($mime)) return $this;
        $this->expected_type = Mime::getFullMime($mime);
        return $this;
    }
    /**
     * @param $field alias or field name
     * @return bool|mixed
     */
    public function getIni($field)
    {
        $alias = self::optionAlias($field);
        return isset($this->options[$alias]) ? $this->options[$alias] : false;
    }

    /**
     * @param $key
     * @return mixed
     */
    protected static function optionAlias($key)
    {
        $alias = false;
        if (isset(self::$curlAlias[$key])) {
            $alias = self::$curlAlias[$key];
        } elseif ((substr($key, 0, strlen('CURLOPT_')) == 'CURLOPT_') && defined($key)) {
            $alias = $key;
        }
        return $alias;
    }

<<<<<<< HEAD
    public function addQuery($data)
=======
    /**
     * @param $queryData
     * @return $this
     */
    public function addQuery($queryData)
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    {
        if (!empty($queryData)) {
            if (is_array($queryData)) {
                $this->withURIQuery = http_build_query($queryData);
            } else if (is_string($queryData)) {
                $this->withURIQuery = $queryData;
            } else {
                throw new InvalidArgumentException('data must be array or string');
            }
        }
        return $this;
    }
<<<<<<< HEAD

=======
    /**
     * @param $uri
     * @param null $payload
     * @param array $options
     * @return Request
     */
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    public function post($uri, $payload = null, array $options = array())
    {
        return $this->ini(Http::POST, $uri, $payload, $options);
    }

    /**
     * @param $uri
     * @param null $payload
<<<<<<< HEAD
=======
     * @param array $options
     * @param null $response
     * @return string
     */
    public function quickPost($uri, $payload = null, array $options = array(), &$response = null)
    {
        $response = $this->post($uri, $payload, $options)->send();
        return $response->body;
    }


    /**
     * @param $method
     * @param $url
     * @param $data
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
     * @param array $options
     * @param null $response
     * @return string
     */
    public function quickPost($uri, $payload = null, array $options = array(), &$response = null)
    {
        $response = $this->post($uri, $payload, $options)->send();
        return $response->body;
    }
    /*  no body  */

    protected function ini($method, $url,  $data , array $options = array())
    {
        $options = array('url' => $url, 'method' => $method, 'data' => $data) + $options;
        $this->addOptions($options);

        return $this;
    }

    public function addOptions(array $options = array())
    {
        $this->options = $options + $this->options;
        $this->uri = $this->options['url'];
        return $this;
    }

    function put($uri, $payload = null, array $options = array())
    {
        return $this->ini(Http::PUT, $uri, $payload, $options);
    }

    function patch($uri, $payload = null, array $options = array())
    {
        return $this->ini(Http::PATCH, $uri, $payload, $options);
    }

    public function get($uri, array $options = array())
    {
        return $this->ini(Http::GET, $uri, array(), $options);
    }


    /**
     * @param $uri
     * @param array $options
     * @param null $response
     * @return string
     */
    public function quickGet($uri, array $options = array(), &$response = null)
    {
        $response = $this->get($uri, $options)->send();
        return $response->body;
    }

    /**
     * @param $uri
     * @param array $options
     * @param null $response
     * @return string
     */
    public function quickGet($uri, array $options = array(), &$response = null)
    {
        $response = $this->get($uri, $options)->send();
        return $response->body;
    }

    function options($uri, array $options = array())
    {
        return $this->ini(Http::OPTIONS, $uri, array(), $options);
    }

    function head($uri, array $options = array())
    {
        return $this->ini(Http::HEAD, $uri, array('CURLOPT_NOBODY' => true), $options);
    }

    function delete($uri, array $options = array())
    {
        return $this->ini(Http::DELETE, $uri, array(), $options);
    }

    function trace($uri, array $options = array())
    {
        return $this->ini(Http::TRACE, $uri, array(), $options);
    }

    /**
     * @return Response
     */
    public function send()
    {
        if (!$this->hasInitialized)
            $this->applyOptions();
        $response = $this->makeResponse();
        if ($this->endCallback) {
            $func = $this->endCallback;
            $func($response);
        }
        return $response;
    }

    public function applyOptions()
    {
        $curl = curl_init();
        $this->curlHandle = $curl;
        $this->prepare();
        $this->hasInitialized = true;
        return $this;
    }

    protected function prepare()
    {
        if (empty($this->options['url'])) {
            throw new InvalidArgumentException('url can not empty');
        }

        if (isset($this->options['retry_times'])) {
<<<<<<< HEAD
           $this->retryTimes = abs($this->options['retry_times']);
        }

        if (isset($this->options['retry_duration'])) {
           $this->retryDuration = abs($this->options['retry_duration']);
=======
            $this->retryTimes = abs($this->options['retry_times']);
        }

        if (isset($this->options['retry_duration'])) {
            $this->retryDuration = abs($this->options['retry_duration']);
        }

        if(isset($this->options['expects_mime'])){
            $this->expectsMime($this->options['expects_mime']);
        }

        if(isset($this->options['send_mime'])){
            $this->sendMime($this->options['send_mime']);
        }

//        if(!empty($this->options['data']) && !Http::hasBody($this->options['method'])){
//            $this->withURIQuery =  is_array($this->options['data']) ? http_build_query($this->options['data']) : $this->options['data'];
//        }
        if (isset($this->withURIQuery)) {
            $this->options['url'] .= strpos($this->options['url'], '?') === FALSE ? '?' : '&';
            $this->options['url'] .= $this->withURIQuery;
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
        }

        if (isset($this->options['data'])) {
            $this->options['data'] = is_array($this->options['data']) ? http_build_query($this->options['data']) : $this->options['data'];//for better compatibility
        }
        if (isset($this->withURIQuery)) {
            $this->options['url'] .= strpos($this->options['url'], '?') === FALSE ? '?' : '&';
            $this->options['url'] .= $this->withURIQuery;
        }
        if (isset($this->options['callback'])) {
            $this->onEnd($this->options['callback']);
<<<<<<< HEAD
            unset($this->options['callback']);
=======
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
        }
        //swap ip and host
        if (!empty($this->options['ip'])) {
            $matches = array();
            preg_match('/\/\/([^\/]+)/', $this->options['url'], $matches);
            $host = $matches[1];
            if (empty($this->options['headers']) || !is_array($this->options['headers'])) {
                $this->options['headers'] = array('Host: ' . $host);
            } else {
                $this->options['headers'][] = 'Host: ' . $host;
            }
            $this->options['url'] = preg_replace('/\/\/([^\/]+)/', '//' . $this->options['ip'], $this->options['url']);
<<<<<<< HEAD
            unset($this->options['ip']);
=======
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
            unset($host);
        }
        //process version
        if (!empty($this->options['http_version'])) {
            $version = $this->options['http_version'];
            if ($version == '1.0') {
                $this->options['CURLOPT_HTTP_VERSION'] = CURLOPT_HTTP_VERSION_1_0;
            } elseif ($version == '1.1') {
                $this->options['CURLOPT_HTTP_VERSION'] = CURLOPT_HTTP_VERSION_1_1;
            }

            unset($version);
        }

        //convert secs to milliseconds
        if (defined('CURLOPT_TIMEOUT_MS')) {
            if (!isset($this->options['timeout_ms'])) {
                $this->options['timeout_ms'] = intval($this->options['timeout'] * 1000);
            } else {
                $this->options['timeout_ms'] = intval($this->options['timeout_ms']);
            }
        }

        $cURLOptions = self::filterAndRaw($this->options);
<<<<<<< HEAD

=======
        if(isset($this->body))$cURLOptions[CURLOPT_POSTFIELDS] = $this->body;//use serialized body not raw data
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
        curl_setopt_array($this->curlHandle, $cURLOptions);

        return $this;
    }

<<<<<<< HEAD
=======
    public function serializeBody()
    {
        if (isset($this->options['data'])) {
            if (isset($this->sendMime)) {
                $method = $this->sendMime;
                if (!method_exists($this, $method)) throw new InvalidOperationException($method . ' is not exists in ' . __CLASS__);
                $this->body = $this->$method($this->options['data']);
            } else {
                $this->body =  $this->options['data'];
            }

        }
    }

    /**
     * @param callable $callback
     * @return $this
     */
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
    public function onEnd(callable $callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('callback not is callable :' . print_r($callback, 1));
        }

        $this->endCallback = $callback;
        return $this;
    }

    protected static function filterAndRaw(array &$options)
    {
        $opts = array();
        foreach ($options as $key => $val) {
            $alias = self::optionAlias($key);
            $options[$alias] = $val;
            if ($alias) {
                $opts[constant($alias)] = $val;
            }
            unset($options[$key]);
        }
        return $opts;
    }


    public function makeResponse($isMultiCurl = false)
    {
        $handle = $this->curlHandle;
        $body = $errno = null;
        Helper::retry($this->retryTimes, function()use(&$body, &$errno, $isMultiCurl, $handle){
            $body = $isMultiCurl ? curl_multi_getcontent($handle) : curl_exec($handle);
            $errno = curl_errno($handle);
<<<<<<< HEAD
            var_dump(curl_error($handle), time());
            ob_flush();
            flush();
=======
>>>>>>> 1799bc479182f58431deae9f8975bf80f1e7cee6
            return 0 == $errno;
        }, $this->retryDuration);

        $info = curl_getinfo($this->curlHandle);
        $error = curl_error($this->curlHandle);
        $response = Response::create($this, $body, $info, $errno, $error);
        if (!is_null(self::$logger)) {
            self::log($response);
        }

        return $response;
    }

    private static function log(Response $response)
    {
        if ($response->hasErrors()) {
            self::$logger->error($response->request->getURI() . "\t" . $response->error, array(
                'response' => print_r($response, 1),
            ));
        }

    }
}
