
<?php
error_reporting(1);

//mysql_connect("localhost", "root", "") or die("cannot connect");

//mysql_select_db("demo") or die("ERROR:could not connect to the database!!!");

$csvfile = $_FILES['csvfile']['name'];

$ext = pathinfo($csvfile, PATHINFO_EXTENSION);

$base_name = pathinfo($csvfile, PATHINFO_BASENAME);

if (isset($_POST['submit'])) {

    if (!$_FILES['csvfile']['name'] == "") {

        if ($ext == "csv") {

            if (file_exists($base_name)) {
                echo "file already exist" . $base_name;

            } else {

                if (is_uploaded_file($_FILES['csvfile']['tmp_name'])) {

                    echo "<h1>" . "File " . $_FILES['filename']['name'] . " uploaded successfully." . "</h1>";

                    readfile($_FILES['csvfile']['tmp_name']);
                }
                $handle = fopen($_FILES['csvfile']['tmp_name'], "r");

                while (($data = fgetcsv($handle, 1000, ",")) !== false) {

//                     $import = "INSERT INTO users_csv(name,dob,gender,mobileno,email,picture)
                    // VALUES('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";

                    echo $data[1];

                    // mysql_query($import) or die(mysql_error());

                }

                fclose($handle);
                echo "Import done";
            }

        } else {

            echo " Check Extension. your extension is ." . $ext;

        }

    } else {
        echo "Please Upload File";
    }
}

?>

<form method="post" enctype="multipart/form-data">

<table>

<tr>

<td>Upload CSV File Here:-  </td><td><input type="file" value="Upload CSV Format" name="csvfile" />

<input type="submit" value="Upload" name="submit" /></td>

</tr>

</table>

</form>
