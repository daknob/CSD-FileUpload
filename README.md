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
git clone https://github.com/DaKnOb/CSD-FileUpload.git FileUpload
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
printf "PASSWORD_GOES_HERE" | sha256sum | cut -d" " -f1 > password.txt
```
After that, you can copy the password and replace the contents of the
```$PASSWORD``` variable with the output of this script. Only include 
the first You will not be able to login without performing this step.

<h4>Password Reset - iForgot</h4>
In the unfortunate event of losing your password, please follow the
instructions at §Password Generation in order to reset it. Currently
you will not be asked about your first pet's name or a recovery e-mail.

<h2>Uploading Files</h2>
In order to upload files, after following the §Installation instructions, simply
navigate with any browser to `https://www.csd.uoc.gr/~YourUserName/FileUpload` and
then select a file from your computer to upload. After that, enter your password,
and then press `Enter` or `Return`. If you entered the correct password and the
upload succeeded, you will find the file in `~/public_html/STORAGE`. 

<h3>Uploading multiple files</h3>
In order to upload multiple files, the current solution is to create a `.zip`
archive with all the files inside. Make sure it is `.zip` and not `.rar`.
After that, locate the file using `ssh` to a computer and run:
```
unzip file_name
```
to extract all its contents in the current folder.

<h3>Uploading a directory</h3>
Due to browser limitations, selecting an entire directory to upload is not
possible without using cutting edge features or breaking compatibility with
all browsers. Therefore, you are encouraged to follow the instructions in the
§Uploading multiple files section.
