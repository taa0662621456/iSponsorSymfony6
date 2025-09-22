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

namespace Google\Service\SQLAdmin;

class SqlInstancesExecuteSqlResponse extends \Google\Collection
{
  protected $collection_key = 'results';
  protected $metadataType = Metadata::class;
  protected $metadataDataType = '';
  protected $resultsType = QueryResult::class;
  protected $resultsDataType = 'array';

  /**
   * @param Metadata
   */
  public function setMetadata(Metadata $metadata)
  {
    $this->metadata = $metadata;
  }
  /**
   * @return Metadata
   */
  public function getMetadata()
  {
    return $this->metadata;
  }
  /**
   * @param QueryResult[]
   */
  public function setResults($results)
  {
    $this->results = $results;
  }
  /**
   * @return QueryResult[]
   */
  public function getResults()
  {
    return $this->results;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SqlInstancesExecuteSqlResponse::class, 'Google_Service_SQLAdmin_SqlInstancesExecuteSqlResponse');
