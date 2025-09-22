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

namespace Google\Service\Aiplatform;

class GoogleCloudAiplatformV1SyntheticExample extends \Google\Collection
{
  protected $collection_key = 'fields';
  protected $fieldsType = GoogleCloudAiplatformV1SyntheticField::class;
  protected $fieldsDataType = 'array';

  /**
   * @param GoogleCloudAiplatformV1SyntheticField[]
   */
  public function setFields($fields)
  {
    $this->fields = $fields;
  }
  /**
   * @return GoogleCloudAiplatformV1SyntheticField[]
   */
  public function getFields()
  {
    return $this->fields;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1SyntheticExample::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1SyntheticExample');
