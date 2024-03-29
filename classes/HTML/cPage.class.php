<?php

/**
 * @name cPage.class.php
 * @author Francois Bissonnette <fbissonn@gmail.com>
 * @version Created on 2011-11-05, 09:31:47
 * @copyright (c) <2011>, <Francois Bissonnette <fbissonn@gmail.com>> All rights reserved.
 * @package APP_GLOBAL\WEB\WEBFORM\CPAGE
 */
/*
 * 
 * 
 * @license Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *  * Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *  * Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *  * Neither the name of the Francois bissonnette nor the
 *    names of its contributors may be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL FRANCOIS BISSONNETTE BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * 
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace APP_GLOBAL\WEB\WEBFORM\CPAGE;


/**
 * Used to create a custom web page using information provided by the database
 * @package APP_GLOBAL\WEB\WEBFORM\
 * @subpackage cPage()
 */
class cPage extends \APP_GLOBAL\WEB\WEBFORM\cForm
{
     /**
     * @see cPage()
     * @uses handling database connection.
     * @var mixed 
     * @access private
     */
    private $con;
    /**
     * 
     * @var type string keep the database name
     */
    private $sDatabase;

    function __construct($sDatabase)
    {
        $this->sDatabase = $sDatabase;
    }

    function createPage($PageName)
    {
        cHTML::addHeader($PageName);
        cHTML::addMenu($this->sDatabase);
        $this->doIt($PageName);
        cHTML::addFooter();
    }

    function doIt($PageName)
    {

        cForm::createCustomForm($PageName);
    }

}

?>