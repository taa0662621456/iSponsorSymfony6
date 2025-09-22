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

class GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec extends \Google\Model
{
  /**
   * @var array[]
   */
  public $additionalConfig;
  protected $judgeAutoraterConfigType = GoogleCloudAiplatformV1EvaluationRunEvaluationConfigAutoraterConfig::class;
  protected $judgeAutoraterConfigDataType = '';
  /**
   * @var string
   */
  public $metricPromptTemplate;
  protected $predefinedRubricGenerationSpecType = GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec::class;
  protected $predefinedRubricGenerationSpecDataType = '';
  protected $rubricGenerationSpecType = GoogleCloudAiplatformV1EvaluationRunMetricRubricGenerationSpec::class;
  protected $rubricGenerationSpecDataType = '';
  /**
   * @var string
   */
  public $rubricGroupKey;
  /**
   * @var string
   */
  public $systemInstruction;

  /**
   * @param array[]
   */
  public function setAdditionalConfig($additionalConfig)
  {
    $this->additionalConfig = $additionalConfig;
  }
  /**
   * @return array[]
   */
  public function getAdditionalConfig()
  {
    return $this->additionalConfig;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunEvaluationConfigAutoraterConfig
   */
  public function setJudgeAutoraterConfig(GoogleCloudAiplatformV1EvaluationRunEvaluationConfigAutoraterConfig $judgeAutoraterConfig)
  {
    $this->judgeAutoraterConfig = $judgeAutoraterConfig;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunEvaluationConfigAutoraterConfig
   */
  public function getJudgeAutoraterConfig()
  {
    return $this->judgeAutoraterConfig;
  }
  /**
   * @param string
   */
  public function setMetricPromptTemplate($metricPromptTemplate)
  {
    $this->metricPromptTemplate = $metricPromptTemplate;
  }
  /**
   * @return string
   */
  public function getMetricPromptTemplate()
  {
    return $this->metricPromptTemplate;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec
   */
  public function setPredefinedRubricGenerationSpec(GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec $predefinedRubricGenerationSpec)
  {
    $this->predefinedRubricGenerationSpec = $predefinedRubricGenerationSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec
   */
  public function getPredefinedRubricGenerationSpec()
  {
    return $this->predefinedRubricGenerationSpec;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricRubricGenerationSpec
   */
  public function setRubricGenerationSpec(GoogleCloudAiplatformV1EvaluationRunMetricRubricGenerationSpec $rubricGenerationSpec)
  {
    $this->rubricGenerationSpec = $rubricGenerationSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricRubricGenerationSpec
   */
  public function getRubricGenerationSpec()
  {
    return $this->rubricGenerationSpec;
  }
  /**
   * @param string
   */
  public function setRubricGroupKey($rubricGroupKey)
  {
    $this->rubricGroupKey = $rubricGroupKey;
  }
  /**
   * @return string
   */
  public function getRubricGroupKey()
  {
    return $this->rubricGroupKey;
  }
  /**
   * @param string
   */
  public function setSystemInstruction($systemInstruction)
  {
    $this->systemInstruction = $systemInstruction;
  }
  /**
   * @return string
   */
  public function getSystemInstruction()
  {
    return $this->systemInstruction;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec');
