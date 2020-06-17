<?php namespace App\Controllers;


class ReadFiles extends BaseController
{
	public function showFiles($folder, $images)
	{
	  if( !empty( $images ) )
	    {

					$filename = basename($images);
					$file_extension = strtolower(substr(strrchr($filename,"."),1));

					switch( $file_extension ) {
					    case "gif": $ctype="image/gif"; break;
					    case "png": $ctype="image/png"; break;
					    case "jpeg":
					    case "jpg": $ctype="image/jpeg"; break;
					    case "svg": $ctype="image/svg+xml"; break;
					    default:
					}

					//wybierz folder w jakim znajduje sie obrazek
					if($folder == 1){
						$subfolder = 'images/avatar/';
					}

	        $file = '/home/intranet/'.$subfolder.''.$images;

					// $file .= $subfolder;
					// $file .= $images;

	        if( file_exists( $file ) )
	        {
							header('Content-Type:' . $ctype);
							header('Pragma: private');
							readfile($file);
							exit;

	        }else{
						echo 'Nie można wyświetlić pliku.';
	        }
	    }
	}



	//--------------------------------------------------------------------

}
