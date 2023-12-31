<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Week Numbers Table</title>
     <link rel="stylesheet" href="styles.css">
</head>
<style>
    
    table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
        .hidden {
            display: none;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .weekTable {
            width: 100%;
        }
        .progress-cell {
            position: relative;
        }

        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            background-color: #4caf50;
            height: 100%;
            transition: width 2s ease-in-out;
        }

     

</style>
<body>


<table class="test">
    <thead>
        <tr>
            <th>Name</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row) : ?>
            <tr>
           
                <td><?php echo $row->name; ?></td>
                <!-- Add more columns as needed -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="test">
    <thead>
        <tr>
            <th>Name</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($user_result as $row) : ?>
            <tr>
                
                <td><?php echo $row->firstname;  ?></td>
                <!-- Add more columns as needed -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$year = date('Y');
$currentWeek = date('W');
?>

<select id="tableSelector">
    <option value="table1">Project progress</option>
    <option value="table2">Enablement</option>
    <option value="table3">Utilization rate</option>
    <option value="table4">Realization rate</option>
</select>

<input type="text" id="weekInput" placeholder="Enter week number">
<button id="searchButton">Search</button>






<table  id="table1" class="">
    <thead>
        <tr>
            <th>Name</th>
            <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                
                <th>Week <?php echo $week; ?></th>
            <?php endfor; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row) : ?>
            <tr>
            <td><?php echo $row->name; ?></td>
                <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                    <td><?php echo rand(0, 100); ?>%</td> <!-- Random progress percentage for demonstration -->
                <?php endfor; ?>
            </tr>
    
        <?php endforeach; ?>
    </tbody>  
</table>


<table id="table2" class="hidden">
        <thead>
            <tr>
                <th>Name</th>
                <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                    
                    <th>Week <?php echo $week; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_result as $row) : ?>
                <tr>
                    <td><?php echo $row->firstname; ?></td>
                    <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                        <td><?php echo rand(0, 100); ?>%</td> <!-- Random progress percentage for demonstration -->
                    <?php endfor; ?>
                 </tr>
            <?php endforeach; ?>
        </tbody>  
  
</table>

<table id="table3" class="hidden">
        <thead>
            <tr>
                <th>Name</th>
                <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                    
                    <th>Week <?php echo $week; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_result as $row) : ?>
                <tr>
                    <td><?php echo $row->firstname; ?></td>
                    <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                        <td><?php echo rand(0, 100); ?>%</td> <!-- Random progress percentage for demonstration -->
                    <?php endfor; ?>
                 </tr>
            <?php endforeach; ?>
        </tbody>  
  
</table>


<table id="table4" class="hidden">
        <thead>
            <tr>
                <th>Name</th>
                <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                    
                    <th>Week <?php echo $week; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user_result as $row) : ?>
                <tr>
                    <td><?php echo $row->firstname; ?></td>
                    <?php for ($week = 1; $week <= $currentWeek; $week++): ?>
                        <td><?php echo rand(0, 100); ?>%</td> <!-- Random progress percentage for demonstration -->
                    <?php endfor; ?>
                 </tr>
            <?php endforeach; ?>
        </tbody>  
  
</table>


<div class="content">
    <h1>Available Hours: <?php echo $total_hours; ?></h1>
    <h1>Billable Hours: <?php echo $total_billable_hours; ?></h1>
    <h1>NotBillable Hours <?php echo $total_Notbillable_hours; ?></h1>
    <h1>Total Hours Worked: <?php echo $total_billable_hours + $total_Notbillable_hours ?></h1>
    <h1>ProjectName: <?php echo $project_name; ?></h1>
    
    </div>

    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>
<script>
    document.getElementById('tableSelector').addEventListener('change', function() {
    var selectedTable = this.value;
    document.getElementById('table1').classList.add('hidden');
    document.getElementById('table2').classList.add('hidden');
    document.getElementById('table3').classList.add('hidden');
    document.getElementById('table4').classList.add('hidden');
    document.getElementById(selectedTable).classList.remove('hidden');
});

var modal = document.getElementById('myModal');
var span = document.getElementsByClassName('close')[0];

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function animateProgress(weekCell, progress) {
var currentProgress = 0;
var interval = setInterval(function() {
    if (currentProgress >= progress) {
        clearInterval(interval);
    } else {
        currentProgress++;
        weekCell.textContent = currentProgress + '%';
    }
}, 10); // Adjust the interval (in milliseconds) for smoother or faster animation
}

function showWeek(weekNumber) {
var modalContent = document.getElementById('modalContent');
modalContent.innerHTML = '';

var newTable = document.createElement('table');
newTable.classList.add('weekTable');

var selectedTable = document.getElementById('tableSelector').value;
var table = document.getElementById(selectedTable);

var headerRow = table.rows[0].cloneNode(true);
var headerCells = headerRow.getElementsByTagName('th');
for (var i = 1; i < headerCells.length; i++) {
    if (i != (weekNumber)) {  // Adjusting for 0-based index
        headerCells[i].style.display = 'none';
    }
}
newTable.appendChild(headerRow);

for (var i = 1; i < table.rows.length; i++) {
    var row = table.rows[i];
    var nameCell = row.cells[0].cloneNode(true);
    var weekCell = row.cells[weekNumber].cloneNode(true);

    animateProgress(weekCell, parseInt(weekCell.textContent)); // Animate progress

    var rowClone = document.createElement('tr');
    rowClone.appendChild(nameCell);
    rowClone.appendChild(weekCell);

    newTable.appendChild(rowClone);
}

modalContent.appendChild(newTable);
modal.style.display = 'block';
}

document.getElementById('searchButton').addEventListener('click', function() {
var weekNumber = parseInt(document.getElementById('weekInput').value);
if (!isNaN(weekNumber)) {
    showWeek(weekNumber);
}
});

function animateAllProgress() {
    var tables = document.querySelectorAll('table:not(.weekTable)');
    tables.forEach(function(table) {
        var rows = table.rows;
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].cells;
            for (var j = 1; j < cells.length; j++) {
                animateProgress(cells[j], parseInt(cells[j].textContent));
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    animateAllProgress();
});

</script>
</body>
</html>
