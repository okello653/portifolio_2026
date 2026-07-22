<?php 
// function to upload image files
function share_file($name, $destination, $resize = false, $height = 0, $width = 0) {
    // global $wallet, $sqlConnect;
    $ext = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    $filename = md5(time() . $_FILES[$name]['name']) . '.' . $ext;
    $file = $_FILES[$name]['tmp_name'];
    $allowedTypes = array('image/bmp', 'image/jpeg', 'image/x-png', 'image/png', 'image/gif');

    // Get the file type to determine if it's an image or a document
    $fileType = $_FILES[$name]['type'];

    // Check if the uploaded file is an image
    if (in_array($fileType, $allowedTypes)) {
        // Image processing (resize if requested)
        if ($resize) {
            $source_properties = getimagesize($file);
            if ($source_properties === false) {
                return 'Error: Invalid image file'; // Return error if the file is not a valid image
            }

            $image_type = $source_properties[2];
            if ($image_type == IMAGETYPE_JPEG) {
                $image_resource_id = imagecreatefromjpeg($file);
            } elseif ($image_type == IMAGETYPE_GIF) {
                $image_resource_id = imagecreatefromgif($file);
            } elseif ($image_type == IMAGETYPE_PNG) {
                $image_resource_id = imagecreatefrompng($file);
            } else {
                return 'Error: Unsupported image type'; // Handle unsupported image types
            }

            // Ensure image resource was created successfully
            if ($image_resource_id === false) {
                return 'Error: Unable to create image resource';
            }

            $target_layer = imagecreatetruecolor($width, $height);
            imagecopyresampled($target_layer, $image_resource_id, 0, 0, 0, 0, $width, $height, $source_properties[0], $source_properties[1]);
            imagejpeg($target_layer, $destination . $filename);
            return $destination . $filename;
        } else {
            // If resizing is not requested, just move the uploaded file
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $destination . $filename)) {
                return $destination . $filename;
            }
        }
    } else {
        // If the file is not an image (i.e., it's a document), skip the image processing
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $destination . $filename)) {
            return $destination . $filename;
        } else {
            return 'Error: File upload failed';
        }
    }

    return ''; // Return empty if all else fails
}
?>