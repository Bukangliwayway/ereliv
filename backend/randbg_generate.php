<?php
  $folder_path = "assets/randbg/"; 
  $files = glob($folder_path . "*");
  $img_src = $files[array_rand($files)];
  