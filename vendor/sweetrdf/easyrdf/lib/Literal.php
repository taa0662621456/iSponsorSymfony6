<?php

namespace EasyRdf;

/**
 * EasyRdf
 *
 * LICENSE
 *
 * Copyright (c) 2009-2014 Nicholas J Humfrey.  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. The name of the author 'Nicholas J Humfrey" may be used to endorse or
 *    promote products derived from this software without specific prior
 *    written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright  Copyright (c) 2009-2014 Nicholas J Humfrey
 * @license    https://www.opensource.org/licenses/bsd-license.php
 */

/**
 * Class that represents an RDF Literal
 *
 * @copyright  Copyright (c) 2009-2014 Nicholas J Humfrey
 * @license    https://www.opensource.org/licenses/bsd-license.php
 */
class Literal
{
    /** @ignore a mapping from datatype uri to class name */
    private static $datatypeMap = [];

    /** @ignore A mapping from class name to datatype URI */
    private static $classMap = [];

    /** @ignore The string value for this literal */
    protected $value;

    /** @ignore The language of the literal (e.g. 'en') */
    protected $lang;

    /**
     * The datatype URI of the literal
     *
     * @var string|\EasyRdf\ParsedUri|null
     */
    protected $datatype;

    /** Create a new literal object
     *
     * PHP values of type bool, int or float, will automatically be converted
     * to the corresponding datatype and PHP sub-class.
     *
     * If a registered datatype is given, then the registered subclass of EasyRdf\Literal
     * will instantiated.
     *
     * Note that literals are not required to have a language or datatype.
     * Literals cannot have both a language and a datatype.
     *
     * @param mixed  $value    The value of the literal or an associative array
     * @param string $lang     The natural language of the literal or null (e.g. 'en')
     * @param string $datatype The datatype of the literal or null (e.g. 'xsd:integer')
     *
     * @return self (or subclass of EasyRdf\Literal)
     */
    public static function create($value, $lang = null, $datatype = null)
    {
        if (Utils::isAssociativeArray($value)) {
            if (isset($value['xml:lang'])) {
                $lang = $value['xml:lang'];
            } elseif (isset($value['lang'])) {
                $lang = $value['lang'];
            }
            if (isset($value['datatype'])) {
                $datatype = $value['datatype'];
            }
            $value = isset($value['value']) ? $value['value'] : null;
        }

        if (null === $datatype || '' === $datatype) {
            if (null === $lang || '' === $lang) {
                // Automatic datatype selection
                $datatype = self::getDatatypeForValue($value);
            }
        } elseif (\is_object($datatype)) {
            $datatype = (string) $datatype;
        } else {
            // Expand shortened URIs (qnames)
            $datatype = RdfNamespace::expand($datatype);
        }

        // Work out what class to use for this datatype
        if (isset(self::$datatypeMap[$datatype])) {
            $class = self::$datatypeMap[$datatype];
        } else {
            $class = 'EasyRdf\Literal';
        }

        return new $class($value, $lang, $datatype);
    }

    /** Register an RDF datatype with a PHP class name
     *
     * When parsing registered class will be used whenever the datatype
     * is seen.
     *
     * When serialising a registered class, the mapping will be used to
     * set the datatype in the RDF.
     *
     * Example:
     * EasyRdf\Literal::registerDatatype('xsd:dateTime', 'My_DateTime_Class');
     *
     * @param string $datatype The RDF datatype (e.g. xsd:dateTime)
     * @param string $class    The PHP class name (e.g. My_DateTime_Class)
     *
     * @throws \InvalidArgumentException
     */
    public static function setDatatypeMapping($datatype, $class)
    {
        if (!\is_string($datatype) || (\is_string($datatype) && 0 == \strlen($datatype))) {
            throw new \InvalidArgumentException('$datatype should be a string and cannot be null or empty');
        }

        if (!\is_string($class) || (\is_string($class) && 0 == \strlen($class))) {
            throw new \InvalidArgumentException('$class should be a string and cannot be null or empty');
        }

        $datatype = RdfNamespace::expand($datatype);
        self::$datatypeMap[$datatype] = $class;
        self::$classMap[$class] = $datatype;
    }

    /** Remove the mapping between an RDF datatype and a PHP class name
     *
     * @param string $datatype The RDF datatype (e.g. xsd:dateTime)
     *
     * @throws \InvalidArgumentException
     */
    public static function deleteDatatypeMapping($datatype)
    {
        if (!\is_string($datatype) || (\is_string($datatype) && 0 == \strlen($datatype))) {
            throw new \InvalidArgumentException('$datatype should be a string and cannot be null or empty');
        }

        $datatype = RdfNamespace::expand($datatype);
        if (isset(self::$datatypeMap[$datatype])) {
            $class = self::$datatypeMap[$datatype];
            unset(self::$datatypeMap[$datatype]);
            unset(self::$classMap[$class]);
        }
    }

