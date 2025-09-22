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

class GoogleCloudAiplatformV1GenerateSyntheticDataRequest extends \Google\Collection
{
  protected $collection_key = 'outputFieldSpecs';
  /**
   * @var int
   */
  public $count;
  protected $examplesType = GoogleCloudAiplatformV1SyntheticExample::class;
  protected $examplesDataType = 'array';
  protected $outputFieldSpecsType = GoogleCloudAiplatformV1OutputFieldSpec::class;
  protected $outputFieldSpecsDataType = 'array';
  protected $taskDescriptionType = GoogleCloudAiplatformV1TaskDescriptionStrategy::class;
  protected $taskDescriptionDataType = '';

  /**
   * @param int
   */
  public function setCount($count)
  {
    $this->count = $count;
  }
  /**
   * @return int
   */
  public function getCount()
  {
    return $this->count;
  }
  /**
   * @param GoogleCloudAiplatformV1SyntheticExample[]
   */
  public function setExamples($examples)
  {
    $this->examples = $examples;
  }
  /**
   * @return GoogleCloudAiplatformV1SyntheticExample[]
   */
  public function getExamples()
  {
    return $this->examples;
  }
  /**
   * @param GoogleCloudAiplatformV1OutputFieldSpec[]
   */
  public function setOutputFieldSpecs($outputFieldSpecs)
  {
    $this->outputFieldSpecs = $outputFieldSpecs;
  }
  /**
   * @return GoogleCloudAiplatformV1OutputFieldSpec[]
   */
  public function getOutputFieldSpecs()
  {
    return $this->outputFieldSpecs;
  }
  /**
   * @param GoogleCloudAiplatformV1TaskDescriptionStrategy
   */
  public function setTaskDescription(GoogleCloudAiplatformV1TaskDescriptionStrategy $taskDescription)
  {
    $this->taskDescription = $taskDescription;
  }
  /**
   * @return GoogleCloudAiplatformV1TaskDescriptionStrategy
   */
  public function getTaskDescription()
  {
    return $this->taskDescription;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1GenerateSyntheticDataRequest::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1GenerateSyntheticDataRequest');
