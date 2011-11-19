<?php
  /**
 * File:   cHTML.class.php
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
namespace APP_GLOBAL\WEB;

  class cHTML
  {   
      private $numOfVar = 0;
      private $con;
    // Elements de la classe
  
    function __construct()
    {
       
    }
    
    private function createCon()
    {
        global $SERVER;
        global $USERNAME;
        global $PASSWORD;
        global $DBNAME;
        global $DEBUG_MODE;
       
        
        $this->con = new cMysql($SERVER, $USERNAME, $PASSWORD, $DBNAME, $DEBUG_MODE);
    }
    
    
    
    function addHeader($title)
    {
        print("<!DOCTYPE HTML PUBLIC \'-//W3C//DTD HTML 4.01 Transitional//EN\' 'http://www.w3.org/TR/html4/strict.dtd'>\n");  
        print("<HTML>\n");
        print("<HEAD>\n");
        print("<META HTTP-EQUIV='Content-Type' CONTENT='text/html;charset=iso-8859-1'>\n");
        print("<LINK rel='stylesheet' type='text/css' href='../_generic/priv/_generic.css'>");
        print("<TITLE>$title</TITLE>\n");  
        print("<BODY>\n");
    }
    
    function addMenu($project)
    {
        $this->createCon();
        
        $this->con->qryWResults("select title from Forms where Project = \"$project\";");
        
        print("<div id='menu'>");
        for($Row = 0; $Row < $this->con->getNbRow();$Row++)
        {
           print("<a href='index.php?where=" . $this->con->getResult($Row,0) . "'>" . $this->con->getResult($Row,0) . "</a>\n");
           $this->addBR(1);
        }     
        print("</div>");
    }
    
    function addFieldset($text)
    {
        print("<div id='contenu'>");
        print("<fieldset>\n");
        print("<legend>$text</legend>\n");
    }
    function closeFieldset()
    {
        print("</fieldset>\n");
        print("</div>");
    }
    
    function addFooter()
    {
      
        print("</BODY>\n");  
        print("</HTML>\n");
    }
    
    function addH1($text)
    {
      
        print("<H1>$text</H1>\n");  
    }
    function addH2($text)
    {
       
        print("<H2>$text</H2>\n");  
    }
    function addH3($text)
    {
      
        print("<H3>$text</H3>\n");  
    }
    
    function addInputBox($labeled,$type,$sVar,$value,$table,$column,$Event)
    {
        
       global $DBNAME_PROJECT;
        
       switch($type)
      {
        case "hidden":
          print("<input type=\"$type\" name=\"$sVar\" value=\"$value\">\n");
          break;
      case "textarea":
          print("<label for name=\"$sVar\">$labeled: </label>\n");
          print("<textarea></textarea>\n");
          break;
        case "select":
          print("<label for name=\"$sVar\">$labeled: </label>\n");
          //print("<select $Event>\n");
          print("<select name=\"$sVar\">\n");
          $this->createCon(); 
          //print("select DISTINCT " . $column . " from " . $DBNAME_PROJECT . "." . $table . " order by " . $column . " asc;");
          $this->con->qryWResults("select DISTINCT " . $column . " from " . $DBNAME_PROJECT . "." . $table . " order by " . $column . " asc;");
          for($Row = 0; $Row < $this->con->getNbRow();$Row++)
          {
             print("<option value='" . $this->con->getResult($Row,0) . "'>" . $this->con->getResult($Row,0) . "</option>\n");
          }      
          print("</select>\n");
          
          break;
        
        case "text":
          
          print("<label for name=\"$sVar\">$labeled: </label>\n");
          print("<input type=\"$type\" name=\"$sVar\" value=\"$value\">\n");
          
          break; 
      }             
      $this->addVar();
    }
    
    function addSubmit($submitText)
    {
     
      $this->addSubmitBox($submitText);       
    }
    function addReset($resetText)
    {
     
      $this->addResetBox($resetText);       
    }
    
    function addFormHeader($nameForm,$action)
    {
    
      print("<form name='" . $nameForm . "' action='../_generic/_generic_treatement.php' method='POST' class='cssform'>\n");
      $this->addInputBox("","hidden","action",$action,"","","");      
    }
    function addFormFooter()
    {
    
      $this->addBR(2);
      $this->addReset("Reset");
      $this->addSubmit("Ajouter");      
      print("</form>\n");       
    }                 
        
    function addSubmitBox($submitText)
    {  
     
      print("<input type=\"submit\" value=\"$submitText\">\n");
    }
    
    function addResetBox($resetText)
    {  
     
      print("<input type=\"reset\" value=\"$resetText\">\n");
    }
    
    function addBR($occ)
    {  
   
      for($i = 0; $i < $occ; $i++) print("<br>\n");
    }
    
    function addVar()
    {
        $this->numOfVar++;
    }
    
    function getNbVar()
    {
        return $this->numOfVar;
    }
    
    function addP($text)
    {
        print("<p>" . $text . "</p>\n");
        $this->addBR(1);
    }
  }
?>