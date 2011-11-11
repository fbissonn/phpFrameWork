<?PHP
/**
 * File:   cMysql.class.php
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
class cMysql
{

    private $con;
    private $tab = array();
    private $result;
    private $nbCol = 0;
    private $nbRow = 0;
    private $state = false;
    private $is_debug;

    function __construct($SERVER, $USERNAME, $PASSWORD, $DBNAME, $DEBUGMODE)
    {
        require_once(getenv('DOCUMENT_ROOT') . "/_generic/includeOnce.inc.php");
        require_once(getenv('DOCUMENT_ROOT'). "/_generic/Tools/errorhandler.php");
        set_error_handler("GestionErreurs");

        $this->con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DBNAME) or die(debug_mysqli(__LINE__, __FILE__, mysqli_connect_error()));

        if($DEBUGMODE) $this->is_debug = 1;

        /* V�rification de la connexion */
        if (mysqli_connect_errno())
        {
            printf("Echec de la connexion : %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function qryWResults($sQry)
    {
           require_once(getenv('DOCUMENT_ROOT'). "/_generic/Tools/errorhandler.php");
        set_error_handler("GestionErreurs");
        $j = 0;

        $result = $this->con->query($sQry) or die(debug_mysqli(__LINE__, __FILE__, $this->con->error));
         if($this->is_debug)
          {
          print("<br><br><br>field Count: $result->field_count\n<br>");
          print("num_rows: $result->num_rows\n<br>");
          print("request: $sQry\n<br>");

          } 

        $this->setNbCol($result->field_count);
        $this->setNbRow($result->num_rows);

        while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            for ($i = 0; $i < $this->getNbCol(); $i++)
            {
                $this->tab[$j][$i] = $row[$i];
            }
            $j++;
        }



        if ($j > 0)
            $state = true;

        $result->close();
    }

    public function getState()
    {

        return $state;
    }
    
    public function printResults()
    {
       for($row = 0; $row < $this->nbRow; $row++)
       {
           for($col = 0; $col < $this->nbCol; $col++)
           {
               if($this->getResult($row, $col) == null)
               {
                   cHTML::addP("NULL");
               }
               else
               {
                  cHTML::addP($this->getResult($row, $col)); 
               }
               
               
           }
           
       }
       
       
        
    }

    public function qryWNoResult($sQry)
    {

        $this->con->query($sQry) or die(debug_mysqli(__LINE__, __FILE__, $this->con->error));
    }

    public function getResult($row, $col)
    {
        return $this->tab[$row][$col];
    }

    public function getAllResult()
    {

        return $this->tab;
    }

    private function setNbCol($nbCol)
    {

        $this->nbCol = $nbCol;
    }

    public function getNbCol()
    {

        return $this->nbCol;
    }

    private function setNbRow($nbRow)
    {

        $this->nbRow = $nbRow;
    }

    public function getNbRow()
    {

        return $this->nbRow;
    }

    function __destruct()
    {

        $this->con->close() or die(debug_mysqli(__LINE__, __FILE__, $this->con->error));
    }

}

?>
