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

namespace Google\Service\Connectors;

class Tool extends \Google\Collection
{
  protected $collection_key = 'dependsOn';
  /**
   * @var string[]
   */
  public $dependsOn;
  /**
   * @var string
   */
  public $description;
  protected $inputSchemaType = JsonSchema::class;
  protected $inputSchemaDataType = '';
  /**
   * @var string
   */
  public $name;
  protected $outputSchemaType = JsonSchema::class;
  protected $outputSchemaDataType = '';

  /**
   * @param string[]
   */
  public function setDependsOn($dependsOn)
  {
    $this->dependsOn = $dependsOn;
  }
  /**
   * @return string[]
   */
  public function getDependsOn()
  {
    return $this->dependsOn;
  }
  /**
   * @param string
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }
  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->description;
  }
  /**
   * @param JsonSchema
   */
  public function setInputSchema(JsonSchema $inputSchema)
  {
    $this->inputSchema = $inputSchema;
  }
  /**
   * @return JsonSchema
   */
  public function getInputSchema()
  {
    return $this->inputSchema;
  }
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
   * @param JsonSchema
   */
  public function setOutputSchema(JsonSchema $outputSchema)
  {
    $this->outputSchema = $outputSchema;
  }
  /**
   * @return JsonSchema
   */
  public function getOutputSchema()
  {
    return $this->outputSchema;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Tool::class, 'Google_Service_Connectors_Tool');
