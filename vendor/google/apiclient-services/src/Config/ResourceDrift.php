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

namespace Google\Service\Config;

class ResourceDrift extends \Google\Collection
{
  protected $collection_key = 'propertyDrifts';
  /**
   * @var string
   */
  public $name;
  protected $propertyDriftsType = PropertyDrift::class;
  protected $propertyDriftsDataType = 'array';
  protected $terraformInfoType = ResourceDriftTerraformInfo::class;
  protected $terraformInfoDataType = '';

  /**
   * @param string
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param PropertyDrift[]
   */
  public function setPropertyDrifts($propertyDrifts)
  {
    $this->propertyDrifts = $propertyDrifts;
  }
  /**
   * @return PropertyDrift[]
   */
  public function getPropertyDrifts()
  {
    return $this->propertyDrifts;
  }
  /**
   * @param ResourceDriftTerraformInfo
   */
  public function setTerraformInfo(ResourceDriftTerraformInfo $terraformInfo)
  {
    $this->terraformInfo = $terraformInfo;
  }
  /**
   * @return ResourceDriftTerraformInfo
   */
  public function getTerraformInfo()
  {
    return $this->terraformInfo;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ResourceDrift::class, 'Google_Service_Config_ResourceDrift');
