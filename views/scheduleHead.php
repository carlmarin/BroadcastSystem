<html>
  <head>
 <!--Jtable-->
    <link rel="stylesheet" type="text/css" href="../jtable/themes/redmond/jquery-ui-1.8.16.custom.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/scripts/jtable/themes/metro/blue/jtable.css" />
    <script src="../jtable/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="../jtable/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="../jtable/scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
    <script type="text/javascript" src="../jtable/scripts/jtable/extensions/jquery.jtable.toolbarsearch.js"></script>
    <script type="text/javascript" src="../jtable/scripts/jtable/extensions/jquery.jtable.spreadsheet.js"></script>
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.accordion.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.all.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.base.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.button.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.dialog.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.progressbar.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.slider.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.tabs.css" />
    <link rel="stylesheet" type="text/css" href="../jtable/themes/base/jquery.ui.theme.css" />

    <!--Bootstrap and JQuery Online-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--Bootstrap Core CSS-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="../images/coderedicon.ico" />
    <!-- Bootstrap Core JavaScript -->
   <script src="../js/bootstrap.min.js"></script>

<script type="text/javascript" src="../jtable/dev/jquery.jtable.sorting.js"></script>

  </head>
  <body>
    <div class="row">
        <div class="col-sm-12" id="Report" style="width:100%; padding:3%;"></div>
    </div>
    <div class="row"><br><br><br><br><br><br><br><br></div>
    <br><br>
            <script>

        $(document).ready(function () {

            //Prepare jTable
            $('#Report').jtable({
                title: 'System Engineers Schedule:',
                selecting: true, 
                multiselect: true,
                selectOnRowClick: true, 
                defaultSorting: 'Name ASC',
                actions: {
                   listAction: '../php/tablePhp/scheduleServerSide.php?action=list'
                },
                fields: {
                    sched_id: {
                        key: true,
                        create: false,
                        edit: false,
                        list: false
                    },
                    name: {
                        title: 'System Engineer',
                        width: '15%',
                        edit: false,
                    },
                    monday: {
                        title: 'Monday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    tuesday: {
                        title: 'Tuesday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    wednesday: {
                        title: 'Wednesday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    thursday: {
                        title: 'Thursday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    friday: {
                        title: 'Friday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    saturday: {
                        title: 'Saturday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    },
                    sunday: {
                        title: 'Sunday',
                        width: '15%',
                         type: 'combobox',
                         options: { '6am - 2pm': '6am - 2pm', '9am - 5pm': '9am - 5pm',
                                    '2pm - 10pm': '2pm - 10pm', '11am - 7pm': '11am - 7pm',
                                    'day-off': 'day-off'}
                    }
                }
            });

            //Load person list from server
            $('#Report').jtable('load');

        });

    </script>
  </body>
</html>
