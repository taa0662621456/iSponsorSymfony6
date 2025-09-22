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

namespace Google\Service\SecurityCommandCenter;

class GoogleCloudSecuritycenterV2ComplianceDetails extends \Google\Collection
{
  protected $collection_key = 'frameworks';
  protected $cloudControlType = GoogleCloudSecuritycenterV2CloudControl::class;
  protected $cloudControlDataType = '';
  /**
   * @var string[]
   */
  public $cloudControlDeploymentNames;
  protected $frameworksType = GoogleCloudSecuritycenterV2Framework::class;
  protected $frameworksDataType = 'array';

  /**
   * @param GoogleCloudSecuritycenterV2CloudControl
   */
  public function setCloudControl(GoogleCloudSecuritycenterV2CloudControl $cloudControl)
  {
    $this->cloudControl = $cloudControl;
  }
  /**
   * @return GoogleCloudSecuritycenterV2CloudControl
   */
  public function getCloudControl()
  {
    return $this->cloudControl;
  }
  /**
   * @param string[]
   */
  public function setCloudControlDeploymentNames($cloudControlDeploymentNames)
  {
    $this->cloudControlDeploymentNames = $cloudControlDeploymentNames;
  }
  /**
   * @return string[]
   */
  public function getCloudControlDeploymentNames()
  {
    return $this->cloudControlDeploymentNames;
  }
  /**
   * @param GoogleCloudSecuritycenterV2Framework[]
   */
  public function setFrameworks($frameworks)
  {
    $this->frameworks = $frameworks;
  }
  /**
   * @return GoogleCloudSecuritycenterV2Framework[]
   */
  public function getFrameworks()
  {
    return $this->frameworks;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudSecuritycenterV2ComplianceDetails::class, 'Google_Service_SecurityCommandCenter_GoogleCloudSecuritycenterV2ComplianceDetails');
