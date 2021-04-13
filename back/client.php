<?php

class client extends Command
        {

        function doExecute(ControllerRequest $request)
                {
                readfile('.'.DIRECTORY_SEPARATOR.'front'.DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'start.html');
                }
        }

?>