    /** Get datatype URI for a PHP value.
     *
     * This static function is intended for internal use.
     * Given a PHP value, it will return an XSD datatype
     * URI for that value, for example:
     * http://www.w3.org/2001/XMLSchema#integer
     *
     * @return string|null a URI for the datatype of $value
     */
    public static function getDatatypeForValue($value)
    {
        if (\is_float($value)) {
            return 'http://www.w3.org/2001/XMLSchema#double';
        } elseif (\is_int($value)) {
            return 'http://www.w3.org/2001/XMLSchema#integer';
        } elseif (\is_bool($value)) {
            return 'http://www.w3.org/2001/XMLSchema#boolean';
        } elseif (\is_object($value) && $value instanceof \DateTime) {
            return 'http://www.w3.org/2001/XMLSchema#dateTime';
        } else {
            return null;
        }
    }

    /** Constructor for creating a new literal
     *
     * @param string|float                   $value    The value of the literal
     * @param string                         $lang     The natural language of the literal or null (e.g. 'en')
     * @param string|\EasyRdf\ParsedUri|null $datatype The datatype of the literal or null (e.g. 'xsd:string')
     *
     * @return Literal
     */
    public function __construct($value, $lang = null, $datatype = null)
    {
        $this->value = $value;
        $this->lang = $lang ?: null;
        $this->datatype = $datatype ?: null;

        if ($this->datatype) {
            if (\is_object($this->datatype)) {
                // Convert objects to strings
                $this->datatype = (string) $this->datatype;
            } else {
                // Expand shortened URIs (CURIEs)
                $this->datatype = RdfNamespace::expand($this->datatype);
            }

            // Literals can not have both a language and a datatype
            $this->lang = null;
        } else {
            // Set the datatype based on the subclass
            $class = static::class;
            if (isset(self::$classMap[$class])) {
                $this->datatype = self::$classMap[$class];
                $this->lang = null;
            }
        }

        if (\is_float($this->value)) {
            // special handling of floats, as they suffer from locale [mis]configuration
            $this->value = rtrim(sprintf('%F', $this->value), '0');
        } else {
            // Cast value to string
            settype($this->value, 'string');
        }
    }

    /** Returns the value of the literal.
     *
     * @return string|int|bool|\DateTime value of this literal
     */
    public function getValue()
    {
        return $this->value;
    }

    /** Returns the full datatype URI of the literal.
     *
     * @return string datatype URI of this literal
     */
    public function getDatatypeUri()
    {
        return $this->datatype;
    }

    /** Returns the shortened datatype URI of the literal.
     *
     * @return string|null Datatype of this literal (e.g. xsd:integer).
     */
    public function getDatatype()
    {
        if ($this->datatype) {
            return RdfNamespace::shorten($this->datatype);
        } else {
            return null;
        }
    }

    /** Returns the language of the literal.
     *
     * @return string language of this literal
     */
    public function getLang()
    {
        return $this->lang;
    }

    /** Returns the properties of the literal as an associative array
     *
     * For example:
     * array('type' => 'literal', 'value' => 'string value')
     *
     * @return array The properties of the literal
     */
    public function toRdfPhp()
    {
        $array = [
            'type' => 'literal',
            'value' => $this->value,
        ];

        if ($this->datatype) {
            $array['datatype'] = $this->datatype;
        }

        if ($this->lang) {
            $array['lang'] = $this->lang;
        }

        return $array;
    }

    /** Magic method to return the value of a literal as a string
     *
     * @return string The value of the literal
     */
    public function __toString()
    {
        return isset($this->value) ? $this->value : '';
    }

    /** Return pretty-print view of the literal
     *
     * @param string $format Either 'html' or 'text'
     * @param string $color  The colour of the text
     *
     * @return string
     */
    public function dumpValue($format = 'html', $color = 'black')
    {
        return Utils::dumpLiteralValue($this, $format, $color);
    }
}

/*
   Register default set of datatype classes
*/

Literal::setDatatypeMapping('xsd:boolean', 'EasyRdf\Literal\Boolean');
Literal::setDatatypeMapping('xsd:date', 'EasyRdf\Literal\Date');
Literal::setDatatypeMapping('xsd:dateTime', 'EasyRdf\Literal\DateTime');
Literal::setDatatypeMapping('xsd:decimal', 'EasyRdf\Literal\Decimal');
Literal::setDatatypeMapping('xsd:hexBinary', 'EasyRdf\Literal\HexBinary');
Literal::setDatatypeMapping('rdf:HTML', 'EasyRdf\Literal\HTML');
Literal::setDatatypeMapping('xsd:integer', 'EasyRdf\Literal\Integer');
Literal::setDatatypeMapping('rdf:XMLLiteral', 'EasyRdf\Literal\XML');
