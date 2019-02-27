<?php


function upload_file($files_array,$allawed_array,$allawoed_size,$path)

{

    $report = array();

    $name = $files_array['name'];

    $tmp_name = $files_array['tmp_name'];

    $type = $files_array['type'];

    $size = $files_array['size'];

    $error = $files_array['error'];

    $ex = explode('.',$name);

    $extention = end($ex);



    if($error != 0)

    {

        $report['server_error'] = 'true';

        $report['uploade'] = 'false';

        return $report;

    }

    else

    {



        if(!in_array($extention,$allawed_array))

        {

            $report['server_error'] = 'false';

            $report['type_error'] = 'truedf'.$name;

            $report['uploade'] = 'false';

            return $report;

        }

        else

        {

            if($size/1000 > $allawoed_size)

            {

                $report['server_error'] = 'false';

                $report['type_error'] = 'false';

                $report['size_error'] = 'true';

                $report['uploade'] = 'false';

                return $report;

            }

            else

            {

                $file_name = rand().'.'.$extention;

                $file_path = 'http://wp-elshimy.000webhostapp.com/src/img/'.$path.'/'.$file_name;

                if(move_uploaded_file($tmp_name,$file_path))

                {

                    $report['server_error'] = 'false';

                    $report['type_error'] = 'false';

                    $report['size_error'] = 'false';

                    $report['uploade'] = 'true';

                    $report['path'] = 'http://wp-elshimy.000webhostapp.com/src/img/'.$path.'/'.$file_name;

                    return $report;

                }

                else

                {

                    $report['uploade'] = 'false'.$file_path;

                    $report['finle_error'] = 'true'.$tmp_name;

                    return $report;

                }

            }

        }

    }

}





function upload_driver($file,$path)

{

    $dir = __dir__;

    $report = array();

    $image = $file;

    $image = str_replace('data:image/jpeg;base64,','',$image);

    $image = str_replace('data:image/jpg;base64,','',$image);

    $image = str_replace(' ','+',$image);

    $image = base64_decode($image);

    $image_name = rand().time().'.jpg';

    if(file_put_contents($dir.'/../img/'.$path.'/'.$image_name,$image))

    {

        $report['uploade'] = 'true';

        $report['path'] = 'http://wp-elshimy.000webhostapp.com/src/img/'.$path.'/'.$image_name;

    }

    else

    {

        $report['uploade'] = 'false';

    }

    return $report;



}