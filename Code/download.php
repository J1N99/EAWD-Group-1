<!-- HTML form with a download button -->
<!DOCTYPE html>
<html>
<head>
<title>Download Page</title>
</head>
<body>

<form method="post">
    <button type="submit" name="download_btn">Download CSV</button>
    <button type="submit" name="download_zip">Download ZIP</button>
</form>

</body>
</html>

<?php
function download_csv() {
    // Connect to the database
    $conn = mysqli_connect('localhost:3307', 'root', '', 'feedbackdb');

    // Check for connection errors
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define the query to retrieve the data from the table
    $sql = "SELECT idea_id, document_url, closeDate FROM idea";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Set headers for the CSV file
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=file.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    ob_end_clean();
    // Open a file pointer for output
    $fp = fopen('php://output', 'w');

    // Write the column headers to the file pointer as CSV
    $headers = array("idea_id", "document_url", "closeDate");
    fputcsv($fp, $headers);

    // Write the data to the file pointer as CSV
    while ($row = mysqli_fetch_assoc($result)) {
        $data = array($row['idea_id'], $row['document_url'], $row['closeDate']);
        fputcsv($fp, $data);
    }

    // Close the file pointer
    fclose($fp);

    // Download the file
    //readfile('file.csv');

    // Close the database connection
    mysqli_close($conn);
}

// Check if the download button was clicked
if (isset($_POST['download_btn'])) {
    // Call the download_csv() function to generate and download the CSV file
    download_csv();
}


function download_zip(){
    // Define the folder to be zipped and the output ZIP file name
$folder_path = 'uploads/';
$zip_name = 'files.zip';

// Create a new ZIP archive
$zip = new ZipArchive();

// Open the archive for writing
if ($zip->open($zip_name, ZipArchive::CREATE) !== TRUE) {
    die("Unable to create ZIP archive");
}

// Create a recursive directory iterator to loop through all files and directories inside the folder
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder_path));

// Loop through the files and add them to the ZIP archive
foreach ($iterator as $file) {
    // Check if the file is a directory
    if ($file->isDir()) {
        continue;
    }

    // Get the file path and name relative to the folder path
    $file_pathname = $file->getPathname();
    $file_relative_path = substr($file_pathname, strlen($folder_path));

    // Add the file to the ZIP archive using the relative path as the file name
    $zip->addFile($file_pathname, $file_relative_path);
}

// Close the ZIP archive
$zip->close();

// Download the ZIP archive
header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=$zip_name");
header("Pragma: no-cache");
header("Expires: 0");
readfile($zip_name);

// Delete the ZIP archive
unlink($zip_name);
}

if (isset($_POST['download_zip'])) {
    // Call the download_csv() function to generate and download the CSV file
    download_zip();
}
?>