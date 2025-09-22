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

class GoogleCloudAiplatformV1RubricGroup extends \Google\Collection
{
  protected $collection_key = 'rubrics';
  /**
   * @var string
   */
  public $displayName;
  /**
   * @var string
   */
  public $groupId;
  protected $rubricsType = GoogleCloudAiplatformV1Rubric::class;
  protected $rubricsDataType = 'array';

  /**
   * @param string
   */
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  /**
   * @return string
   */
  public function getDisplayName()
  {
    return $this->displayName;
  }
  /**
   * @param string
   */
  public function setGroupId($groupId)
  {
    $this->groupId = $groupId;
  }
  /**
   * @return string
   */
  public function getGroupId()
  {
    return $this->groupId;
  }
  /**
   * @param GoogleCloudAiplatformV1Rubric[]
   */
  public function setRubrics($rubrics)
  {
    $this->rubrics = $rubrics;
  }
  /**
   * @return GoogleCloudAiplatformV1Rubric[]
   */
  public function getRubrics()
  {
    return $this->rubrics;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudAiplatformV1RubricGroup::class, 'Google_Service_Aiplatform_GoogleCloudAiplatformV1RubricGroup');
