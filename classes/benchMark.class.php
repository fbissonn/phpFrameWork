<?
/**
 * File:   benchMark.class.php
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
class BenchMark 
{ 
    private $total; 
    private $time;

    public function __construct() 
    { 
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs");
        $this->total = $this->time = microtime(true);
    } 
    
    public function clock() 
    {
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs");
        $this->formatDebug(-$this->time + ($this->time = microtime(true)));
        
    } 
    
    public function elapsed() 
    { 
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs");
        $this->formatDebug(microtime(true) - $this->total);
    } 
    
    public function reset() 
    {
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
        set_error_handler("GestionErreurs"); 
        $this->total=$this->time=microtime(true); 
    } 
    
    private function formatDebug($elapsed)
    { 
      require_once(getenv('DOCUMENT_ROOT'). "/_generic/classes/Errorhandler/errorhandler.php");
      set_error_handler("GestionErreurs");
      print("<table>\n");
      print("<tr><th>Temps pris pour charger la page</th></tr>");
      print("<tr><td class='optimisePage'>". $elapsed ." s</td></tr>");
      print("</table>");
      
    }
} 
?>