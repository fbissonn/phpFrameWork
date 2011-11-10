-------------------------------------------------------------------------------
 -- File:   ADD_INPUT_BOX.sql
 -- Author: Francois Bissonnette <fbissonn@gmail.com>
 -- 
 -- Created on 2011-11-05, 09:31:47
 -- 
 -- Copyright (c) <2011>, <Francois Bissonnette <fbissonn@gmail.com>>
 -- 
 -- All rights reserved.
 -- 
 -- Redistribution and use in source and binary forms, with or without
 -- modification, are permitted provided that the following conditions are met:
 --  -- Redistributions of source code must retain the above copyright
 --    notice, this list of conditions and the following disclaimer.
 --  -- Redistributions in binary form must reproduce the above copyright
 --    notice, this list of conditions and the following disclaimer in the
 --    documentation and/or other materials provided with the distribution.
 --  -- Neither the name of the Francois bissonnette nor the
 --    names of its contributors may be used to endorse or promote products
 --    derived from this software without specific prior written permission.
 -- 
 -- THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 -- ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 -- WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 -- DISCLAIMED. IN NO EVENT SHALL FRANCOIS BISSONNETTE BE LIABLE FOR ANY
 -- DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 -- (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 -- LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 -- 
 -- ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 -- (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 -- SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 -------------------------------------------------------------------------------

DELIMITER $$

CREATE DEFINER=`francois`@`%` PROCEDURE `ADD_AN_INPUTBOX`(IN PROJECTNAME varchar(45),IN INPUTTYPE varchar(45),IN LABELNAME varchar(45),IN VARNAME varchar(45),IN WHICHPAGE2 varchar(45))
BEGIN

    declare idformID  int default 0;
    declare varnameID  int default 0;
    declare orderMax  int default 0;
    declare iWHICHPAGE varchar(45);   

    if WHICHPAGE2 <> "" and LABELNAME <> "" and VARNAME <> "" then

        SELECT  max(inputboxes.order)
        FROM    inputboxes, formInputBox, Forms 
        where   Forms.idForms = formInputBox.idFormInputBox and 
                formInputBox.inputboxes = inputboxes.idinputboxes and
                Forms.Project = PROJECTNAME and 
                Forms.title = WHICHPAGE2
                order by inputboxes.order
                into orderMax;
        
        if orderMax > 0 then
            set orderMax = orderMax + 1;
        else
            set orderMax = 0;
        end if;

        select idForms  from mydb.Forms where mydb.Forms.title = WHICHPAGE2 and mydb.Forms.Project = PROJECTNAME into idformID;

        set iWHICHPAGE = WHICHPAGE2;

        if idformID > 0 then

                select count(sVarName)  
                from inputboxes, Forms, formInputBox 
                where sVarName  = VARNAME and 
                title = WHICHPAGE2 and 
                mydb.Forms.Project = PROJECTNAME and
                formInputBox.idformInputBox = Forms.idForms and
                formInputBox.inputboxes = inputboxes.idinputboxes
                into varnameID;
            
            if varnameID = 0 then
                insert into mydb.inputboxes (sName,sType,sVarName,inputboxes.order) VALUES (LABELNAME,INPUTTYPE,VARNAME,orderMax);
                select  max(idinputBoxes) from inputboxes, Forms  where sVarName  = VARNAME and title = iWHICHPAGE  into varnameID;
                insert into mydb.formInputBox (idformInputBox,inputboxes) VALUES (idformID,varnameID);
            else
                select "La variable demandé est déja existante pour la page";
            end if;
        else
            insert into mydb.Forms (title, Project) VALUES (iWHICHPAGE,PROJECTNAME );
            select idForms  from mydb.Forms where mydb.Forms.title = iWHICHPAGE into idformID;
            insert into mydb.inputboxes (sName,sType,sVarName,inputboxes.order) VALUES (LABELNAME,INPUTTYPE,VARNAME,orderMax);
            select  max(idinputBoxes) from inputboxes, Forms  where sVarName  = VARNAME and title = iWHICHPAGE into varnameID;
            insert into mydb.formInputBox (idformInputBox,inputboxes) VALUES (idformID,varnameID);
        end if;
    end if;

END

