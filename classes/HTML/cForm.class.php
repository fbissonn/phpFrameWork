<?php
  /**
 * File:   cForm.class.php
 * Author: Francois Bissonnette <fbissonn@gmail.com>
 * 
 * Created on 2011-11-05, 09:31:47
 * 
 * Copyright (c) <2011>, <Francois Bissonnette <fbissonn@gmail.com>>
 * 
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
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
namespace APP_GLOBAL\WEB\WEBFORM;
  class cForm extends cHTML
  {
    private $con;
    
    function __construct()
    {
      
    }
    
    function createCon()
    {
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs");
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/priv/params.php");       
        global $SERVER;
        global $USERNAME;
        global $PASSWORD;
        global $DBNAME;
        global $DEBUGMODE;
        $this->con = new cMysql($SERVER, $USERNAME, $PASSWORD, $DBNAME, $DEBUGMODE);
    }
    
    function createCustomForm($formName)
    { 
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs");
        $this->createCon(); 
        //print("call `mydb`.`VIEWAFORM`('$formName');");
        $this->con->qryWResults("call `mydb`.`VIEWAFORM`('$formName');");
        cHTML::addFormHeader($this->con->getResult(0,0),$this->con->getResult(0,1));
        cHTML::addFieldset($this->con->getResult(0,0));
        for($Row = 0; $Row < $this->con->getNbRow(); $Row++)
        {
           cHTML::addInputBox($this->con->getResult($Row,2),$this->con->getResult($Row,3),$this->con->getResult($Row,4),"",$this->con->getResult($Row,5), $this->con->getResult($Row,6), $this->con->getResult($Row,7));  
           cHTML::addBR(1);      
        }    
        cHTML::addFormFooter();
        cHTML::closeFieldset($this->con->getResult(0,0));
    }
  }
?>