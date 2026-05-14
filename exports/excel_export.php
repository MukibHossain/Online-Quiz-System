<?php

header(
"Content-type: application/vnd-ms-excel"
);

header(
"Content-Disposition: attachment; filename=report.xls"
);

echo "

Name\tScore

Admin\t95

Student\t85

";
?>