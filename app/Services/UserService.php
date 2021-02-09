<?php
namespace App\Services;

class UserService
{
    /**
     * Delete the profile old image and upload the new one & return the new image name.
     *
     * @param object $image
     * @param object $user
     * @return string
     */
    public function handle_profile_image_in_server($image, $user)
    {
        $user_image = $user->user_image;
        if($user_image) image_remove(public_path("/assets/users/".$user_image));

        $file_name = image_upload(
            $user->username,
            $image->getClientOriginalExtension(),
            public_path("assets\users\\"),
            $image->getRealPath()
        );
        return $file_name;
    }
}
