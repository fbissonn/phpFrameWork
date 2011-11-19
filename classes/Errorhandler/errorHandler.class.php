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

namespace APP_GLOBAL\handlingError;
  
class errorHandler
{

    private $dt;
    private $errortype;
    private $err;

    static function GestionErreurs($niveau_erreur, $message, $script, $no_ligne, $contexte=array())
    {
        global $site_name, $webmaster, $php_active_error, $php_active_mail, $php_mail, $php_active_display;

        if ($php_active_error)
        { // Si la fonction debug PHP est activ�e !  
            switch ($niveau_erreur)
            {  // Je regarde quel est le niveau de l'erreur
                //Les erreur suivantes ne doivent en aucun cas �tre transmises ici !
                case E_ERROR:
                case E_PARSE:
                case E_CORE_ERROR:
                case E_CORE_WARNING:
                case E_COMPILE_ERROR:
                case E_COMPILE_WARNING:
                    echo'Ca ne doit jamais arriver !!!';
                    exit;
                // Autres erreurs  
                case E_WARNING:
                    $typeErreur = 'Avertisement PHP';
                    break;
                case E_NOTICE:
                    $typeErreur = 'Remarque PHP';
                    break;
                case E_STRICT:
                    $typeErreur = 'Syntaxte obsol�te PHP 5';
                    break;
                case E_USER_ERROR:
                    $typeErreur = 'Avertissement de l\'application';
                    break;
                case E_USER_WARNING:
                    $typeErreur = 'Avertissement de l\'application';
                    break;
                case E_NOTICE:
                    $typeErreur = 'Remarque PHP';
                    break;
                default:
                    $typeErreur = 'Erreur inconnue';
            }
            $debug = "<table>";
            $debug .= "<tr><th class=errorPHPstyle>" . $site_name . "</th><th class=errorPHPstyle>Erreur PHP</th></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>Ligne</td><td class=errorPHPstyle>" . $no_ligne . "</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>Fichier</td><td class=errorPHPstyle>" . $script . "</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>Erreur</td><td class=errorPHPstyle>" . $message . "</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>ServerName</td><td class=errorPHPstyle>" . $_SERVER['SERVER_NAME'] . "</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>Version de PHP</td><td class=errorPHPstyle>" . phpversion() . "</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_USER_AGENT</td><td class=errorPHPstyle>" . getenv('HTTP_USER_AGENT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>AUTH_TYPE</td><td class=errorPHPstyle>" . getenv('AUTH_TYPE') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>COMSPEC</td><td class=errorPHPstyle>" . getenv('COMSPEC') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>CONTENT_TYPE</td><td class=errorPHPstyle>" . getenv('CONTENT_TYPE') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>DOCUMENT_ROOT/td><td class=errorPHPstyle>" . getenv('DOCUMENT_ROOT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>DOCUMENT_URI</td><td class=errorPHPstyle>" . getenv('DOCUMENT_URI') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_ACCEPT</td><td class=errorPHPstyle>" . getenv('HTTP_ACCEPT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>AUTH_TYPE</td><td class=errorPHPstyle>" . getenv('AUTH_TYPE') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_ACCEPT_ENCODING</td><td class=errorPHPstyle>" . getenv('HTTP_ACCEPT_ENCODING') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_ACCEPT_LANGUAGE</td><td class=errorPHPstyle>" . getenv('HTTP_ACCEPT_LANGUAGE') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_CONNECTION</td><td class=errorPHPstyle>" . getenv('HTTP_CONNECTION') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_HOST</td><td class=errorPHPstyle>" . getenv('HTTP_HOST') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_REFERER</td><td class=errorPHPstyle>" . getenv('HTTP_REFERER') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>LAST_MODIFIED</td><td class=errorPHPstyle>" . getenv('LAST_MODIFIED') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>PATH</td><td class=errorPHPstyle>" . getenv('PATH') . " </td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>PATH_INFO</td><td class=errorPHPstyle>" . getenv('PATH_INFO') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>PHP_SELF</td><td class=errorPHPstyle>" . getenv('PHP_SELF') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>REDIRECT_STATUS</td><td class=errorPHPstyle>" . getenv('REDIRECT_STATUS') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>REDIRECT_URL</td><td class=errorPHPstyle>" . getenv('REDIRECT_URL') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>QUERY_STRING</td><td class=errorPHPstyle>" . getenv('QUERY_STRING') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>REMOTE_ADDR</td><td class=errorPHPstyle>" . getenv('REMOTE_ADDR') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>REMOTE_PORT</td><td class=errorPHPstyle>" . getenv('REMOTE_PORT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SCRIPT_FILENAME</td><td class=errorPHPstyle>" . getenv('SCRIPT_FILENAME') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SCRIPT_NAME</td><td class=errorPHPstyle>" . getenv('SCRIPT_NAME') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>DATE_GMT</td><td class=errorPHPstyle>" . getenv('DATE_GMT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>DATE_LOCAL</td><td class=errorPHPstyle>" . getenv('DATE_LOCAL') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>DOCUMENT_ROOT</td><td class=errorPHPstyle>" . getenv('DOCUMENT_ROOT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>GATEWAY_INTERFACE</td><td class=errorPHPstyle>" . getenv('GATEWAY_INTERFACE') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>HTTP_HOST</td><td class=errorPHPstyle>" . getenv('HTTP_HOST') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_ADDR</td><td class=errorPHPstyle>" . getenv('SERVER_ADDR') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_ADMIN</td><td class=errorPHPstyle>" . getenv('SERVER_ADMIN') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_NAME</td><td class=errorPHPstyle>" . getenv('SERVER_NAME') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_PORT</td><td class=errorPHPstyle>" . getenv('SERVER_PORT') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_PROTOCOL</td><td class=errorPHPstyle>" . getenv('SERVER_PROTOCOL') . ".</td></tr>\n";
            $debug .= "<tr><td class=errorPHPstyle>SERVER_SOFTWARE</td><td class=errorPHPstyle>" . getenv('SERVER_SOFTWARE') . "<./td></tr>\n";
            $debug .= "</table>";

            if ($php_active_mail)
            { // si l'envoi de mail est activ�, mail contenant l'erreur au format html
                $debug .='<br><font color=grey>Un mail a �t� envoy� � l\'administrateur pour corriger ce bug, il sera r�par� dans les plus brefs d�lais.</font>';
                $to = $php_mail;
                $sujet = $site_name . 'Erreur rencontr�e lors de l\'ex�cution de ' . $script; // Sujet du message          
                $from = "From: $to \r\n";
                $from .="Content-Type: text/html; charset=us-ascii\r\n"; // D�finition du format html          
                //mail($to,$sujet,$debug,$from); // la fonction mail 
            }

            $debug .='<br><font color=grey>Merci de nous excusez pour le d�rangement encouru.<br>' . $webmaster . '</font><br>';

            if ($php_active_display)
            { // si l'affichage est activ�
                echo $debug . '<br><br>';
            }



            // Erreur utilisateur ? Je stoppe !
            if ($niveau_erreur == E_USER_ERROR)
                exit;

            return false;
        }
    }
}

?>
