<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter Sidebar Example</title>
</head>
<style>
    .sidebar {
        width: -1px;
        background-color: #f4f4f4;
        float: left;
        padding: 20px;
    }
    
    .content {
        margin-left: 220px; /* Make sure it doesn't overlap with the sidebar */
        padding: 20px;
    }
</style>

<body>
    <div class="sidebar">
        <?php echo $sidebar_content; ?>
    </div>
    <div class="content">
    <h1>Available Hours: <?php echo $total_hours; ?></h1>
    <h1>Billable Hours: <?php echo $total_billable_hours; ?></h1>
    <h1>NotBillable Hours <?php echo $total_Notbillable_hours; ?></h1>
    <h1>Total Hours Worked: <?php echo $total_billable_hours + $total_Notbillable_hours ?></h1>
    <h1>ProjectName: <?php echo $project_name; ?></h1>
    
    </div>
</body>
</html>
