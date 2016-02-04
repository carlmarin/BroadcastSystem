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
    <div class="row" >
        <div class="filtering">
            <form>
                <div class="col-sm-1" ></div>
                <div class="col-sm-2">
                    <h5 align = "left"> Machine: </h5>               
                    <input class="form-control" type="text" value="" name="machine_name" id="machine_name" />
                </div>
                <div class="col-sm-2" >
                    <h5 align = "left"> Location: </h5>
                    <select class="form-control" id="current_location" name="current_location">
                        <option value=""></option>
                        <option value="Studio 1">Studio 1</option>
                        <option value="Studio 2">Studio 2</option>
                        <option value="Studio 3">Studio 3</option>
                        <option value="Studio 4">Studio 4</option>
                        <option value="Studio 5">Studio 5</option>
                        <option value="Studio 6">Studio 6</option>
                        <option value="Studio 7">Studio 7</option>
                        <option value="Studio 8">Studio 8</option>
                        <option value="Studio 9">Studio 9</option>
                        <option value="Studio 10">Studio 10</option>
                        <option value="OB Van 1">OB Van 1</option>
                        <option value="OB Van 2">OB Van 2</option>
                        <option value="OB Van 3">OB Van 3</option>
                        <option value="OB Van 4">OB Van 4</option>
                        <option value="OB Van 5">OB Van 5</option>
                        <option value="OB Van 6">OB Van 6</option>
                        <option value="OB Van 7">OB Van 7</option>
                        <option value="OB Van 8">OB Van 8</option>
                        <option value="OB Van 9">OB Van 9</option>
                        <option value="OB Van 10">OB Van 10</option>
                  </select>                        
                </div>
                <div class="col-sm-2">
                    <h5 align = "left"> Date: </h5>             
                    <input class="form-control" type="date" name="date_place" id="date_place" />
                </div>
                <div class="col-sm-2">
                     <br><br><button class="btn btn-primary"  type="submit" id="LoadRecordsButton">Load Records</button>
                     <button class="btn btn-primary" data-toggle="tooltip" title="Clear Fields to Display All Record" type="reset" >Clear All</button>
                </div>
                <div class="col-sm-1"></div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" id="Report" style="width:100%; padding:3%;"></div>
    </div>
    <div class="row"><br><br><br><br></div>
    <br><br>
           <script>

        $(document).ready(function () {

            //Prepare jTable
            $('#Report').jtable({
                title: 'Machine Records:',
                selecting: true, 
                multiselect: true,
                defaultSorting: 'Name ASC',
              //  columnResizable: false,
                // toolbar: {
                // // items: [{
                // //             icon: '../images/pdf.png',
                // //             text: 'Export to PDF',
                // //             click: function () {
                // //                  window.open('../php/pdf/reportPDF.php', '_blank');  
                // //                 }
                // //     }] //Array of your custom toolbar items.
                // // }, 
                actions: {
                   listAction: '../php/tablePhp/machineServerSide.php?action=list'
                },
                fields: {
                    machine_id: {
                        key: true,
                        create: false,
                        edit: false,
                        list: false
                    },
                    machine_name: {
                        title: 'Machine',
                        width: '15%',
                        edit: false
                    },
                    machine_model: {
                        title: 'Model',
                        width: '15%',
                        edit: false
                    },
                    serial_no: {
                        title: 'Serial #',
                        width: '15%',
                        edit: false
                    },
                    current_location: {
                        title: 'Current Location',
                        width: '15%',
                        type: 'combobox',
                        options: { 'Studio 1': 'Studio 1', 'Studio 2': 'Studio 2',
                                    'Studio 3': 'Studio 3', 'Studio 4': 'Studio 4',
                                    'Studio 5': 'Studio 5', 'Studio 6': 'Studio 6',
                                    'Studio 7': 'Studio 7', 'Studio 8': 'Studio 8', 
                                    'Studio 9': 'Studio 9', 'Studio 10': 'Studio 10',
                                    'OB Van 1': 'OB Van 1', 'OB Van 2': 'OB Van 2',
                                    'OB Van 3': 'OB Van 3', 'OB Van 4': 'OB Van 4',
                                    'OB Van 5': 'OB Van 5', 'OB Van 6': 'OB Van 6',
                                    'OB Van 7': 'OB Van 7', 'OB Van 8': 'OB Van 8', 
                                    'OB Van 9': 'OB Van 9', 'OB Van 10': 'OB Van 10',
                                    'Grandia 1': 'Grandia 1', 'Grandia 2': 'Grandia 2', 
                                    'Grandia 3': 'Grandia 3', 'Grandia 4': 'Grandia 4',
                                    'Grandia 5': 'Grandia 5'}
                    },
                    date_place: {
                        title: 'Date Place',
                        width: '15%',
                        type: 'date'
                    },
                    history: {
                        title: 'History (Location / Date)',
                        width: '10%',
                        create: false,
                        edit: false
                    }
                }
            });

        $('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#Report').jtable('load', {
                date_place: $('#date_place').val(),
                current_location: $('#current_location').val(),
                machine_name: $('#machine_name').val()
            });
        });

        $('#LoadRecordsButton').click();

        });

    </script>
  </body>
</html>