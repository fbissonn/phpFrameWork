<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * File:   %<%NAME%>%.%<%EXTENSION%>%
 * Author: Francois Bissonnette
 * 
 * Created on %<%DATE%>%, %<%TIME%>%
 * 
 * Copyright (c) <2011>, <Francois Bissonnette (fbissonn@gmail.com)>
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
include(getenv('DOCUMENT_ROOT'). "/_generic/includeOnce.inc.php");

class errorHandler
{
    private $dt = date("Y-m-d H:i:s (T)");

    private $errortype = array (
                E_ERROR              => 'Erreur',
                E_WARNING            => 'Alerte',
                E_PARSE              => 'Erreur d\'analyse',
                E_NOTICE             => 'Note',
                E_CORE_ERROR         => 'Core Error',
                E_CORE_WARNING       => 'Core Warning',
                E_COMPILE_ERROR      => 'Compile Error',
                E_COMPILE_WARNING    => 'Compile Warning',
                E_USER_ERROR         => 'Erreur spécifique',
                E_USER_WARNING       => 'Alerte spécifique',
                E_USER_NOTICE        => 'Note spécifique',
                E_STRICT             => 'Runtime Notice',
                E_RECOVERABLE_ERROR => 'Catchable Fatal Error'
                );
    
    private $err = "";
    
    function userErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
    {
        // Date et heure de l'erreur

        // Les niveaux qui seront enregistrés
        $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

        $err = "<errorentry>\n";
        $err .= "\t<datetime>" . $dt . "</datetime>\n";
        $err .= "\t<errornum>" . $errno . "</errornum>\n";
        $err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
        $err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
        $err .= "\t<scriptname>" . $filename . "</scriptname>\n";
        $err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";

        if (in_array($errno, $user_errors)) {
            $err .= "\t<vartrace>".wddx_serialize_value($vars,"Variables")."</vartrace>\n";
        }
        $err .= "</errorentry>\n\n";
    }
}

?>
