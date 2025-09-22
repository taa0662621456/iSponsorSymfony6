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

class GoogleCloudAiplatformV1CandidateResult extends \Google\Collection
{
  protected $collection_key = 'rubricVerdicts';
  /**
   * @var array
   */
  public $additionalResults;
  /**
   * @var string
   */
  public $candidate;
  /**
   * @var string
   */
  public $explanation;
  /**
   * @var string
   */
  public $metric;
  protected $rubricVerdictsType = GoogleCloudAiplatformV1RubricVerdict::class;
  protected $rubricVerdictsDataType = 'array';
  /**
   * @var float
   */
  public $score;

  /**
   * @param array
   */
  public function setAdditionalResults($additionalResults)
  {
    $this->additionalResults = $additionalResults;
  }
  /**
   * @return array
   */
  public function getAdditionalResults()
  {
    return $this->additionalResults;
  }
  /**
   * @param string
   */
  public function setCandidate($candidate)
  {
    $this->candidate = $candidate;
  }
  /**
   * @return string
   */
  public function getCandidate()
  {
    return $this->candidate;
  }
  /**
   * @param string
   */
  public function setExplanation($explanation)
  {
    $this->explanation = $explanation;
  }
  /**
   * @return string
   */
  public function getExplanation()
  {
    return $this->explanation;
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
   * @param GoogleCloudAiplatformV1RubricVerdict[]
   */
  public function setRubricVerdicts($rubricVerdicts)
  {
    $this->rubricVerdicts = $rubricVerdicts;
  }
  /**
   * @return GoogleCloudAiplatformV1RubricVerdict[]
   */
  public function getRubricVerdicts()
  {
    return $this->rubricVerdicts;
  }
  /**
   * @param float
   */
  public function setScore($score)
  {
    $this->score = $score;
  }
  /**
   * @return float
   */
  public function getScore()
  {
    return $this->score;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1CandidateResult::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1CandidateResult');
