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

class GoogleCloudAiplatformV1EvaluationPrompt extends \Google\Model
{
  protected $promptTemplateDataType = GoogleCloudAiplatformV1EvaluationPromptPromptTemplateData::class;
  protected $promptTemplateDataDataType = '';
  /**
   * @var string
   */
  public $text;
  /**
   * @var array
   */
  public $value;

  /**
   * @param GoogleCloudAiplatformV1EvaluationPromptPromptTemplateData
   */
  public function setPromptTemplateData(GoogleCloudAiplatformV1EvaluationPromptPromptTemplateData $promptTemplateData)
  {
    $this->promptTemplateData = $promptTemplateData;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationPromptPromptTemplateData
   */
  public function getPromptTemplateData()
  {
    return $this->promptTemplateData;
  }
  /**
   * @param string
   */
  public function setText($text)
  {
    $this->text = $text;
  }
  /**
   * @return string
   */
  public function getText()
  {
    return $this->text;
  }
  /**
   * @param array
   */
  public function setValue($value)
  {
    $this->value = $value;
  }
  /**
   * @return array
   */
  public function getValue()
  {
    return $this->value;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1EvaluationPrompt::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1EvaluationPrompt');
