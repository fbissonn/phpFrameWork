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

namespace APP_GLOBAL\WEB\WEBFORM\CHART;

class cChart
{

    private $nbCol;
    private $nbRow;
    private $chartArray;
    private $colTitle;
    private $rowTitle;
    private $title;

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        $this->nbCol = 0;
        $this->nbRow = 0;
        $this->chartArray = array();
    }

    function __construct($title, $chartValue=array())
    {
        $this->init();
        $this->title = $title;

        foreach ($chartValue as $i => $rowValue)
        {
            $this->nbRow++;
           
            if(isset($rowValue))
            {
                foreach ($rowValue as $j => $colValue)
                {
                    array_push(&$this->chartArray[$i], $colValue);
                }
            }
            else
            {
                array_push(&$this->chartArray, $rowValue);
            }
        }
    }

}

?>
