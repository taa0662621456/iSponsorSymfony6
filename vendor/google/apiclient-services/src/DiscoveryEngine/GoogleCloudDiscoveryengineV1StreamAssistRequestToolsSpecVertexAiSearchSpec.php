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

namespace Google\Service\DiscoveryEngine;

class GoogleCloudDiscoveryengineV1StreamAssistRequestToolsSpecVertexAiSearchSpec extends \Google\Collection
{
  protected $collection_key = 'dataStoreSpecs';
  protected $dataStoreSpecsType = GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec::class;
  protected $dataStoreSpecsDataType = 'array';
  /**
   * @var string
   */
  public $filter;

  /**
   * @param GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec[]
   */
  public function setDataStoreSpecs($dataStoreSpecs)
  {
    $this->dataStoreSpecs = $dataStoreSpecs;
  }
  /**
   * @return GoogleCloudDiscoveryengineV1SearchRequestDataStoreSpec[]
   */
  public function getDataStoreSpecs()
  {
    return $this->dataStoreSpecs;
  }
  /**
   * @param string
   */
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  /**
   * @return string
   */
  public function getFilter()
  {
    return $this->filter;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDiscoveryengineV1StreamAssistRequestToolsSpecVertexAiSearchSpec::class, 'Google_Service_DiscoveryEngine_GoogleCloudDiscoveryengineV1StreamAssistRequestToolsSpecVertexAiSearchSpec');
