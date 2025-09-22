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

class GoogleCloudAiplatformV1EvaluationRunMetric extends \Google\Model
{
  protected $computationBasedMetricSpecType = GoogleCloudAiplatformV1EvaluationRunMetricComputationBasedMetricSpec::class;
  protected $computationBasedMetricSpecDataType = '';
  protected $llmBasedMetricSpecType = GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec::class;
  protected $llmBasedMetricSpecDataType = '';
  /**
   * @var string
   */
  public $metric;
  protected $predefinedMetricSpecType = GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec::class;
  protected $predefinedMetricSpecDataType = '';
  protected $rubricBasedMetricSpecType = GoogleCloudAiplatformV1EvaluationRunMetricRubricBasedMetricSpec::class;
  protected $rubricBasedMetricSpecDataType = '';

  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricComputationBasedMetricSpec
   */
  public function setComputationBasedMetricSpec(GoogleCloudAiplatformV1EvaluationRunMetricComputationBasedMetricSpec $computationBasedMetricSpec)
  {
    $this->computationBasedMetricSpec = $computationBasedMetricSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricComputationBasedMetricSpec
   */
  public function getComputationBasedMetricSpec()
  {
    return $this->computationBasedMetricSpec;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec
   */
  public function setLlmBasedMetricSpec(GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec $llmBasedMetricSpec)
  {
    $this->llmBasedMetricSpec = $llmBasedMetricSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricLLMBasedMetricSpec
   */
  public function getLlmBasedMetricSpec()
  {
    return $this->llmBasedMetricSpec;
  }
  /**
   * @param string
   */
  public function setMetric($metric)
  {
    $this->metric = $metric;
  }
  /**
   * @return string
   */
  public function getMetric()
  {
    return $this->metric;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec
   */
  public function setPredefinedMetricSpec(GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec $predefinedMetricSpec)
  {
    $this->predefinedMetricSpec = $predefinedMetricSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricPredefinedMetricSpec
   */
  public function getPredefinedMetricSpec()
  {
    return $this->predefinedMetricSpec;
  }
  /**
   * @param GoogleCloudAiplatformV1EvaluationRunMetricRubricBasedMetricSpec
   */
  public function setRubricBasedMetricSpec(GoogleCloudAiplatformV1EvaluationRunMetricRubricBasedMetricSpec $rubricBasedMetricSpec)
  {
    $this->rubricBasedMetricSpec = $rubricBasedMetricSpec;
  }
  /**
   * @return GoogleCloudAiplatformV1EvaluationRunMetricRubricBasedMetricSpec
   */
  public function getRubricBasedMetricSpec()
  {
    return $this->rubricBasedMetricSpec;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1EvaluationRunMetric::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1EvaluationRunMetric');
