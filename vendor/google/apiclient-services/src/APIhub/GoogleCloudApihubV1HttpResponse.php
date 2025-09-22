<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\APIhub;

class GoogleCloudApihubV1HttpResponse extends \Google\Model
{
  protected $headersType = GoogleCloudApihubV1Header::class;
  protected $headersDataType = 'map';
  /**
   * @var string[]
   */
  public $responseCodes;

  /**
   * @param GoogleCloudApihubV1Header[]
   */
  public function setHeaders($headers)
  {
    $this->headers = $headers;
  }
  /**
   * @return GoogleCloudApihubV1Header[]
   */
  public function getHeaders()
  {
    return $this->headers;
  }
  /**
   * @param string[]
   */
  public function setResponseCodes($responseCodes)
  {
    $this->responseCodes = $responseCodes;
  }
  /**
   * @return string[]
   */
  public function getResponseCodes()
  {
    return $this->responseCodes;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudApihubV1HttpResponse::class, 'Google_Service_APIhub_GoogleCloudApihubV1HttpResponse');
