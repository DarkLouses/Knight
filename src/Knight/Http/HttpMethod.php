<?php

namespace Knight\Http;

/**
 * Enum representing HTTP methods.
 */
enum HttpMethod: String {
    /**
     * HTTP GET method.
     */
    case GET = "GET";

    /**
     * HTTP POST method.
     */
    case POST = "POST";

    /**
     * HTTP PUT method.
     */
    case PUT = "PUT";

    /**
     * HTTP DELETE method.
     */
    case DELETE = "DELETE";

    /**
     * HTTP PATCH method.
     */
    case PATCH = "PATCH";
}