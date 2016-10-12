## Kirby Instagram Plugin

Kirbygram is now deprecated.
With Instagrams June 1st API updates the application cannot be approved under the terms and conditions so will no longer function.
I'm extremely sorry for any incovenience but there is no recourse for me to have the application re-instated.

## Temporary solution

If you have an existing Kirbygram installation, here's what you have to do:

1. Make sure you log out of all Instagram accounts - if you are logged on with your own account or someone else's, you will have problems.
2. Go to http://instagram.pixelunion.net/, click on the big button and login with the credentials for the Instagram account you wish to access. Pixel Union will generate a new authorisation token for you. Copy the token.
3. Open the kirbygram/config.json file, and change (paste) the value of the 'token' to the value you just copied.
4. Now copy the first 10 characters of the token - they are the characters before the "." (full stop). This is the User ID: paste it into 'uid'. Save the config.json file.
5. Last of all, empty the Kirbygram cache: delete the kirbygram/cache folder, and empty your browser's cache.

*Source: luxlogica*
*Link to thread: https://forum.getkirby.com/t/making-kirbygram-work-with-the-instagram-api-changes/4293/12*
