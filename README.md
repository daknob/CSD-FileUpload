FileUpload is a small web application that allows students of the
[Computer Science Department](https://www.csd.uoc.gr/) at the [University Of Crete](http://www.uoc.gr/) to upload
files to their personal accounts on the Debian computers without
having to go through all the hassle required. It is easy to install
and allows you to upload files from a web browser. All uploads
happen only after the user password is verified to prevent unauthorized
file hosting and are not accessible publicly. 

<h2>Installation</h2>
Login to a Debian computer as usual and then run:
```
cd public_html
git clone https://github.com/DaKnOb/CSD-FileUpload.git
mv CSD-FileUpload FileUpload
```
<br>
Now test if all you can access the web application at:
```
https://www.csd.uoc.gr/~yourUsername/FileUpload
```
If you don't seem to be able to do so, run:
```
cd ~/public_html
mkdir html
mkdir tmp
chmod 755 html
chmod 755 tmp
```
<br>



Now edit the ```index.php``` script inside the ```~/public_html/FileUpload``` folder
and change the ```$PASSWORD``` variable to the SHA-256 hash of your
desired password. For more instructions on how to generate this, please
see §Password Generation below. You may optionally also edit the ```$WEBSITE```
variable to redirect bad requests to this website.

Please note that in order to login to the service you need to
have set a password. Learn how to do this below.

<h2>Password Generation</h2>
In order to generate a password for the file uploading, run the following
command in a CSD Computer:
```
printf "PASSWORD_GOES_HERE" | sha256sum | cut -d" " -f1
```
After that, you can copy the password and replace the contents of the
```$PASSWORD``` variable with the output of this script. Only include 
the first You will not be able to login without performing this step.
