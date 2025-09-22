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

namespace Google\Service\DriveLabels;

class GoogleAppsDriveLabelsV2LabelEnabledAppSettings extends \Google\Collection
{
  protected $collection_key = 'enabledApps';
  protected $enabledAppsType = GoogleAppsDriveLabelsV2LabelEnabledAppSettingsEnabledApp::class;
  protected $enabledAppsDataType = 'array';

  /**
   * @param GoogleAppsDriveLabelsV2LabelEnabledAppSettingsEnabledApp[]
   */
  public function setEnabledApps($enabledApps)
  {
    $this->enabledApps = $enabledApps;
  }
  /**
   * @return GoogleAppsDriveLabelsV2LabelEnabledAppSettingsEnabledApp[]
   */
  public function getEnabledApps()
  {
    return $this->enabledApps;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleAppsDriveLabelsV2LabelEnabledAppSettings::class, 'Google_Service_DriveLabels_GoogleAppsDriveLabelsV2LabelEnabledAppSettings');
