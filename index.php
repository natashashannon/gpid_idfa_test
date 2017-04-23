<?php

$filename = "tpr_inactive_maids.txt";
$gpid_current = 1;
$idfa_current = 1;
$gpid_file = "gpid$gpid_current.csv";
$idfa_file = "idfa$idfa_current.csv";
$gpid_total_length = 0;
$idfa_total_length = 0;

$handle = fopen("$filename", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if (preg_match("/^([a-z0-9-]{36})$/", $line, $matches)) {
            $gpid_total_length = $gpid_total_length + 74;

            if (file_exists($gpid_file) !== true) {
                $gpid_handle = fopen($gpid_file, "a");
                fputcsv($gpid_handle, array("propertyId", "o1", "um5", "gpId", "ida", "idv"));
            }

            if ($gpid_total_length > 10000000) {
                $gpid_current = $gpid_current + 1;
                $gpid_file = "gpid$gpid_current.csv";
                $gpid_handle = fopen($gpid_file, "a");
                fputcsv($gpid_handle, array("propertyId", "o1", "um5", "gpId", "ida", "idv"));
                $gpid_total_length = 0;

            }

            $gpid_handle = fopen($gpid_file, "a");
            $data = array("59188fbcceb9464989aec3f03d5f29f2", "", "", "$matches[1]", "", "");

            fputcsv($gpid_handle, $data);
            fclose($gpid_handle);

        }

        if (preg_match("/^([A-Z0-9-]{36})$/", $line, $matches)) {
            $idfa_total_length = $idfa_total_length + 74;

            if (file_exists($idfa_file) === false) {
                $idfa_handle = fopen($idfa_file, "a");
                fputcsv($idfa_handle, array("propertyId", "o1", "um5", "gpId", "ida", "idv"));
            }

            if ($idfa_total_length > 10000000) {
                $idfa_current = $idfa_current + 1;
                $idfa_file = "idfa$idfa_current.csv";
                $idfa_handle = fopen($idfa_file, "a");
                fputcsv($idfa_handle, array("propertyId", "o1", "um5", "gpId", "ida", "idv"));
                $idfa_total_length = 0;

            }

            $idfa_handle = fopen($idfa_file, "a");
            $data = array("b8c093a2cd8f4bc4938796115ef40c09", "", "", "", "$matches[1]", "");

            fputcsv($idfa_handle, $data);
            fclose($idfa_handle);
        }
    }

    fclose($handle);
}
?>