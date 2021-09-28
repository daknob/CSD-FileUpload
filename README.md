FileUpload is a small web application that allows students of the [Computer
Science Department](https://www.csd.uoc.gr/) at the [University Of
Crete](http://www.uoc.gr/) to upload files to their personal accounts on the
Debian computers without having to go through all the hassle required. It is
easy to install and allows you to upload files from a web browser. All uploads
happen only after the user password is verified to prevent unauthorized file
hosting and are not accessible publicly.

## Installation

Login to a Debian computer as usual and then run:

```
cd ~/public_html
git clone https://github.com/DaKnOb/CSD-FileUpload.git FileUpload
```

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

There is another installation method for this software. This method is
recommended only if you do not feel comfortable performing the steps
above or you tried and you failed. This method may be a single
command, but it could have some security implications. 

Login to a Debian Computer and run:

```
curl https://raw.githubusercontent.com/DaKnOb/CSD-FileUpload/master/bashpipe | bash
```

If this command presents any errors or warnings please press `Ctrl` + `C`
immediately and log out (type `exit`) from this computer.

Please note that in order to login to the service you need to
have set a password. Learn how to do this below.

## Password Generation

In order to generate a password for the file uploading, run the following
command in a CSD Computer:

```
cd ~/public_html/FileUpload;
./set-password YOUR_NEW_PASSWORD
```

### Password Reset - iForgot

In the unfortunate event of losing your password, please follow the
instructions at §Password Generation in order to reset it. Currently
you will not be asked about your first pet's name or a recovery e-mail.

## Uploading Files

In order to upload files, after following the §Installation instructions,
simply navigate with any browser to
`https://www.csd.uoc.gr/~YourUserName/FileUpload` and then select a file from
your computer to upload. After that, enter your password, and then press
`Enter` or `Return`. If you entered the correct password and the upload
succeeded, you will find the file in `~/public_html/STORAGE`.

### Uploading multiple files

In order to upload multiple files, the current solution is to create a `.zip`
archive with all the files inside. Make sure it is `.zip` and not `.rar`.
After that, locate the file using `ssh` to a computer and run:

```
unzip file_name
```
to extract all its contents in the current folder.

### Uploading a directory

Due to browser limitations, selecting an entire directory to upload is not
possible without using cutting edge features or breaking compatibility with
all browsers. Therefore, you are encouraged to follow the instructions in the
§Uploading multiple files section.

## Updating the Software

In order to update the software to a more recent version, run:

```
~/public_html/FileUpload/update-program
```
