<?php

namespace Knight;

enum HttpMethod: String {
    case  GET = "GET";
    case  POST = "POST";
    case  PUT = "PUT";
    case  DELETE = "DELETE";
    case  PATCH = "PATCH";

}