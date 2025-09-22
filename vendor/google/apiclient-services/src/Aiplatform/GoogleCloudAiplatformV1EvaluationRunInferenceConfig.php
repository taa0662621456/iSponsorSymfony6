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

class GoogleCloudAiplatformV1EvaluationRunInferenceConfig extends \Google\Model
{
  protected $generationConfigType = GoogleCloudAiplatformV1GenerationConfig::class;
  protected $generationConfigDataType = '';
  /**
   * @var string
   */
  public $model;

  /**
   * @param GoogleCloudAiplatformV1GenerationConfig
   */
  public function setGenerationConfig(GoogleCloudAiplatformV1GenerationConfig $generationConfig)
  {
    $this->generationConfig = $generationConfig;
  }
  /**
   * @return GoogleCloudAiplatformV1GenerationConfig
   */
  public function getGenerationConfig()
  {
    return $this->generationConfig;
  }
  /**
   * @param string
   */
  public function setModel($model)
  {
    $this->model = $model;
  }
  /**
   * @return string
   */
  public function getModel()
  {
    return $this->model;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1EvaluationRunInferenceConfig::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1EvaluationRunInferenceConfig');
